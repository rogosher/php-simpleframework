<?php
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add('home', new Routing\Route('/', array(
  '_controller' => 'render_twig_template',
)));
$routes->add('hello', new Routing\Route('/hello/{name}', array(
  'name' => 'World',
  '_controller' => 'render_template',
)));
$routes->add('assignment', new Routing\Route('/assignment/{id}', array(
  'id' => '1',
  '_controller' => 'render_template',
)));
$routes->add('source', new Routing\Route('/source/{name}', array(
  'name' => 'app',
  '_controller' => 'render_template',
)));

$routes->add('bye', new Routing\Route('/bye'));

return $routes;
?>
