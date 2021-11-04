<?php

final class CartBuilderWithAMethodForContainer
{

    public function existsIn(CartRepository $cartRepository): void
    {
    }

    public function aMethod(\Psr\Container\ContainerInterface $container): void
    {
    }
}

class SomeTest extends \PHPUnit\Framework\TestCase {

    public function testX()
    {
        $cart = (new CartBuilderWithAMethodForContainer())->existsIn($cartRepository);
    }
}

?>
-----
<?php

final class CartBuilderWithAMethodForContainer
{

    public function existsIn(CartRepository $cartRepository): void
    {
    }

    public function aMethod(\Psr\Container\ContainerInterface $container): void
    {
    }
}

class SomeTest extends \PHPUnit\Framework\TestCase {

    protected function setUp()
    {
        parent::setUp();
        $this->container = new InMemoryContainer();
    }
    public function testX()
    {
        $cart = (new CartBuilderWithAMethodForContainer())->aMethod($this->container);
    }
}

?>