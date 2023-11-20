<?php

namespace App\Controller;

use App\Entity\Customers;
use App\Form\CustomerType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    #[Route('/customer/new', name: 'app_user')]
    public function index(Request $request, UserPasswordHasherInterface $userPasswordHasher, ManagerRegistry $doctrine): Response
    {
        $customer = new Customers($userPasswordHasher);
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $doctrine->getManager();
            $em->persist($customer);
            $em->flush();
            return $this->redirectToRoute("home");
        }
        return $this->render('customer/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
