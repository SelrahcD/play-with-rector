<?php

declare(strict_types=1);

namespace App\Tests\Rector\UseContainerInsteadOfPassingRepositoriesToBuilderRector\Source;

use App\Playground\CartRepository;

final class CartBuilderWithAMethodForContainer
{
    public function existsIn(CartRepository $cartRepository): void
    {
    }

    public function aMethod(\Psr\Container\ContainerInterface $container): void
    {
    }
}