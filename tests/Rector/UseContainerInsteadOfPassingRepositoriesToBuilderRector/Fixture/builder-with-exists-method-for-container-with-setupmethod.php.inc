<?php

use App\Tests\Rector\UseContainerInsteadOfPassingRepositoriesToBuilderRector\Source\CartBuilderWithAnExistsMethodForContainer;

class SomeTest extends \PHPUnit\Framework\TestCase {

    protected function setUp()
    {
        parent::setUp();
        $this->something = new Something();
    }
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
        $this->something = new Something();
        $this->container = new InMemoryContainer();
    }
    public function testX()
    {
        $cart = (new CartBuilderWithAnExistsMethodForContainer())->exists($this->container);
    }
}

?>