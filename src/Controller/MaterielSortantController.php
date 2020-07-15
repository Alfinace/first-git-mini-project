<?php

namespace App\Controller;

use DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\Fiche;
use App\Entity\BonSortant;
use App\Repository\FicheRepository;
use App\Repository\FactureRepository;
use App\Repository\MaterielRepository;
use App\Repository\PersonnelRepository;
use App\Repository\BonEntrantRepository;
use App\Repository\BonSortantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin")
 */
class MaterielSortantController extends Controller
{
    private $personnelRepository;
    private $materielRepository;
    private $session;
    private $manager;
    private $bonSortantRepository;
    private $bonEntrantRepository;
    private $ficheRepository;
    private $factureRepository;

        function __construct(PersonnelRepository $personnelRepository,
                            SessionInterface $session,
                            MaterielRepository $materielRepository,
                            EntityManagerInterface $manager,
                            BonSortantRepository $bonSortantRepository,
                            BonEntrantRepository $bonEntrantRepository,
                            FicheRepository $ficheRepository,
                            FactureRepository $factureRepository)
        {
            $this->personnelRepository = $personnelRepository;
            $this->materielRepository = $materielRepository;
            $this->session = $session;
            $this->manager = $manager;
            $this->bonSortantRepository = $bonSortantRepository;
            $this->bonEntrantRepository = $bonEntrantRepository;
            $this->ficheRepository = $ficheRepository;
            $this->factureRepository = $factureRepository;
        }
    /**
     * @Route("/sortant", name="materiel_sortant")
     */
    public function index()
    {
        if ($this->session->get('personnel')!=[]) {
          
            return $this->redirectToRoute('choice_personnel');
        }
        $personnels = $this->personnelRepository->findAll();
        return $this->render('materiel_sortant/index.html.twig', [
            'personnels' => $personnels,
        ]);
    }

    /**
     * @Route("/annuler", name="annuler_sortant")
     */
     public function annuler()
     {
          // remove data session
        $this->session->set('sortie',[]);
        $this->session->set('personnel',[]);

         if ($this->session->get('personnel')!=[]) {
           
             return $this->redirectToRoute('choice_personnel');
         }
         $personnels = $this->personnelRepository->findAll();
         return $this->render('materiel_sortant/index.html.twig', [
             'personnels' => $personnels,
         ]);
     }
 

    /**
     * @Route("/sortant/list", name="sortant_list")
     */
    public function liste()
    {
        $sortants=$this->bonSortantRepository->findAll();
        $entrants=$this->bonEntrantRepository->findAll();
        $factures=$this->factureRepository->findAllWithFournisseur();
        $fiches=$this->ficheRepository->findAllWithPersonnel();
        $personnels = $this->personnelRepository->findAll();
        return $this->render('materiel_sortant/liste.html.twig', [
            'path'=>$this->get('kernel')->getProjectDir(),
            'sortants' => $sortants,
            'entrants' => $entrants,
            'factures' => $factures,
            'fiches' => $fiches,
        ]);
    }
    /**
     * @Route("/choice/personnel", name="choice_personnel")
     */
    public function choix(Request $request)
    {
       
        $materiels=$this->materielRepository->findAll();

        if ($request->request->get("personnel")!=null) {
            $personnel_session=$this->session->get('personnel',[]);
            $personnel= $this->personnelRepository->findOneBy(['id' =>$request->request->get("personnel")]);
            $personnel_session[0] = $personnel->getId();
            $this->session->set('personnel',[$personnel_session]);
        } 
        return $this->render('materiel_sortant/choix.html.twig', [
            'materiels'=>$materiels
        ]);
    }

    /**
     * @Route("/session/sortie/", name="session_sortie")
     */
    public function sortie(Request $request)
    {
        if ($this->session->get('personnel')==[]) {
            return $this->redirectToRoute('materiel_sortant');
        }
        $sortie= $this->session->get('sortie',[]);
        //check quantite materiel 
        $materiel=$this->materielRepository->findOneBy(['id' => $request->request->get('materiel')]);
        if ($materiel->getQuantite()< $request->request->get('quantite')) {
           $this->addFlash(
                'notice',
                'Le stock n\'est pas suffisant, il reste de '.$materiel->getQuantite().' nombres de '.$materiel->getDesignation()
           );
           return $this->redirectToRoute('choice_personnel');
        }
        $sortie[$request->request->get('materiel')]=$request->request->get('quantite');
        $this->session->set('sortie',$sortie);
        return $this->redirectToRoute('choice_personnel');
    }

