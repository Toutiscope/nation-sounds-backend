<?php

namespace App\Controller;

use App\Entity\Notification;
use App\Entity\Contact;
use App\Form\NotificationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NotificationController extends AbstractController
{
    /**
     * @Route("/notification", name="notification")
     */
    public function index(Request $request): Response
    {

        // Enregistrer une Notification
        $notification = new Notification();

        $notificationForm = $this->createForm(NotificationFormType::class, $notification);

        $notificationForm->handleRequest($request);

        if ($notificationForm->isSubmitted()) {

            if ($notificationForm->isValid()) {

                $em = $this->getDoctrine()->getManager();

                $em->persist($notification);

                $em->flush();

                $this->addFlash('success', 'Notification enregistré !');

                return $this->redirect('notification');
            
            } else {
                $this->addFlash('error', 'Le notification n\'est pas enregistré !');
            }
        }

        // Afficher une liste de Notification
        $notifications = $this->getDoctrine()->getRepository(Notification::class)->findAll();


        return $this->render('notification/index.html.twig', [
            'notificationForm' => $notificationForm->createView(),
            'notifications' => $notifications,
        ]);
    }
    // Modifier une Notification

    /**
     * @Route("notification/{id}", name="notification_edit")
     * @param Notification $notification
     * @param Request $request
     * @return Response
     */
    public function editnotification($id, Request $request, EntityManagerInterface $entityManager)
    {

        $notification = $entityManager->getRepository(Notification::class)->find($id);
        
        $notificationForm = $this->createForm(NotificationFormType::class, $notification);
        
        $notificationForm->handleRequest($request);
        
        if ($notificationForm->isSubmitted() && $notificationForm->isValid()) {
        
            $entityManager = $this->getDoctrine()->getManager();
        
            $entityManager->flush();

            $this->addFlash('success', 'Notification modifié !');
        }


        // Afficher une liste de Notification
        $notifications = $this->getDoctrine()->getRepository(Notification::class)->findAll();


        return $this->render("notification/index.html.twig", [
            'notificationForm' => $notificationForm->createView(),
            'notifications' => $notifications,
        ]);
    }
    // Supprimer une Notification

    /**
     * @Route("/notification/{id}/delete", name="notification_delete")
     * @param Notification $notification
     * @return RedirectResponse
     */
    public function deletenotification($id, Request $request, EntityManagerInterface $entityManager)
    {

        $notification = $entityManager->getRepository(Notification::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($notification);
        $entityManager->flush();

        return $this->redirectToRoute("notification");
    }
}
