<?php



namespace Source\Routing;

use Source\Definition\Route;
use Source\Definition\Path;

use Source\MVC\Controller\ViewController;

use Slim\App;
use Slim\Views\Twig as Renderer;

use Pimple\Container;

class RouteBootstrapper
{
    /**
     * @var App Slim App Object.
     * Intended to register routes
     */
    private $slimApp = null;

    /**
     * @var Container Pimple Container
     * Intended to register renderer
     */
    private $pimpleContainer = null;


    public function __construct($slimApp, $pimpleContainer)
    {
        $this->slimApp = $slimApp;
        $this->pimpleContainer = $pimpleContainer;
    }

    public function registerRoutes()
    {
        $this->_prepareRenderer();
        $this->_registerRenderingRoutes();
        $this->_registerProcessingRoutes();
    }

    /**
     * Registers our renderer from the Twig Template Engine on our Pimple Container.
     */
    private function _prepareRenderer()
    {
        $this->pimpleContainer['renderer'] = function ($container) {
            return new Renderer(Path::getPaths()['MVC']['VIEWS'], []);
        };
    }

    private function _registerRenderingRoutes()
    {
        $this->slimApp->get(Route::HELLO_WORLD, function ($request, $response, $params) {
            $indexPageController = new ViewController\IndexPageController($this, $request, $response, $params);
            $indexPageController->render();
        });
        // TODO: Write your view requests routes from here and onward
    }

    private function _registerProcessingRoutes()
    {
        // TODO: Write any particular requests routes from here and onward
    }

}