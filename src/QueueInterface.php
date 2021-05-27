<?php


namespace Gusnod\MqDemo;


interface QueueInterface
{
    public function send(string $queue, string $payload): void;
    public function receive(string $queue): string;
}