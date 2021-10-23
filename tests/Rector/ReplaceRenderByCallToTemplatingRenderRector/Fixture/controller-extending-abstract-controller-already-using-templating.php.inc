<?php

final class AController extends Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    public function __construct(private \App\Infrastructure\Templating\Templating $templating)
    {
    }
    public function method()
    {
        return new \Symfony\Component\HttpFoundation\Response($this->templating->render('template', []));
    }
}
?>
-----
<?php

final class AController extends Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    public function __construct(private \App\Infrastructure\Templating\Templating $templating)
    {
    }
    public function method()
    {
        return new \Symfony\Component\HttpFoundation\Response($this->templating->render('template', []));
    }
}
?>
