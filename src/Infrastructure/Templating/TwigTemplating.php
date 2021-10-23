<?php

declare(strict_types=1);

namespace App\Infrastructure\Templating;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class TwigTemplating implements Templating
{


    public function __construct(private Environment $twig)
    {
    }

    public function render(string $templateFile, array $parameters): Response
    {
        return $this->twig->render($templateFile, $parameters);
    }
}