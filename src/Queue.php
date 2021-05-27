<?php


namespace Gusnod\MqDemo;


use Pheanstalk\Pheanstalk;

class Queue implements QueueInterface
{

    public function __construct(
        private Pheanstalk $pheanstalk
    ){}

    public function send(string $queue, string $payload): void
    {
        $this->pheanstalk->useTube($queue)
            ->put($payload);

    }

    public function receive(string $queue): string
    {
        $this->pheanstalk->watch($queue);
        $job = $this->pheanstalk->reserve();
        $payload = $job->getData();
        $this->pheanstalk->delete($job);
        return $payload;
    }

}