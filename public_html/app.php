<?php
/**
 * @file   app.php
 * @Author shogerr
 * @brief  Public facing entry point for application.
 *
 * File stays in public_html folder of the application and is
 * sym linked to a user's ~/public_html to handle public requests.
 */

error_reporting(-1);
ini_get('display_errors', 1);

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/routes.php';

$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$loader = new Twig_Loader_Filesystem(__DIR__.'/../app/templates');
$twig = new Twig_Environment($loader, array(
  'cache' => false,
));

function render_template($request)
{
  extract($request->attributes->all(), EXTR_SKIP);
  ob_start();
  include sprintf(__DIR__.'/../src/pages/%s.php', $_route);

  return new Response(ob_get_clean());
}

function render_twig_template($request, $twig)
{
  extract($request->attributes->all(), EXTR_SKIP);
  return new Response( $twig->render(sprintf('%s.html', $_route), array(
    'page_source' => file_get_contents(__FILE__),
  )) );
}

try
{
  $request->attributes->add($matcher->match($request->getPathInfo()));
  $response = call_user_func($request->attributes->get('_controller'), $request, $twig);
}
catch (Routing\Exception\ResourceNotFoundException $e)
{
  echo $e->getMessage();
  $response = new Response('Not Found', 404);
}
catch (Exception $e)
{
  echo $e->getMessage();
  $response = new Response('An error has occurred', 500);
}

$response->send();

?>
