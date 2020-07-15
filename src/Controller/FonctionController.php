<?php

namespace App\Controller;

use App\Entity\Fonction;
use App\Form\FonctionType;
use App\Repository\FonctionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/fonction")
 */
class FonctionController extends AbstractController
{
    /**
     * @Route("/", name="fonction_index", methods={"GET"})
     */
    public function index(FonctionRepository $fonctionRepository): Response
    {
        return $this->render('fonction/index.html.twig', [
            'fonctions' => $fonctionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="fonction_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        if ($request->request->get('fonction')['libelle']=="") {
            $this->addFlash(
                'notice',
                'Veuillez remplir le champ Libelle'
            );
            return $this->redirectToRoute('fonction_index');
        }
        $fonction = new Fonction();
        $form = $this->createForm(FonctionType::class, $fonction);
        $form->handleRequest($request);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fonction);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Nouvelle fonction est ajoutée'
            );
            return $this->redirectToRoute('fonction_index');
    }

    /**
     * @Route("/{id}", name="fonction_show", methods={"GET"})
     */
    public function show(Fonction $fonction): Response
    {
        return $this->render('fonction/show.html.twig', [
            'fonction' => $fonction,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="fonction_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Fonction $fonction): Response
    {
        $form = $this->createForm(FonctionType::class, $fonction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Fonction est mis à jour'
            );
            return $this->redirectToRoute('fonction_index');
        }

        return $this->render('fonction/edit.html.twig', [
            'fonction' => $fonction,
            'form' => $form->createView(),
        ]);
    }
}
