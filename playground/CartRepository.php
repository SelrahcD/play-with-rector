<?php

declare(strict_types=1);


interface CartRepository
{
    public function add(Cart $cart): void;
}