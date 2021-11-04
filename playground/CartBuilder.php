<?php

declare(strict_types=1);
namespace App\Playground;

final class CartBuilder
{
    private string $id;

    public function __construct()
    {
        $this->id = 'id-' . random_int(0, 1000);
    }


    public function withId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function existsIn(CartRepository $cartRepository): Cart
    {
        $cart = $this->build();

        $cartRepository->add($cart);

        return $cart;
    }

    private function build(): Cart
    {
        return new Cart($this->id);
    }
}