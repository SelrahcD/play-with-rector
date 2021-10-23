<?php

declare(strict_types=1);

namespace App\Infrastructure\Templating;

use Symfony\Component\HttpFoundation\Response;

interface Templating
{
    public function render(string $templateFile, array $parameters): string;
}