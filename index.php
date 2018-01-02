<?php

require_once 'Source\Config\Config.php';
require_once 'Source\Boot\Bootstrapper.php';
use Source\Boot\Bootstrapper;
$kickstartSuccess = Bootstrapper::kickStart
(
    [
        'generalSettings' => \Source\Config\Config::$generalSettings,
        'slimSettings' => \Source\Config\Config::$slimSettings
    ]
);