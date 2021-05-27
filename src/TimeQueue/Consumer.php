<?php


namespace Gusnod\MqDemo\TimeQueue;


use Gusnod\MqDemo\Data\ConversionMessage;
use Gusnod\MqDemo\Data\ConversionResponse;
use Gusnod\MqDemo\Data\Time;
use Gusnod\MqDemo\QueueInterface;

class Consumer
{
    public const CONVERSION_QUEUE_NAME = "conversion";

    public function __construct(
        private QueueInterface $queue
    ){}

    public function processConversions(?callable $feedback = null): void
    {
        while (true) {
            $message = $this->queue->receive(self::CONVERSION_QUEUE_NAME);
            $conversionMessage = ConversionMessage::fromJson($message);
            $time = new Time($conversionMessage->getValue(), $conversionMessage->getFrom());
            $conversionResponse = new ConversionResponse(
                $conversionMessage->getValue(),
                $time->format($conversionMessage->getTo()),
                $conversionMessage->getFrom(),
                $conversionMessage->getTo()
            );
            if (!is_null($feedback)) {
                $feedback(
                    sprintf("Converted to %s from %s Was: %s is now %s. Published to queue: %s",
                        $conversionResponse->getResult(),
                        $conversionResponse->getValue(),
                        $conversionResponse->getFrom(),
                        $conversionResponse->getTo(),
                        $conversionMessage->getReplyQueue()
                    )
                );
            }
            $this->queue->send($conversionMessage->getReplyQueue(), $conversionResponse->__toString());
        }
    }
}