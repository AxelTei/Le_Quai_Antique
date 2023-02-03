<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/')]
    public function index(): Response
    {
        return $this->render('post/index.html.twig', [
            'age' => 30,
        ]);
    }

    #[Route('/post/new')]
    public function create(): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        return $this->render('post/form.html.twig', [
            'post_form' => $form->createView()
        ]);
    }
}
