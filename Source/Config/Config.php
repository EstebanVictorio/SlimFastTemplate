<?php


namespace Source\Config;
class Config
{
    public static $generalSettings =
        [
            'isDebugEnabled' => true
        ];
    public static $slimSettings =
        [
            'displayErrorDetails' => true, // set to false in production
            'addContentLengthHeader' => false, // Allow the web server to send the content-length header
            'determineRouteBeforeAppMiddleware' => true,

        ];
    public static $debugSettings =
        [

        ];





}