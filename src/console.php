<?php

require_once __DIR__ . "/bootstrap.php";

$app = new \Symfony\Component\Console\Application("MQ - Demo", "0.0.1");
$app->addCommands([
    $container->get(\Gusnod\MqDemo\Command\ConversionConsumer::class),
    $container->get(\Gusnod\MqDemo\Command\Converter::class)
]);

$app->run();
