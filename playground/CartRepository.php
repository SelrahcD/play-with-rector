<?php

declare(strict_types=1);

namespace App\Playground;

interface CartRepository
{
    public function add(Cart $cart): void;
}