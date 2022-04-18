<?php

namespace App\Controller;

use App\Form\PasswordChangeType;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AccountPasswordController extends AbstractController
{
    #[Route('/account/password', name: 'app_account_password')]
    public function index(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $hasher): Response
    {
        $notification = null;
        $entityManager = $doctrine->getManager();
        $user = $this->getUser();
        $form = $this->createForm(PasswordChangeType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $oldPassword = $form->get('old_password')->getData();
           if($hasher->isPasswordValid($user, $oldPassword)){
                $newPassword = $form->get('new_password')->getData();
                $hashedPassword = $hasher->hashPassword(
                    $user,
                    $newPassword
                );
                $password = $user->setPassword($hashedPassword) ;  
                $entityManager->flush();  
                $notification = "Réinitialisation du mot de passe réussie";        
                } else {
               $notification = "Erreur dans la saisie de votre mot de passe actuel";
           } 

        }
        
        return $this->render('account/password.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification,
        ]);
    }
}
