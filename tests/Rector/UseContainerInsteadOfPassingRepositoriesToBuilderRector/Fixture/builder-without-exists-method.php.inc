<?php

class CartBuilderWithoutMethodForContainer {

}

class SomeTest extends \PHPUnit\Framework\TestCase {

    public function testX()
    {
        $cart = (new CartBuilderWithoutMethodForContainer())->existsIn($cartRepository);
    }
}

?>
-----
<?php

class CartBuilderWithoutMethodForContainer {

}

class SomeTest extends \PHPUnit\Framework\TestCase {

    public function testX()
    {
        $cart = (new CartBuilderWithoutMethodForContainer())->existsIn($cartRepository);
    }
}

?>