<?php

declare(strict_types=1);

namespace App\Tests\Rector\UseContainerInsteadOfPassingRepositoriesToBuilderRector\Source;

use App\Playground\CartRepository;

final class CartBuilderWithAnExistsMethodForContainer
{

    public function existsIn(CartRepository $cartRepository): void
    {
    }

    public function exists(\Psr\Container\ContainerInterface $container): void
    {
    }
}