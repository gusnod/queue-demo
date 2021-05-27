<?php


namespace Gusnod\MqDemo\TimeQueue;


use Gusnod\MqDemo\Data\ConversionMessage;
use Gusnod\MqDemo\Data\ConversionResponse;
use Gusnod\MqDemo\QueueInterface;

class Publisher
{
    public function __construct(
        private QueueInterface $queue
    ){}

    public function convert(ConversionMessage $message): ConversionResponse
    {
        $this->queue->send(Consumer::CONVERSION_QUEUE_NAME, $message->__toString());

        $message = $this->queue->receive($message->getReplyQueue());
        return ConversionResponse::fromJson($message);
    }
}