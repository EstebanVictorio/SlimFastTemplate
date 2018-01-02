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

If you wish to use your own kickstarting approach, go ahead. We all here attempt to ease our work. :)



#About Upcoming Updates
I'll keep this template updated as much as I can and If you have any questions or problems or comments about it, feel
free to let me know. :)

Best Regards!

#### Sincerely,
#####Esteban Victorio


# License
This template is available as an open source project under the terms of the MIT License.
