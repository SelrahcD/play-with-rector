<?php

use App\Tests\Rector\UseContainerInsteadOfPassingRepositoriesToBuilderRector\Source\CartBuilderWithAMethodForContainer;

class SomeTest extends \PHPUnit\Framework\TestCase {

    public function testX()
    {
        $cart = (new CartBuilderWithAMethodForContainer())->existsIn($cartRepository);
    }
}

?>
-----
<?php

use App\Tests\Rector\UseContainerInsteadOfPassingRepositoriesToBuilderRector\Source\CartBuilderWithAMethodForContainer;

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