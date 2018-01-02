<?php


namespace Source\MVC\Controller\ViewController;


use Pimple\Container;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

abstract class LayoutController
{
    /**
     * @var $pimpleContainer Container
     */
    protected $pimpleContainer;

    /**
     * @var $renderer Twig
     */
    protected $renderer;

    /**
     * @var $request Request
     */
    protected $request;

    /**
     * @var $request Response
     */
    protected $response;

    /**
     * @var $params array
     */
    protected $params;

    protected function setPageProperties($pimpleContainer,$request,$response,$params){
        $this->pimpleContainer = $pimpleContainer;
        $this->renderer = $this->pimpleContainer['renderer'];
        $this->request = $request;
        $this->response = $response;
        $this->params = $params;
    }

}