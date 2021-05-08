<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;

class HomePageController extends AbstractController
{
    /**
     * @Route("/accueil", name="home_page")
     */
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {

        $newUsers = $entityManager->getRepository(User::class)->findByRoles([]);

        $roles = [];
        foreach ($newUsers as $newUser) {
            $roles[] = count($newUser->getRoles());
        };

        // Renvoie un tableau clef => valeur des rôles et le nb d'users qui ont ce rôle
        $counts = array_count_values($roles);

        // Si le rôle 1 (= Rôle USER uniquement) existe, soit s'il y a des nouveaux utilisateurs, alors retourner le nb, sinon retouner zéro
        if (array_key_exists(1, $counts)) {
            $countNewUsers = $counts[1];
        } else {
            $countNewUsers = 0;
        }

        return $this->render('home_page/index.html.twig', [
            'controller_name' => 'HomePageController',
            'newUsers' => $countNewUsers
        ]);
    }
}
