<?php

namespace App\Controller;

use DateTime;
use Convertor;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\Facture;
use App\Entity\BonEntrant;
use App\Repository\FactureRepository;
use App\Repository\MaterielRepository;
use App\Controller\ConversionController;
use App\Repository\BonEntrantRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\FournisseurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// Include Dompdf required namespaces
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 * @Route("admin")
 */
class MaterielEntrantController extends Controller
{

    /**
     * @Route("/entrant", name="materiel_entrant")
     */
    public function index(FournisseurRepository $founisseurRepo,SessionInterface $session)
    {
        if ($session->get('fournisseur')!=[]) {
          
            return $this->redirectToRoute('choice_fournisseur');
        }
        $fournisseurs=$founisseurRepo->findAll();
        return $this->render('materiel_entrant/index.html.twig', [
            'fournisseurs' => $fournisseurs,
        ]);
    }

    /**
     * @Route("/annulerf", name="session_cancel")
     */
    public function annuler(SessionInterface $session,FournisseurRepository $fournisseurRepository)
    {
         // remove data session
       $session->set('commande',[]);
       $session->set('fournisseur',[]);

        if ($session->get('fournisseur')!=[]) {
          
            return $this->redirectToRoute('choice_fournisseur');
        }
        $fournisseurs = $fournisseurRepository->findAll();
        return $this->render('materiel_entrant/index.html.twig', [
            'fournisseurs' => $fournisseurs,
        ]);
    }
    /**
     * @Route("/choice/fournisseur", name="choice_fournisseur")
     */
    public function choix(SessionInterface $session,Request $request,FournisseurRepository $repo,MaterielRepository $mat_repo)
    {
        
        $materiels=$mat_repo->findAll();
        if ($request->request->get("fournisseur")!=null) {
            $fournisseur_session=$session->get('fournisseur',[]);
            $fournisseur= $repo->findOneBy(['id' =>$request->request->get("fournisseur")]);
            $fournisseur_session[0] = $fournisseur->getId();
            $session->set('fournisseur',[$fournisseur_session]);
        } 
        return $this->render('materiel_entrant/choix.html.twig', [
            'materiels'=>$materiels
        ]);
    }

    /**
     * @Route("/delete/session/fournisseur/{id}", name="delete_session_fournisseur")
     */
    public function delete(SessionInterface $session,Request $request,$id)
    {
        if ($session->get('fournisseur')==[]) {
            return $this->redirectToRoute('materiel_entrant');
        }
        $commandes=$session->get('commande',[]);
        unset($commandes[$id]);
        $session->set('commande',$commandes);
        return $this->redirectToRoute('session_check');
    }
    /**
     * @Route("/session/commande/", name="session_command")
     */
    public function commande(SessionInterface $session,Request $request)
    {
        if ($session->get('fournisseur')==[]) {
            return $this->redirectToRoute('materiel_entrant');
        }
        $commande= $session->get('commande',[]);
        $commande[$request->request->get('materiel')]=$request->request->get('quantite');
        $session->set('commande',$commande);
        return $this->redirectToRoute('choice_fournisseur');
    }

    /**
     * @Route("/session/verfication", name="session_check")
     */
    public function verfication(SessionInterface $session,Request $request,MaterielRepository $mat_repo)
    {
        if ($session->get('fournisseur')==[]) {
            return $this->redirectToRoute('materiel_entrant');
        }
        $commandes =$session->get('commande',[]);
        $commandesWithData=[];
        foreach ($commandes as $id => $quantite) {
            $commandesWithData[]=[
                'materiel'=>$mat_repo->find($id),
                'quantite'=>$quantite
            ];
        }

        return $this->render('materiel_entrant/verification.html.twig',[
            'commandes'=>$commandesWithData,
        ]);
    }

