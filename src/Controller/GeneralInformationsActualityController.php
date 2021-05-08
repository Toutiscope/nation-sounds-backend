<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GeneralInformationsActualityController extends AbstractController
{
    /**
     * @Route("/general-informations-actuality", name="general_informations_actuality")
     */
    public function index(): Response
    {
        return $this->render('general_informations_actuality/index.html.twig', [
            'controller_name' => 'GeneralInformationsActualityController',
        ]);
    }
}
