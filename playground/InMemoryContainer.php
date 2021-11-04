<?php

declare(strict_types=1);

namespace App\Playground;

final class InMemoryContainer implements \Psr\Container\ContainerInterface
{
    public function get(string $id)
    {
        throw new \Exception('get() not implemented yet');
    }

    public function has(string $id)
    {
        throw new \Exception('has() not implemented yet');
    }
}