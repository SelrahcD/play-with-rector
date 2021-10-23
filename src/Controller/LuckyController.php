<?php

declare(strict_types=1);

namespace App\Controller;

use App\Infrastructure\Templating\Templating;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class LuckyController extends AbstractController
{
    public function __construct(private Templating $templating)
    {
    }
    /**
     * @Route("/lucky/number")
     */
    public function numberAction(): Response
    {
        $number = random_int(0, 100);

        return new Response($this->templating->render('Lucky/number.html.twig', [
            'number' => $number,
        ]));
    }
}
