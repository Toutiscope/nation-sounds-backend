<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request): Response
    {
        // Enregistrer un contact
        $contact = new Contact();

        $contactForm = $this->createForm(ContactFormType::class, $contact);

        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted()) {

            if ($contactForm->isValid()) {

                $em = $this->getDoctrine()->getManager();

                $em->persist($contact);

                $em->flush();

                echo "contact enregistré";
            } else {
                echo "le contact n'a pas été enregistré";
            }
        }

        // Afficher une liste de contacts
        $contacts = $this->getDoctrine()->getRepository(Contact::class)->findAll();


        return $this->render('contact/index.html.twig', [
            'contactForm' => $contactForm->createView(),
            'contacts' => $contacts
        ]);
    }
          // Modifier une rencontre

    /**
     * @Route("contact/{id}", name="contact_edit")
     * @param contact $contact
     * @param Request $request
     * @return Response
     */
    public function editcontact($id, Request $request, EntityManagerInterface $entityManager)
    {

        $contact = $entityManager->getRepository(contact::class)->find($id);
        
        $contactForm = $this->createForm(contactFormType::class, $contact);
        
        $contactForm->handleRequest($request);
        
        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
        
            $entityManager = $this->getDoctrine()->getManager();
        
            $entityManager->flush();

            $this->addFlash('success', 'Rencontre modifié !');
        }


        // Afficher une liste de rencontre
        $contacts = $this->getDoctrine()->getRepository(contact::class)->findAll();


        return $this->render("contact/index.html.twig", [
            'contactForm' => $contactForm->createView(),
            'contacts' => $contacts,
        ]);
    }

// Supprimer une Rencontre 

    /**
     * @Route("/contact/{id}/delete", name="contact_delete")
     * @param contact $contact
     * @return RedirectResponse
     */
    public function deletecontact($id, Request $request, EntityManagerInterface $entityManager)
    {

        $contact = $entityManager->getRepository(Contact::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($contact);
        $entityManager->flush();

        return $this->redirectToRoute("contact");
    }
}