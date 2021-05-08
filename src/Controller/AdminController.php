<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditUserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    /**
 * @Route("/utilisateurs", name="utilisateurs")
 */
public function usersList(UserRepository $users)
{
    return $this->render('admin/users.html.twig', [
        'users' => $users->findAll(),
    ]);
}
/**
 * @Route("/utilisateurs/modifier/{id}", name="modifier_utilisateur")
 */
public function editUser($id, Request $request, EntityManagerInterface $entityManager)
{
    $user = $entityManager->getRepository(User::class)->find($id);
        
        $userForm = $this->createForm(EditUserType::class, $user);
        
        $userForm->handleRequest($request);

    if ($userForm->isSubmitted() && $userForm->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        $this->addFlash('message', 'Utilisateur modifié avec succès');
        return $this->redirectToRoute('home_page');
    }
    
    return $this->render('admin/edituser.html.twig', [
        'userForm' => $userForm->createView(),
    ]);
}
}
