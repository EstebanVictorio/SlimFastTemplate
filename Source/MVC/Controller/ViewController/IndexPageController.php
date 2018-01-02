<?php


namespace Source\MVC\Controller\ViewController;

use Source\Definition\Template;
class IndexPageController extends LayoutController
{
    public function __construct($pimpleContainer,$request,$response,$params)
    {
        parent::setPageProperties($pimpleContainer,$request,$response,$params);
    }

    public function render()
    {
        $this->renderer->render($this->response,Template::INDEX_PAGE,[]);
    }
}