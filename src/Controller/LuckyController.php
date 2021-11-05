<?php

declare(strict_types=1);

namespace App\Controller;

use App\Infrastructure\Templating\Templating;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class LuckyController extends AbstractController
{
    /**
     * @Route("/lucky/number")
     */
    public function numberAction()
    {
        $number = random_int(0, 100);

        return $this->render('Lucky/number.html.twig', [
            'number' => $number,
        ]);
    }
}
