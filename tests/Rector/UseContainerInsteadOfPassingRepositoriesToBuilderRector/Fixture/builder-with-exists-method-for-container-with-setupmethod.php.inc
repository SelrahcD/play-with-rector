<?php

final class CartBuilderWithAnExistsMethodForContainerSetup
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
        $this->something = new Something();
    }
    public function testX()
    {
        $cart = (new CartBuilderWithAnExistsMethodForContainerSetup())->existsIn($cartRepository);
    }
}

?>
-----
<?php

final class CartBuilderWithAnExistsMethodForContainerSetup
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
        $this->something = new Something();
        $this->container = new InMemoryContainer();
    }
    public function testX()
    {
        $cart = (new CartBuilderWithAnExistsMethodForContainerSetup())->exists($this->container);
    }
}

?>