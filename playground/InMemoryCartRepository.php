<?php

declare(strict_types=1);

namespace App\Playground;

final class InMemoryCartRepository implements CartRepository
{

    /**
     * @var Cart[]
     */
    private array $carts = [];

    public function add(Cart $cart): void
    {
        $this->carts[] = $cart;
    }

    private function getId(Cart $cart): string
    {
        $idProperty = new ReflectionProperty($cart, 'id');

        $idProperty->setAccessible('true');

        return $idProperty->getValue($cart);
    }
}