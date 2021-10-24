<?php

declare(strict_types=1);

namespace App\Infrastructure\Templating;

interface Templating
{
    public function render(string $templateFile, array $parameters): string;
}
