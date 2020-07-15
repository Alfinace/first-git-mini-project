<?php

namespace App\Controller;

use App\Entity\Personnel;
use App\Form\PersonnelType;
use App\Repository\PersonnelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/personnel")
 */
class PersonnelController extends AbstractController
{
    /**
     * @Route("/", name="personnel_index", methods={"GET"})
     */
    public function index(PersonnelRepository $personnelRepository): Response
    {
        return $this->render('personnel/index.html.twig', [
            'personnels' => $personnelRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="personnel_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $personnel = new Personnel();
        $form = $this->createForm(PersonnelType::class, $personnel);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($personnel);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Personne ajouté avec succée'
            );
            return $this->redirectToRoute('personnel_index');
        }

        return $this->render('personnel/new.html.twig', [
            'personnel' => $personnel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="personnel_show", methods={"GET"})
     */
    public function show(Personnel $personnel): Response
    {
        return $this->render('personnel/show.html.twig', [
            'personnel' => $personnel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="personnel_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Personnel $personnel): Response
    {
        $form = $this->createForm(PersonnelType::class, $personnel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Personne est mis à jour'
            );
            return $this->redirectToRoute('personnel_index');
        }

        return $this->render('personnel/edit.html.twig', [
            'personnel' => $personnel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="personnel_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Personnel $personnel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$personnel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($personnel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('personnel_index');
    }
}
