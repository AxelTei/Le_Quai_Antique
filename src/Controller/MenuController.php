<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Form\MenuType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/carte', name: 'carte')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Menu::class);
        $menus = $repository->findAll(); // SELECT * FROM `menu`;
        return $this->render('menu/index.html.twig', [
            "menus" => $menus
        ]);
    }

    // URL a sécurisé
    #[Route('/carte/new')]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        $menu = new Menu();
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $doctrine->getManager();
            $em->persist($menu);
            $em->flush();
            return $this->redirectToRoute('carte');
        }
        return $this->render('menu/form.html.twig', [
            'menu_form' => $form->createView()
        ]);
    }
}
