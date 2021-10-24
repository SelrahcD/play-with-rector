<?php

declare(strict_types=1);

namespace App\Infrastructure\Templating;

use Twig\Environment;

final class TwigTemplating implements Templating
{
    public function __construct(private Environment $twig)
    {
    }

    public function render(string $templateFile, array $parameters): string
    {
        return $this->twig->render($templateFile, $parameters);
    }
}
