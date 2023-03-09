<?php

namespace App\Controller;

use App\Entity\Schedules;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index (ManagerRegistry $doctrine): Response
    {
        $repositorySchedules = $doctrine->getRepository(Schedules::class);
        $schedules = $repositorySchedules->findAll(); // SELECT * FROM `restaurant_hours`;

        return $this->render('contact/index.html.twig', [
            "schedules" => $schedules,
        ]);
    }
}