<?php

namespace App\Controller;

use App\Entity\Festival;
use App\Form\FestivalFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FestivalController extends AbstractController
{
    /**
     * @Route("/festival", name="festival")
     */
    public function index(Request $request): Response
    {

        // Enregistrer un festival
        $festival = new Festival();

        $festivalForm = $this->createForm(FestivalFormType::class, $festival);

        $festivalForm->handleRequest($request);

        if ($festivalForm->isSubmitted()) {

            if ($festivalForm->isValid()) {

                $em = $this->getDoctrine()->getManager();

                $em->persist($festival);

                $em->flush();

                $this->addFlash('success', 'Festival créé !');

                return $this->redirect('festival/' . $festival->getId());
            } else {
                echo "le Festival n'a pas été enregistré";
            }
        }

        // Afficher une liste de festivals
        $festivals = $this->getDoctrine()->getRepository(Festival::class)->findAll();



        return $this->render('festival/index.html.twig', [
            'festivalForm' => $festivalForm->createView(),
            'festivals' => $festivals
        ]);
    }

    
    // Modifier un Festival

    /**
     * @Route("festival/{id}", name="festival_edit")
     * @param Festival $festival
     * @param Request $request
     * @return Response
     */
    public function editFestival($id, Request $request, EntityManagerInterface $entityManager)
    {

        $festival = $entityManager->getRepository(Festival::class)->find($id);

        $festivalForm = $this->createForm(FestivalFormType::class, $festival);

        $festivalForm->handleRequest($request);

        if ($festivalForm->isSubmitted() && $festivalForm->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            
            $entityManager->flush();

            $this->addFlash('success', 'Festival modifié !');
        }


        // Afficher une liste des festivals
        $festivals = $this->getDoctrine()->getRepository(Festival::class)->findAll();


        return $this->render("festival/index.html.twig", [
            'festivalForm' => $festivalForm->createView(),
            'festivals' => $festivals,
        ]);
    }

    // Supprimer un festival

    /**
     * @Route("/festival/{id}/delete", name="festival_delete")
     * @param Festival $festival
     * @return RedirectResponse
     */
    public function deleteFestival($id, EntityManagerInterface $entityManager)
    {

        $festival = $entityManager->getRepository(Festival::class)->find($id);
        
        $entityManager = $this->getDoctrine()->getManager();
        
        $entityManager->remove($festival);
        
        $entityManager->flush();

        return $this->redirectToRoute("festival");
    }

}
