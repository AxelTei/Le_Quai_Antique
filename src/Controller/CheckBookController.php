<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\RestaurantPlaces;
use App\Entity\Schedules;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class CheckBookController extends AbstractController
{
    #[Route('/check_book', name: 'check_book')]
    public function index (ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $repository = $doctrine->getRepository(Book::class);
        $books = $repository->findAll(); // SELECT * FROM `restaurant_bookings`;
        $repositorySchedules = $doctrine->getRepository(Schedules::class);
        $schedules = $repositorySchedules->findAll(); // SELECT * FROM `restaurant_hours`;
        $user = $this->getUser();

        return $this->render('customer/index.html.twig', [
            "schedules" => $schedules,
            "books" => $books,
            "user" => $user
        ]);
    }
    #[Route('/booking-customer/delete/{id}', name: "delete-booking-customer", requirements: ["id" => "\d+"])]
    public function deleteBookCustomerSide(Book $book, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $repository = $doctrine->getRepository(RestaurantPlaces::class);
        $place = $repository->findOneBy(array('book' => $book->getId())); // SELECT the data with the value id in table `restaurant_places`;
        $em = $doctrine->getManager();
        $em->remove($book);
        $em->remove($place);
        $em->flush();

        return $this->redirectToRoute('check_book');
    }
}
