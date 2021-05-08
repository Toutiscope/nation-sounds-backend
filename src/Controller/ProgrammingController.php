<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgrammingController extends AbstractController
{
    /**
     * @Route("/line-up", name="programming")
     */
    public function index(): Response
    {
        return $this->render('programming/index.html.twig', [
            'controller_name' => 'ProgrammingController',
        ]);
    }
}
