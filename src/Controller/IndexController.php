<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class IndexController
{
    /**
     * @Route("/")
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return new JsonResponse("Hello Word");
    }
}
