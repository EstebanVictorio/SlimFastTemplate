# SlimFastTemplate
An Easy Slim Framework Template Implementation to fasten development in PHP without having a big bunch of files regarding routes and Front End components.


All credits on Slim Framework goes to the authors on [Slim Framework](https://www.slimframework.com/), whic was Created and is currently maintained by Josh Lockhart, Andrew Smith, Rob Allen, and the Slim Framework Team. Further info on their site.


## Highlights

Sometimes we look for an starting point on how to structure a project and end up doing a mess with our files and project
requirements that extend to a point of no return, and when it comes to sharing our project, culture of the latter 
spreads all over the team members involved.

This project structure template offers a simple approach so you can keep order and track all your nicely done features.

## Requirements
In order to use this template, the following are required:

* [Composer](https://getcomposer.org/): A dependency manager for PHP. 
* [Slim](https://www.slimframework.com/): The main framework of this project template, mentioned above.
* [Twig](https://twig.symfony.com/): A PHP Template Engine.

All credits go to their respective owners.

## Template Main Structure
    .
    ├── Boot                  # Anything related to kickstart an app
    ├── Config                # Configuration Settings
    ├── Definition            # "Enum" like Definitions, to avoid hardcoded paths and the like
    ├── Exceptions            # Exceptions/Errors related to an app, as well as the ExceptionHandler 
    ├── MVC                   # MVC Pattern Utilities
    └── Routing               # Anything related to an app routes, such as Views or Processing Requests


## Bootstrapping an app
As an example of this, you can bootstrap your app in a very simple way, as the one performed in the index file:

```php
<?php
// First, we gather every setting we defined on our Config file
require_once 'Source\Config\Config.php';  
// Then we require our Bootstrapper Class which helps us retrieve everything we need according to our app  
require_once 'Source\Boot\Bootstrapper.php';

// By this point, the only namespace we need to explicitly use is the one that our Bootstrapper Class is in.
use Source\Boot\Bootstrapper;

// Finally, we attempt to kickstart our app for good
// Autoload Configuration is done in the Bootstrapper Class once we attempt to kickstart.
$kickstartSuccess = Bootstrapper::kickStart  
(  
    [  
        'generalSettings' => \Source\Config\Config::$generalSettings,  
        'slimSettings' => \Source\Config\Config::$slimSettings  
    ]
);
```

If you wish to use your own kickstarting approach, go ahead. 


## Additional Configuration

If you wish, you can set your own additional configuration in the Config class located in the Config folder:

```php
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
    // TODO: Set your additional settings from here and onward
}
```

After setting your configuration settings (as a public static array), you may retrieve the information later
on the Bootstrapper class, which is known to pass the initial configuration to the classes later.


## Definitions
This section is meant to serve the mere purpose of giving our code the notion of what we are handling in that moment for
the developer. This means that, when writing, we know what we refer to; hence, a good programming culture may arise
from everyone in the project, although you can define your own when customizing the template for your own purposes.

An example of this are the Template paths:

```php
<?php

namespace Source\Definition;

class Template
{
    // A constant definition for our index page template
    // We can retrieve it later by the class reference with Template::INDEX_PAGE
    const INDEX_PAGE = 'Templates/index.html.twig';
}
```


## Routing
As Slim lets us define our route in a very particular way, we can give a cleaner approach at keeping them in a class
rather than a file alone (usually called routes.php and requiring it after), we can set our routes in our 
RouteBootstrapper class, be it a view rendering route or a route that only processes request to give an expected
response.

Routes will either go either way (as a View or as a particular request) in the following methods of the class:
```php
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

    // All View rendering routes are located here
    private function _registerRenderingRoutes()
    {
        $this->slimApp->get(Route::HELLO_WORLD, function ($request, $response, $params) {
            $indexPageController = new ViewController\IndexPageController($this, $request, $response, $params);
            $indexPageController->render();
        });
        // TODO: Write your view requests routes from here and onward
    }

    // All processing request routes are located here
    private function _registerProcessingRoutes()
    {
        // TODO: Write any particular requests routes from here and onward
    }
}
```

## About Upcoming Updates
I'll keep this template updated as much as I can and If you have any questions or problems or comments about it, feel
free to let me know. :)

Best Regards!

#### Sincerely,
##### Esteban Victorio


# License
This template is available as an open source project under the terms of the MIT License.
