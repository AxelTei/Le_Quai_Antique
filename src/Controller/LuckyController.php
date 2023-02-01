<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController
{
    #[Route("random")]
    public function number (): Response
    {
        return new Response("<html><h1>Yo</h1></html>");
    }
}