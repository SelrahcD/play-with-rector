<?php

use App\Tests\Rector\UseContainerInsteadOfPassingRepositoriesToBuilderRector\Source\CartBuilderWithAnExistsMethodForContainer;

class SomeTest extends \PHPUnit\Framework\TestCase {

    public function testX()
    {
        $cart = (new CartBuilderWithAnExistsMethodForContainer())->existsIn($cartRepository);
    }
}

?>
-----
<?php

use App\Tests\Rector\UseContainerInsteadOfPassingRepositoriesToBuilderRector\Source\CartBuilderWithAnExistsMethodForContainer;

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