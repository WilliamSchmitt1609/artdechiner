<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    
    public function index(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $hasher)
    {
        $entityManager = $doctrine->getManager();
        $user = new User;

        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $user = $form->getData();

            $plaintextPassword = $user->getPassword();
            $hashedPassword = $hasher->hashPassword(
                $user,
                $plaintextPassword

            );
            $password = $user->setPassword($hashedPassword) ;

            $entityManager->persist($user);
            $entityManager->flush();
        }    

    
        return $this->renderForm('register/index.html.twig', [
            'form' => $form,
        ]);
    }
}