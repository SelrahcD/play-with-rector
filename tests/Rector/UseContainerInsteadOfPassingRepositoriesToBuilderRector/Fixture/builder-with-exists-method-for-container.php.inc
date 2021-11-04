<?php

final class CartBuilderWithAnExistsMethodForContainer
{

    public function existsIn(CartRepository $cartRepository): void
    {
    }

    public function exists(\Psr\Container\ContainerInterface $container): void
    {
    }
}

class SomeTest extends \PHPUnit\Framework\TestCase {

    public function testX()
    {
        $cart = (new CartBuilderWithAnExistsMethodForContainer())->existsIn($cartRepository);
    }
}

?>
-----
<?php

final class CartBuilderWithAnExistsMethodForContainer
{

    public function existsIn(CartRepository $cartRepository): void
    {
    }

    public function exists(\Psr\Container\ContainerInterface $container): void
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
        $cart = (new CartBuilderWithAnExistsMethodForContainer())->exists($this->container);
    }
}

?>