     /**
     * @Route("/session/validation", name="session_valid")
     */
    public function validation(FactureRepository $facture, FournisseurRepository $repo,SessionInterface $session,Request $request,MaterielRepository $mat_repo,EntityManagerInterface $manager,BonEntrantRepository $repo_bon)
    {
        $facture = new Facture();
        if ($session->get('fournisseur')==[]) {
            return $this->redirectToRoute('materiel_entrant');
        }
        $fournisseur_session=$session->get('fournisseur',[]);
        $commandes =$session->get('commande',[]);
        $commandesWithData=[];
        foreach ($commandes as $id => $quantite) {
            $commandesWithData[]=[
                'materiel'=>$mat_repo->find($id),
                'quantite'=>$quantite
            ];
        }
        $bon_entrant=$repo_bon->findByPack();
        if ($bon_entrant != null || $bon_entrant!=[]) {
            $pack=$bon_entrant[0]->getPack();
        } else {
           $pack = 0;
        }
        $session->get('pack',[]);
        foreach ($commandesWithData as $data) {
            if ($data['materiel']!=null) {
                // set up value object  by session
                $id=$repo->find($fournisseur_session[0][0]);
                $bonEntrant = new BonEntrant();
                $bonEntrant->setMateriel($data['materiel'])
                            ->setCreatedAt(new DateTime())
                            ->setQuantite($data['quantite'])
                            ->setPack($pack + 1)
                            ->setFournisseur($repo->find($id));
                // saving object bon entrant on database
                $manager->persist($bonEntrant);
                $manager->flush();

                $materiel = $data['materiel'];
                $materiel->setQuantite($data['quantite'] +  $materiel->getQuantite());
                $manager->persist($materiel);
                $manager->flush();
            }  
        } 
        //set up facture
        $facture->setPack($pack + 1)
                ->setCreatedAt(new DateTime())
                ->setFile('0');
        $manager->persist($facture);
        $manager->flush();
        // remove data session
        $session->set('commande',[]);
        $session->set('fournisseur',[]);
        //set session pack
        $session->set('pack',$pack+1);
        return $this->redirectToRoute('etablish_facture');
    }


    /**
     * @Route("/facture", name="etablish_facture")
     */
    public function facture(BonEntrantRepository $repo_bon,SessionInterface $session,FactureRepository $repositoryFacture,EntityManagerInterface $manager)
    {
       
        $facture=$repo_bon->findAllByAPack($session->get('pack'));
        $fournisseur=null;
        $numero=null;
        $num=null;
        $prix_total=0;
        foreach ($facture as $fact) {

           $fournisseur = $fact->getFournisseur();
           $numero ="F000".$fact->getPack();
           $num=$fact->getPack();
           $prix_total = $prix_total + $fact->getQuantite() * $fact->getMateriel()->getPrixUnitaire();
        }
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
       
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $convert= new ConversionController();
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('materiel_entrant/pdf_facture.html.twig', [
            'facture'=>$facture,
            'fournisseur'=>$fournisseur,
            'numero'=>$numero,
            'date'=>$this->date_complete(date("Y-m-d")),
            'prix_en_lettre'=>$convert->Conversion($prix_total),
        ]);
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();
               // Store PDF Binary Data
        $output = $dompdf->output();
        //set filename
        $filename='facture_'.$numero.'.pdf';
        //set up filename in facture
        $fac=$repositoryFacture->findOneBy(['pack' => $num]);
        $fac->setFile($filename);
        $manager->persist($fac);
        $manager->flush();
        // In this case, we want to write the file in the public directory
        $publicDirectory = $this->get('kernel')->getProjectDir() . '/public/uploads/facture_pdf';
        // e.g /var/www/project/public/mypdf.pdf
        $pdfFilepath =  $publicDirectory . '/'.$filename;
        
        // Write file to the desired path
        file_put_contents($pdfFilepath, $output);
        
        // Output the generated PDF to Browser (inline view)
        $dompdf->stream('facture_'.$numero.'.pdf', [
            "Attachment" => true
        ]);
        
        return $this->redirectToRoute('materiel_entrant');
    }


      function date_complete($date1)
      {
        $tab_mois= array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Decembre');
        $date_done=date('d',strtotime($date1)).' '.$tab_mois[date('m',strtotime($date1))-1].' '.date('Y',strtotime($date1));
        return $date_done;
      }
   
}
