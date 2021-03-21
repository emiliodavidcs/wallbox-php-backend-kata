#!/usr/bin/env php
<?php

require_once dirname(__FILE__) . "/bootstrap.php";
require_once dirname(__FILE__) . "/services.php";

use Symfony\Component\Console\Application;
use Kata\App\Command\NavigationCommand;

$application = new Application();

$application->add(new NavigationCommand(
    $containerBuilder->get('parser.navigation'),
    $containerBuilder->get('service.navigation')
));

$application->run();