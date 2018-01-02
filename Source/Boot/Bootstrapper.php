<?php


//<editor-fold desc="Namespace Declaration & Usage">
namespace Source\Boot;

use Slim\App;
use Pimple\Container;
use Source\Routing\RouteBootstrapper;

//</editor-fold>

/**
 * Class Bootstrapper
 * @package Source\Boot
 */
class Bootstrapper
{
    //<editor-fold desc="Class Properties">

    //<editor-fold desc="Private">
    /**
     * @var bool Determines whether you can run this app or not
     */
    private static $canKickStart = false;



    /**
     * @var $slimApp App
     */
    private static $slimApp = null;

    /**
     * @var $pimpleContainer Container
     */
    private static $pimpleContainer = null;

    /**
     * @var $routeBootstrapper RouteBootstrapper
     */
    private static $routeBootstrapper = null;

    //</editor-fold>

    //</editor-fold>

    //<editor-fold desc="Class Methods">

    //<editor-fold desc="Public">
    /**
     * @param $settings array Overall Settings
     * @return true if everything went as expected, false otherwise.
     */
    public static function kickStart($settings)
    {
        // First, we set our debug 
        self::_bootDebug($settings['generalSettings'], $settings['debugSettings']);
        self::_gatherSlimResources();
        self::_configureAutoload();
        self::_bootSlimApp($settings['slimSettings']);
        return self::$canKickStart;
    }
    //</editor-fold>

    //<editor-fold desc="Private">
    /**
     * Enables Overall Debugging
     * @param $generalSettings array General Settings for runtime
     * @param $debugSettings array Settings for runtime
     * @return bool
     */
    private static function _bootDebug($generalSettings, $debugSettings)
    {
        self::_bootPHPDebug($generalSettings['isDebugEnabled']);
        return self::_bootCustomDebug($debugSettings);
    }

    /**
     * Enables PHP Debugging
     * @param $isDebugEnabled bool true if enabled, false otherwise.
     * @return void
     */
    private static function _bootPHPDebug($isDebugEnabled = false)
    {
        ini_set('display_errors', $isDebugEnabled);
        error_reporting(E_ALL);
    }

    /**
     * Boots Custom Debug
     * @param $debugSettings
     * @return bool
     */
    private static function _bootCustomDebug($debugSettings)
    {
        return self::$debugBooted;
    }

    /**
     * Performs Script Requires
     */
    private static function _gatherSlimResources()
    {
        //TODO: Implement requires

    }

    /**
     * Helps us configure our autoload manager.
     */
    private static function _configureAutoload()
    {
        require __DIR__ . '/../../vendor/autoload.php';
        spl_autoload_register(function ($class) {
            self::$canKickStart = self::_attemptClassRequire($class);
        });
    }

    private static function _attemptClassRequire($class)
    {
        $classPath = __DIR__ . '/../../' .$class . '.php';
        if (file_exists($classPath)) {
            require_once $classPath;
            return true;
        }
        return false;
    }

    /**
     * @param $slimSettings array Slim Framework Settings
     * Creates our Slim App Object, which helps us with the Pimple Container too.
     */
    private static function _bootSlimApp($slimSettings)
    {
        self::$slimApp = new App(['settings' => $slimSettings]);
        self::$pimpleContainer = self::$slimApp->getContainer();
        self::$routeBootstrapper = new RouteBootstrapper(self::$slimApp,self::$pimpleContainer);
        self::$routeBootstrapper->registerRoutes();
        self::$slimApp->run();
    }
    //</editor-fold>

    //</editor-fold>
}