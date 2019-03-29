<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HealthController
{
    /**
     * @Route("/v1/app/health")
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return new JsonResponse();
    }
}
