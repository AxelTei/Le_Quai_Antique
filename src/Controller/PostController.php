<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    // URL a sécurisé
    #[Route('/', name: 'home')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Post::class);
        $posts = $repository->findAll(); // SELECT * FROM `post`;
        return $this->render('post/index.html.twig', [
            "posts" => $posts
        ]);
    }

    #[Route('/post/new')]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $post->setUser($this->getUser());
            $em = $doctrine->getManager();
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('post/form.html.twig', [
            'post_form' => $form->createView()
        ]);
    }

    #[Route('/post/edit/{id}', name: "edit-post", requirements: ["id" => "\d+"])]
    public function update(Post $post, ManagerRegistry $doctrine, Request $request): Response
    {
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

    #[Route('/post/delete/{id}', name: "delete-post", requirements: ["id" => "\d+"])]
    public function delete(Post $post, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('home');
    }

    #[Route('/post/copy/{id}', name: "copy-post", requirements: ["id" => "\d+"])]
    public function duplicate(Post $post, ManagerRegistry $doctrine, Request $request): Response
    {
        $copyPost = clone $post;

        $em = $doctrine->getManager();
        $em->persist($copyPost);
        $em->flush();
        return $this->redirectToRoute('home');
    }
}
