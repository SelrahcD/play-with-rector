<?php

final class AController extends Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    public function method()
    {
        $response = new \Symfony\Component\HttpFoundation\Response('content', \Symfony\Component\HttpFoundation\Response::HTTP_FOUND);

        return $this->render('template', [], $response);
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
        $response = new \Symfony\Component\HttpFoundation\Response('content', \Symfony\Component\HttpFoundation\Response::HTTP_FOUND);

        return $response->setContent($this->templating->render('template', []));
    }
}
?>