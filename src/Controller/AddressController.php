<?php

namespace App\Controller;

use App\Entity\Address;
use App\Form\AddressType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddressController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    #[Route('account/address', name: 'app_address')]
    public function index(): Response
    {
        return $this->render('address/index.html.twig');
    }

    #[Route('account/add/address', name: 'app_new_address')]
    public function add(Request $request): Response
    {
        $address = new Address;
        
        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            $address->setUser($this->getUser());

            $this->em->persist($address);
            $this->em->flush();
            return $this->redirectToRoute('app_address');
        }

        return $this->render('address/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
