<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PraticalInformationsFaqController extends AbstractController
{
    /**
     * @Route("/pratical-informations-faq", name="pratical_informations_faq")
     */
    public function index(): Response
    {
        return $this->render('pratical_informations_faq/index.html.twig', [
            'controller_name' => 'PraticalInformationsFaqController',
        ]);
    }
}