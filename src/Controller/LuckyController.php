<?php
declare(strict_types=1);

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class LuckyController extends AbstractController
{

    /**
     * @Route("/lucky/number")
     */
    public function numberAction(): \Symfony\Component\HttpFoundation\Response
    {
        $number = random_int(0, 100);

        return $this->render('Lucky/number.html.twig', [
            'number' => $number,
        ]);
    }
}