<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistFormType;
use App\Repository\ArtistRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtistController extends AbstractController
{
    /**
     * @Route("/artist", name="artist")
     */
    public function index(Request $request): Response
    {

        // Enregistrer un artiste
        $artist = new Artist();

        $artistForm = $this->createForm(ArtistFormType::class, $artist);

        $artistForm->handleRequest($request);

        if ($artistForm->isSubmitted()) {

            if ($artistForm->isValid()) {

                $em = $this->getDoctrine()->getManager();


            //     $fichier = $artistForm->get('image')->getData();
            // if($fichier){
            //     $nomFichier = uniqid() .'.'. $fichier->guessExtension();

            //     try{
            //         $fichier->move(
            //             $this->getParameter('images_dir'),
            //             $nomFichier
            //         );
            //     }
            //     catch(FileException $e){
            //         return $this->redirectToRoute('artist');
            //     }

            //     $artist->setImage($nomFichier);
            // }
            

                $em->persist($artist);

                $em->flush();

                $this->addFlash('success', 'Artiste enregistré !');

                if ($artist->getId()) {
                    return $this->redirect('artist/' . $artist->getId());
                }
            } else {
                echo "l'Artiste n'a pas été enregistré";
            }
        }

        // Afficher une liste d'artistes
        $artists = $this->getDoctrine()->getRepository(Artist::class)->findAll();


        return $this->render('artist/index.html.twig', [
            'artistForm' => $artistForm->createView(),
            'artists' => $artists,
        ]);
    }


    // Modifier un Artiste 

    /**
     * @Route("artist/{id}", name="artist_edit")
     * @param Artist $artist
     * @param Request $request
     * @return Response
     */
    public function editArtist($id, Request $request, EntityManagerInterface $entityManager)
    {

        $artist = $entityManager->getRepository(Artist::class)->find($id);
        
        $artistForm = $this->createForm(ArtistFormType::class, $artist);
        
        $artistForm->handleRequest($request);
        
        if ($artistForm->isSubmitted() && $artistForm->isValid()) {
        
            $entityManager = $this->getDoctrine()->getManager();
        
            $entityManager->flush();

            $this->addFlash('success', 'Artiste modifié !');
        }


        // Afficher une liste d'artistes
        $artists = $this->getDoctrine()->getRepository(Artist::class)->findAll();


        return $this->render("artist/index.html.twig", [
            'artistForm' => $artistForm->createView(),
            'artists' => $artists,
        ]);
    }

    // Supprimer un Artiste 

    /**
     * @Route("/artist/{id}/delete", name="artist_delete")
     * @param Artist $artist
     * @return RedirectResponse
     */
    public function deleteArtist($id, Request $request, EntityManagerInterface $entityManager)
    {

        $artist = $entityManager->getRepository(Artist::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($artist);
        $entityManager->flush();

        return $this->redirectToRoute("artist");
    }
}
