<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\BookingManagement;
use App\Entity\Post;
use App\Entity\Schedules;
use App\Form\BookType;
use App\Form\BookingManagementType;
use App\Form\PostType;
use App\Form\ScheduleType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Post::class);
        $posts = $repository->findAll(); // SELECT * FROM `post`;

        $repositorySchedules = $doctrine->getRepository(Schedules::class);
        $schedules = $repositorySchedules->findAll(); // SELECT * FROM `restaurant_hours`;

        $repositoryBook = $doctrine->getRepository(Book::class);
        $books = $repositoryBook->findAll(); // SELECT * FROM `restaurant_bookings`;

        $repositoryBookAdmin = $doctrine->getRepository(BookingManagement::class);
        $bookManagements = $repositoryBookAdmin->findAll(); // SELECT * FROM `restaurant_bookings_admin`;

        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $doctrine->getManager();
            $em->persist($book);
            $em->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('base.html.twig', [
            "posts" => $posts,
            "schedules" => $schedules,
            "books" => $books,
            "bookManagements" => $bookManagements,
            'book_form' => $form->createView()
        ]);
    }

    // URL a sécurisé
    #[Route('/post/new')]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $doctrine->getManager();
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('post/form.html.twig', [
            'post_form' => $form->createView()
        ]);
    }

    // URL a sécurisé
    #[Route('/post/edit/{id}', name: "edit-post", requirements: ["id" => "\d+"])]
    public function update(Post $post, ManagerRegistry $doctrine, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('post/form.html.twig', [
            'post_form' => $form->createView()
        ]);
    }

    // URL a sécurisé
    #[Route('/post/delete/{id}', name: "delete-post", requirements: ["id" => "\d+"])]
    public function delete(Post $post, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $em = $doctrine->getManager();
        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('home');
    }

    // URL a sécurisé
    #[Route('/post/copy/{id}', name: "copy-post", requirements: ["id" => "\d+"])]
    public function duplicate(Post $post, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $copyPost = clone $post;

        $em = $doctrine->getManager();
        $em->persist($copyPost);
        $em->flush();
        return $this->redirectToRoute('home');
    }

    // URL a sécurisé
    #[Route('/schedules/new')]
    public function createSchedule(Request $request, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $schedules = new Schedules();
        $form = $this->createForm(ScheduleType::class, $schedules);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $doctrine->getManager();
            $em->persist($schedules);
            $em->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('schedules/form.html.twig', [
            'schedules_form' => $form->createView()
        ]);
    }

    // URL a sécurisé
    #[Route('/schedule/edit/{id}', name: "edit-schedule", requirements: ["id" => "\d+"])]
    public function updateSchedule(Schedules $schedules, ManagerRegistry $doctrine, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $form = $this->createForm(ScheduleType::class, $schedules);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('schedules/form.html.twig', [
            'schedules_form' => $form->createView()
        ]);
    }

    // URL a sécurisé
    #[Route('/schedule/delete/{id}', name: "delete-schedule", requirements: ["id" => "\d+"])]
    public function deleteSchedule(Schedules $schedules, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $em = $doctrine->getManager();
        $em->remove($schedules);
        $em->flush();

        return $this->redirectToRoute('home');
    }

    #[Route('/booking', name: 'booking')]
    public function indexBook(Request $request, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $repository = $doctrine->getRepository(Book::class);
        $books = $repository->findAll(); // SELECT * FROM `restaurant_bookings`;

        $bookManagement = new BookingManagement();
        $form = $this->createForm(BookingManagementType::class, $bookManagement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $doctrine->getManager();
            $em->persist($bookManagement);
            $em->flush();
            return $this->redirectToRoute('booking');
        }

        return $this->render('booking/index.html.twig', [
            "books" => $books,
            'bookManagement_form' => $form->createView()
        ]);
    }

    #[Route('/booking/delete/{id}', name: "delete-booking", requirements: ["id" => "\d+"])]
    public function deleteBook(Book $book, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $em = $doctrine->getManager();
        $em->remove($book);
        $em->flush();

        return $this->redirectToRoute('booking');
    }
}
