<?php

class ATest extends \PHPUnit\Framework\TestCase
{

    public function testX()
    {
        $container = new Container();

        $builder = new Builder();

        $builder->build($container);
    }
}
?>
-----
<?php

class ATest extends \PHPUnit\Framework\TestCase implements TestContext
{

    public function getContainer(): Container
    {
        return new Container();
    }
    public function testX()
    {
        $container = new Container();

        $builder = new Builder();

        $builder->buildWithContext($this);
    }
}
?>
