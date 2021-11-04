<?php

declare(strict_types=1);

namespace App\Playground;

final class FakeCartTest
{

    /**
    * @test
    */
    public function it_tests_something(): void {
        $cartRepository = new InMemoryCartRepository();

        $cart = (new CartBuilder())
            ->withId('id-12')
            ->existsIn($cartRepository);

    }
}