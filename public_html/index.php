<?php

error_reporting(-1);
ini_get('display_errors', 1);

$__PROJECT_DIR__ = '/nfs/stak/students/s/shogerr/projects/cs290/site/';

require_once $__PROJECT_DIR__.'vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();
$response = new Response();

$map = array(
  '/hello' => __DIR__.'/../src/hello.php'
)
/*
$path = $request->getPathInfo();
if (isset($map[$path]))
{
  ob_start();
  include $map[$path];
  response->setContent(ob_get_clean());
} else {
  $response->setStatusCode(404);
  $response->setContent('Not Found');
}
*/
//$loader = new Twig_Loader_Filesystem($__PROJECT_DIR__.'app/templates');
//$twig = new Twig_Environment($loader, array(
//  'cache' => false,
//));

//$input = $request->get('name', 'it');
//$response = new Response( $twig->render('index.html', array()) );
//$response->send();
//echo $twig->render('index.html', array());

?>
