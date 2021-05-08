<?php

namespace App\Controller;

use App\Entity\Meeting;
use App\Form\MeetingFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MeetArtistsController extends AbstractController
{
    /**
     * @Route("/meeting", name="meeting")
     */
    public function index(Request $request): Response
    {
       // Enregistrer un meeting
       $meeting = new Meeting();

       $meetingForm = $this->createForm(MeetingFormType::class, $meeting);

       $meetingForm->handleRequest($request);

       if ($meetingForm->isSubmitted()) {

           if ($meetingForm->isValid()) {

               $em = $this->getDoctrine()->getManager();

               $em->persist($meeting);

               $em->flush();

               echo "meeting enregistré";
           } else {
               echo "le meeting n'a pas été enregistré";
           }
       }

       // Afficher une liste de meetings
       $meetings = $this->getDoctrine()->getRepository(Meeting::class)->findAll();


       return $this->render('meeting/index.html.twig', [
           'meetingForm' => $meetingForm->createView(),
           'meetings' => $meetings
       ]);
    }

      // Modifier une rencontre

    /**
     * @Route("meeting/{id}", name="meeting_edit")
     * @param Meeting $meeting
     * @param Request $request
     * @return Response
     */
    public function editMeeting($id, Request $request, EntityManagerInterface $entityManager)
    {

        $meeting = $entityManager->getRepository(Meeting::class)->find($id);
        
        $meetingForm = $this->createForm(MeetingFormType::class, $meeting);
        
        $meetingForm->handleRequest($request);
        
        if ($meetingForm->isSubmitted() && $meetingForm->isValid()) {
        
            $entityManager = $this->getDoctrine()->getManager();
        
            $entityManager->flush();

            $this->addFlash('success', 'Rencontre modifié !');
        }


        // Afficher une liste de rencontre
        $meetings = $this->getDoctrine()->getRepository(Meeting::class)->findAll();


        return $this->render("meeting/index.html.twig", [
            'meetingForm' => $meetingForm->createView(),
            'meetings' => $meetings,
        ]);
    }

    // Supprimer une Rencontre 

    /**
     * @Route("/meeting/{id}/delete", name="meeting_delete")
     * @param Meeting $meeting
     * @return RedirectResponse
     */
    public function deleteMeeting($id, Request $request, EntityManagerInterface $entityManager)
    {

        $meeting = $entityManager->getRepository(Meeting::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($meeting);
        $entityManager->flush();

        return $this->redirectToRoute("meeting");
    }
}
