<?php

namespace App\Controller;

use App\Entity\Concert;
use App\Entity\Contact;
use App\Form\ConcertFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConcertController extends AbstractController
{
    /**
     * @Route("/concert", name="concert")
     */
    public function index(Request $request): Response
    {

        // Enregistrer un concert
        $concert = new Concert();

        $concertForm = $this->createForm(ConcertFormType::class, $concert);

        $concertForm->handleRequest($request);

        if ($concertForm->isSubmitted()) {

            if ($concertForm->isValid()) {

                $em = $this->getDoctrine()->getManager();

                $em->persist($concert);

                $em->flush();

                $this->addFlash('success', 'Concert enregistré !');

                return $this->redirect('concert');
            
            } else {
                $this->addFlash('error', 'Le concert n\'est pas enregistré !');
            }
        }

        // Afficher une liste d'concertes
        $concerts = $this->getDoctrine()->getRepository(Concert::class)->findAll();


        return $this->render('concert/index.html.twig', [
            'concertForm' => $concertForm->createView(),
            'concerts' => $concerts,
        ]);
    }
    // Modifier un Concert

    /**
     * @Route("concert/{id}", name="concert_edit")
     * @param Concert $concert
     * @param Request $request
     * @return Response
     */
    public function editConcert($id, Request $request, EntityManagerInterface $entityManager)
    {

        $concert = $entityManager->getRepository(Concert::class)->find($id);
        
        $concertForm = $this->createForm(ConcertFormType::class, $concert);
        
        $concertForm->handleRequest($request);
        
        if ($concertForm->isSubmitted() && $concertForm->isValid()) {
        
            $entityManager = $this->getDoctrine()->getManager();
        
            $entityManager->flush();

            $this->addFlash('success', 'Concert modifié !');
        }


        // Afficher une liste d'concertes
        $concerts = $this->getDoctrine()->getRepository(Concert::class)->findAll();


        return $this->render("concert/index.html.twig", [
            'concertForm' => $concertForm->createView(),
            'concerts' => $concerts,
        ]);
    }
    // Supprimer un Concert

    /**
     * @Route("/concert/{id}/delete", name="concert_delete")
     * @param Concert $concert
     * @return RedirectResponse
     */
    public function deleteConcert($id, Request $request, EntityManagerInterface $entityManager)
    {

        $concert = $entityManager->getRepository(Concert::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($concert);
        $entityManager->flush();

        return $this->redirectToRoute("concert");
    }
}