    /**
     * @Route("/session/sortie/verfication", name="session_check_sortie")
     */
    public function verfication(Request $request)
    {
        if ($this->session->get('personnel')==[]) {
            return $this->redirectToRoute('materiel_sortant');
        }
        $sorties =$this->session->get('sortie',[]);
        $sortiesWithData=[];
        foreach ($sorties as $id => $quantite) {
            $sortiesWithData[]=[
                'materiel'=>$this->materielRepository->find($id),
                'quantite'=>$quantite
            ];
        }

        return $this->render('materiel_sortant/verification.html.twig',[
            'commandes'=>$sortiesWithData,
        ]);
    }

     /**
     * @Route("/session/sortie/validation", name="session_valid_sortie")
     */
    public function validation(Request $request,EntityManagerInterface $manager)
    {
        $fiche = new Fiche();
        // if session personnel unset 
        if ($this->session->get('personnel')==[]) {
            return $this->redirectToRoute('materiel_sortant');
        }
        
        $personnel_session=$this->session->get('personnel',[]);
        $sorties =$this->session->get('sortie',[]);
        $sortiesWithData=[];
    
        foreach ($sorties as $id => $quantite) {
            $sortiesWithData[]=[
                'materiel'=>$this->materielRepository->find($id),
                'quantite'=>$quantite
            ];
        }
        $bon_sortant=$this->bonSortantRepository->findByPack();
        if ($bon_sortant != null || $bon_sortant!=[]) {
            $pack=$bon_sortant[0]->getPack();
        } else {
           $pack = 0;
        }
        $this->session->get('packFiche',[]);
    
        foreach ($sortiesWithData as $data) {
            if ($data['materiel']!=null) {
                // set up value object  by session
                $id=$this->personnelRepository->find($personnel_session[0][0]);
                $bonSortant = new BonSortant();
                $bonSortant->setMateriel($data['materiel'])
                            ->setCreatedAt(new DateTime())
                            ->setQuantite($data['quantite'])
                            ->setPack($pack + 1)
                            ->setPersonnel($this->personnelRepository->find($id));
                // saving object bon sortant on database
                $this->manager->persist($bonSortant);
                $this->manager->flush();

                $materiel = $data['materiel'];
                $materiel->setQuantite($materiel->getQuantite() - $data['quantite']);
                $this->manager->persist($materiel);
                $this->manager->flush();
            }  
        } 
        //set up fiche
        $fiche->setPack($pack + 1)
                ->setCreatedAt(new DateTime())
                ->setFile('0');
        $manager->persist($fiche);
        $manager->flush();
        // remove data session
        $this->session->set('sortie',[]);
        $this->session->set('personnel',[]);
        //set this->session pack
        $this->session->set('packFiche',$pack+1);
        return $this->redirectToRoute('etablish_fiche');
    }

    /**
     * @Route("/delete/session/sortie/{id}", name="delete_session_materiel")
     */
    public function delete(Request $request,$id)
    {
        if ($this->session->get('personnel')==[]) {
            return $this->redirectToRoute('materiel_sortant');
        }
        $sorties=$this->session->get('sortie',[]);
        unset($sorties[$id]);
        $this->session->set('sortie',$sorties);
        return $this->redirectToRoute('session_check_sortie');
    }

    /**
     * @Route("/fiche", name="etablish_fiche")
     */
    public function fiche()
    {
        $fiches=$this->bonSortantRepository->findAllByAPack($this->session->get('packFiche'));
        $personnel=null;
        $numero=null;
        $num=null;
        $date= new DateTime();
        foreach ($fiches as $fiche) {
           $personnel = $fiche->getPersonnel();
           $numero ="FI000".$fiche->getPack();
           $num =$fiche->getPack();
           $date =$fiche->getCreatedAt();
        }
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

         // Retrieve the HTML generated in our twig file
         $html = $this->renderView('materiel_sortant/pdf_fiche.html.twig', [
            'fiche'=>$fiches,
            'personnel'=>$personnel,
            'numero'=>$numero,
            'date'=>$this->date_complete(date("Y-m-d")),
    
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
        $filename='fiche_'.$numero.'.pdf';
        //set up filename in fiche
        $fac=$this->ficheRepository->findOneBy(['pack' => $num]);
        $fac->setFile($filename);
        $this->manager->persist($fac);
        $this->manager->flush();
        // In this case, we want to write the file in the public directory
        $publicDirectory = $this->get('kernel')->getProjectDir() . '/public/uploads/fiche_pdf';
        // e.g /var/www/project/public/mypdf.pdf
        $pdfFilepath =  $publicDirectory . '/'.$filename;
        
        // Write file to the desired path
        file_put_contents($pdfFilepath, $output);
        
        // Output the generated PDF to Browser (inline view)
        $dompdf->stream('facture_'.$numero.'.pdf', [
            "Attachment" => false
        ]);
    }
    function date_complete($date1)
      {
        $tab_mois= array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Decembre');
        $date_done=date('d',strtotime($date1)).' '.$tab_mois[date('m',strtotime($date1))-1].' '.date('Y',strtotime($date1));
        return $date_done;
      }
}
