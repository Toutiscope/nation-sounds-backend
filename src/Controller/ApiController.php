<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Entity\Bar;
use App\Entity\Concert;
use App\Entity\Contact;
use App\Entity\Festival;
use App\Entity\MusicStyle;
use App\Entity\Notification;
use App\Entity\Restauration;
use App\Entity\Stage;
use App\Entity\Wc;
use App\Form\ArtistFormType;
use App\Repository\ArtistRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/artists", name="api_artists")
     */
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        // Filtrer selon le GET dans l'URL artist?bigArtist=1
        $bigArtist = $request->get('bigArtist');

        /** @var ArtistRepository */
        $artistRepository = $entityManager->getRepository(Artist::class);
        $artists = $artistRepository->findByFilter($bigArtist);

        // Récupérer la liste de tous les artistes
        // $artists = $entityManager->getRepository(Artist::class)->findAll();

        $arrayArtists = $this->artistToArray($artists);

        // Renvoie le tableau dans un json
        return $this->json($arrayArtists);
    }

    private function artistToArray($artists)
    {
        $lineUp = [];
        foreach ($artists as $artist) {
            $lineUp[] = [
                'artist' => $artist->getName(),
                'description' => $artist->getDescription(),
                'img' => $artist->getImage(),
                'bigArtist' => $artist->isBigArtist(),
                'type' => $artist->getMusicStyle()->getName(),
                'image' => $artist->getImage(),
            ];
        }

        return $lineUp;
    }


    /**
     * @Route("/api/lineup", name="api_lineup")
     */
    public function lineup(EntityManagerInterface $entityManager, Request $request): Response
    {
        // Récupérer la liste de tous les artistes
        $concerts = $entityManager->getRepository(Concert::class)->findAll();

        $lineUp = [];
        foreach ($concerts as $concert) {
            $lineUp[] = [
                'concert' => $concert->getArtist()->getName(),
                'description' => $concert->getArtist()->getDescription(),
                'img' => $concert->getArtist()->getImage(),
                'bigArtist' => $concert->getArtist()->isBigArtist(),
                'type' => $concert->getArtist()->getMusicStyle()->getName(),
                'stage' => $concert->getStage()->getTitle(),
                'day' => $concert->getDay(),
                'hour' => $concert->getHour(),
            ];
        }


        // Renvoie le tableau dans un json
        return $this->json($lineUp);
    }


    /**
     * @Route("/api/map", name="api_map")
     */
    public function showMap(EntityManagerInterface $entityManager, Request $request): Response
    {
        // Récupérer la liste de tous les artistes
        $stages = $entityManager->getRepository(Stage::class)->findAll();
        $wcs = $entityManager->getRepository(Wc::class)->findAll();
        $bars = $entityManager->getRepository(Bar::class)->findAll();
        $caterings = $entityManager->getRepository(Restauration::class)->findAll();

        $map = [];
        foreach ($stages as $stage) {
            $map[] = [
                'name' => $stage->getTitle(),
                'coordinates' => $stage->getCoordinates(),
                'category' => $stage->getCategory()->getName(),
            ];
        }

        foreach ($wcs as $wc) {
            $map[] = [
                'name' => $wc->getTitle(),
                'coordinates' => $wc->getCoordinates(),
                'category' => $wc->getCategory()->getName(),
                'gender' => $wc->getGender(),
                'number' => $wc->getNumber(),
                'company' => $wc->getCompany(),
            ];
        }

        foreach ($bars as $bar) {
            $map[] = [
                'name' => $bar->getTitle(),
                'coordinates' => $bar->getCoordinates(),
                'description' => $bar->getDescription(),
                'category' => $bar->getCategory()->getName(),
                'company' => $bar->getCompany(),
            ];
        }

        foreach ($caterings as $catering) {
            $map[] = [
                'name' => $catering->getTitle(),
                'coordinates' => $catering->getCoordinates(),
                'description' => $catering->getDescription(),
                'category' => $catering->getCategory()->getName(),
                'company' => $catering->getCompany(),
            ];
        }

        return $this->json($map);
    }

    /**
     * @Route("/api/contacts", name="api_contacts")
     */
    public function contact(EntityManagerInterface $entityManager, Request $request): Response
    {
        $contacts = $entityManager->getRepository(Contact::class)->findAll();

        $contactArray = [];
        foreach ($contacts as $contact) {
            $contactArray[] = [
                'name' => $contact->getName(),
                'picture' => $contact->getPicture(),
                'job' => $contact->getJob(),
                'description' => $contact->getDescription(),
                'festival' => $contact->getFestival(),

            ];
        }

        return $this->json($contactArray);
    }

    /**
     * @Route("/api/stages", name="api_stages")
     */
    public function stages(EntityManagerInterface $entityManager): Response
    {
        $stages = $entityManager->getRepository(Stage::class)->findAll();

        $array = [];
        foreach ($stages as $stage) {
            $array[] = $stage->getTitle();
        };

        // return $this->json($array);
        return $this->json($array);
    }

    /**
     * @Route("/api/musicstyles", name="api_musicstyles")
     */
    public function musicStyles(EntityManagerInterface $entityManager): Response
    {
        $musicstyles = $entityManager->getRepository(MusicStyle::class)->findAll();

        $array = [];
        foreach ($musicstyles as $musicstyle) {
            $array[] = $musicstyle->getName();
        };

        return $this->json($array);
    }

    /**
     * @Route("/api/global-informations", name="api_globalInformations")
     */
    public function globalInformations(EntityManagerInterface $entityManager, Request $request): Response
    {
        $festivals = $entityManager->getRepository(Festival::class)->findAll();

        $gInfosArray = [];
        foreach ($festivals as $festival) {
            $gInfosArray[] = [
                'globalInformations' => $festival->getGlobalInformations(),
            ];
        };

        return $this->json($gInfosArray);
    }

    /**
     * @Route("/api/practical-informations", name="api_practicalInformations")
     */
    public function practicalInformations(EntityManagerInterface $entityManager, Request $request): Response
    {
        $festivals = $entityManager->getRepository(Festival::class)->findAll();

        $pInfosArray = [];
        foreach ($festivals as $festival) {
            $pInfosArray[] = [
                'practicalInformations' => $festival->getPraticalInformations(),
            ];
        };

        return $this->json($pInfosArray);
    }

    /**
     * @Route("/api/mail", name="api_mail")
     */
    public function mail(EntityManagerInterface $entityManager, Request $request): Response
    {
        $festivals = $entityManager->getRepository(Festival::class)->findAll();

        $mailArray = [];
        foreach ($festivals as $festival) {
            $mailArray[] = [
                'mail' => $festival->getContactMail(),
            ];
        };

        return $this->json($mailArray);
    }

    /**
     * @Route("/api/notification", name="api_notification")
     */
    public function notification(EntityManagerInterface $entityManager, Request $request): Response
    {
        $notifications = $entityManager->getRepository(Notification::class)->findAll();

        $notificationArray = [];
        foreach ($notifications as $notification) {
            $notificationArray[] = [
                'title' => $notification->getTitle(),
                'description' => $notification->getDescription()
            ];
        };

        return $this->json($notificationArray);
    }
}
