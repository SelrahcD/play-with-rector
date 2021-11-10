<?php

use App\Tests\Rector\UseContainerInsteadOfPassingRepositoriesToBuilderRector\Source\CartBuilderWithoutMethodForContainer;

class SomeTest extends \PHPUnit\Framework\TestCase {

    public function testX()
    {
        $cart = (new CartBuilderWithoutMethodForContainer())->existsIn($cartRepository);
    }
}

?>
-----
<?php

use App\Tests\Rector\UseContainerInsteadOfPassingRepositoriesToBuilderRector\Source\CartBuilderWithoutMethodForContainer;

class SomeTest extends \PHPUnit\Framework\TestCase {

    public function testX()
    {
        $cart = (new CartBuilderWithoutMethodForContainer())->existsIn($cartRepository);
    }
}

?>