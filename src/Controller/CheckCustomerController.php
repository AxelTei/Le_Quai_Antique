<?php

namespace App\Controller;

use App\Entity\Customers;
use App\Entity\Schedules;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class CheckCustomerController extends AbstractController
{
    #[Route('/check_customer', name: 'check_customer')]
    public function index (ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $repository = $doctrine->getRepository(Customers::class);
        $customers = $repository->findAll(); // SELECT * FROM `customers`;
        $repositorySchedules = $doctrine->getRepository(Schedules::class);
        $schedules = $repositorySchedules->findAll(); // SELECT * FROM `restaurant_hours`;

        return $this->render('customer/management.html.twig', [
            "schedules" => $schedules,
            "customers" => $customers,
        ]);
    }
    #[Route('/check_customer/delete/{id}', name: "delete-customer", requirements: ["id" => "\d+"])]
    public function deleteCustomer(Customers $customer, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $em = $doctrine->getManager();
        $em->remove($customer);
        $em->flush();

        return $this->redirectToRoute('check_customer');
    }
}
