<?php

namespace App\Controller;

use App\Entity\Menu;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/carte', name: 'carte')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Menu::class);
        $menus = $repository->findAll(); // SELECT * FROM `post`;
        return $this->render('menu/index.html.twig', [
            "posts" => $menus
        ]);
    }
}
