<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Customers;
use App\Entity\RestaurantPlaces;
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
        $repository = $doctrine->getRepository(Book::class);
        $books = $repository->findBy(array('customer' => $customer->getId())); // SELECT the data with the value id in table `restaurant_places`;
        $em = $doctrine->getManager();
        foreach ($books as $key => $book)
        {
            $repository = $doctrine->getRepository(RestaurantPlaces::class);
            $place = $repository->findOneBy(array('book' => $book->getId())); // SELECT the data with the value id in table `restaurant_places`;
            $em->remove($place);
            $em->remove($book);
        }
        $em->remove($customer);
        $em->flush();

        return $this->redirectToRoute('check_customer');
    }
}
