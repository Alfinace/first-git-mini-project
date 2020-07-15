<?php

namespace App\Controller;

use App\Repository\MaterielRepository;
use App\Repository\PersonnelRepository;
use App\Repository\BonEntrantRepository;
use App\Repository\BonSortantRepository;
use App\Repository\FournisseurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin")
     */
    public function index()
    {
        $years = array();
        for ($i=0; $i < 20 ; $i++) { 
           array_push($years,date('Y')-$i );
        }
        return $this->render('admin/index.html.twig', [
            'years' => $years,
        ]);
    }
    /**
     * @Route("/chart", name="chart")
     */
    public function chart(BonEntrantRepository $entrantRepository,Request $request,BonSortantRepository $sortantRepository)
    {
        $data1 =[];
        $data2 =[];
        $mode_date =array();
        if ($request->query->get('query')) {
            if ($request->query->get('mode')=='sortant') {
                // filter by day
                if ($request->query->get('mode_date')=='day') {
                    $resultats = $sortantRepository->findCountDay($request->query->get('query'));
                    if (count($resultats)>0) {
                        $i=1;
                        $data2[0]=0;
                        array_push($mode_date,'debut');
                            foreach ($resultats as $row) {
                            $data2[$i]=$row['total'];
                            array_push($mode_date,$this->date_complete($row['date']));
                            $i++;
                        }
                        $data2[$i]=0;
                        array_push($mode_date,'fin');
                    }
                } 
                //filter by month
                elseif ($request->query->get('mode_date')=='month') {
                    $resultats = $sortantRepository->findCountMonth($request->query->get('query'));
                    $mode_date=['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Decembre'];
                    $data2 =[0,0,0,0,0,0,0,0,0,0,0,0];
                    if (count($resultats)>0) {
                        foreach ($resultats as $row) {
                            $data2[$row['mois']]=$row['total'];
                        }
                    }
                }
                return $this->json(['data2'=>$data2,'data1'=>$data1,'mode_date'=>$mode_date],200);
            }
            if ($request->query->get('mode')=='entrant') {
                // filter by day
                if ($request->query->get('mode_date')=='day') {
                    $resultats = $entrantRepository->findCountDay($request->query->get('query'));
                    if (count($resultats)>0) {
                        $i=1;
                        $data1[0]=0;
                        array_push($mode_date,'debut');
                            foreach ($resultats as $row) {
                            $data1[$i]=$row['total'];
                            array_push($mode_date,$this->date_complete($row['date']));
                            $i++;
                        }
                        $data1[$i]=0;
                        array_push($mode_date,'fin');
                    }
                } 
                //filter by month
                elseif ($request->query->get('mode_date')=='month') {
                    $resultats = $entrantRepository->findCountMonth($request->query->get('query'));
                    $mode_date=['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Decembre'];
                    $data1 =[0,0,0,0,0,0,0,0,0,0,0,0];
                    if (count($resultats)>0) {
                        foreach ($resultats as $row) {
                            $data1[$row['mois']]=$row['total'];
                        }
                    }
                }
                return $this->json(['data2'=>$data2,'data1'=>$data1,'mode_date'=>$mode_date],200);
            }
        }
        if ($request->query->get('mode')=='tous') {
           
            if ($request->query->get('mode_date')=='day') {
                $resultats = $sortantRepository->findCountDay($request->query->get('query'));
                if (count($resultats)>0) {
                    $i=1;
                    $data2[0]=0;
                        foreach ($resultats as $row) {
                        $data2[$i]=$row['total'];
                        array_push($mode_date,$this->date_complete($row['date']));
                        $i++;
                    }
                }
            } 
            //filter by month
            elseif ($request->query->get('mode_date')=='month') {
                $resultats = $sortantRepository->findCountMonth($request->query->get('query'));
                $mode_date=['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Decembre'];
                $data2 =[0,0,0,0,0,0,0,0,0,0,0,0];
                if (count($resultats)>0) {
                    foreach ($resultats as $row) {
                        $data2[$row['mois']]=$row['total'];
                    }
                }
            }


            if ($request->query->get('mode_date')=='day') {
                $resultats = $entrantRepository->findCountDay($request->query->get('query'));
                if (count($resultats)>0) {
                    $i=1;
                    $data1[0]=0;
                        foreach ($resultats as $row) {
                        $data1[$i]=$row['total'];
                        array_push($mode_date,$this->date_complete($row['date']));
                        $i++;
                    }
                }
            } 
            //filter by month
            elseif ($request->query->get('mode_date')=='month') {
                $resultats = $entrantRepository->findCountMonth($request->query->get('query'));
                $mode_date=['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Decembre'];
                $data1 =[0,0,0,0,0,0,0,0,0,0,0,0];
                if (count($resultats)>0) {
                    foreach ($resultats as $row) {
                        $data1[$row['mois']]=$row['total'];
                    }
                }
            }
            return $this->json(['data2'=>$data2,'data1'=>$data1,'mode_date'=>$mode_date],200);
            
        }
    }

    /**
     * @Route("/chartfournisseur", name="chartFournisseur")
     */
    public function chartFournisseur(BonEntrantRepository $entrantRepository,FournisseurRepository $fournisseurRepository)
    {
        $fournisseur = array( );
        $fournisseur_nom = array( );
       
        $data=$entrantRepository->findCountFournisseur();
        $i=0;
        foreach ($data as $value) {
            $fournisseur[$i]=$value['total'];
            $fournisseur_nom[$i]=$value['nom'];
            $i++;
        }
        return $this->json(['data_nom'=>$fournisseur_nom,'data'=>$fournisseur],200);
    }

    /**
     * @Route("/chartpersonnel", name="chartPersonnel")
     */
    public function chartPersonnel(BonSortantRepository $sortantRepository,PersonnelRepository $personnelRepository)
    {
        $personnel = array( );
        $personnel_nom = array( );
       
        $data=$sortantRepository->findCountPersonnel();
        $i=0;
        foreach ($data as $value) {
            $personnel[$i]=$value['total'];
            $personnel_nom[$i]=$value['nom'];
            $i++;
        }
        return $this->json(['data_nom'=>$personnel_nom,'data'=>$personnel],200);
    }

    /**
     * @Route("/chartmateriel", name="chartMateriel")
     */
    public function chartMateriel(MaterielRepository $materielRepository)
    {
        $materiel = array( );
        $materiel_nom = array( );
       
        $data=$materielRepository->findAll();
        $i=0;
        foreach ($data as $value) {
            $materiel[$i]=$value->getQuantite();
            $materiel_nom[$i]=$value->getDesignation();
            $i++;
        }
        return $this->json(['data_nom'=>$materiel_nom,'data'=>$materiel],200);
    }

    function date_complete($date1)
    {
      $tab_mois= array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Decembre');
      $date_done=date('d',strtotime($date1)).' '.$tab_mois[date('m',strtotime($date1))-1].' '.date('Y',strtotime($date1));
      return $date_done;
    }
}
