<?php

require_once __DIR__ . "/../vendor/autoload.php";

$pheanstalkFactory = function() {
    //In a more serious implementation, most of this data would be relegated to configuration files
   return \Pheanstalk\Pheanstalk::create("127.0.0.1");
};

$containerBuilder = new \DI\ContainerBuilder();
$containerBuilder->addDefinitions([
    \Pheanstalk\Pheanstalk::class => DI\factory($pheanstalkFactory),
    \Gusnod\MqDemo\QueueInterface::class => DI\get(\Gusnod\MqDemo\Queue::class),
]);


$containerBuilder->useAutowiring(true);
$container = $containerBuilder->build();

