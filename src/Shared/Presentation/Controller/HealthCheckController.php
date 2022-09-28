<?php

namespace App\Shared\Presentation\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class HealthCheckController
{
    /**
     * A controller action function, defined with the
     * `http` method `GET` to retrieve the server
     * health status.
     *
     * @Get("/healthCheck", name="get_health_check")
     */
    public function getHealthCheck()
    {
        return new JsonResponse([
            'status' => "I'm alive",
            'code' => 'ok',
        ]);
    }
}
