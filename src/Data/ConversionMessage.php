<?php declare(strict_types=1);


namespace Gusnod\MqDemo\Data;


class ConversionMessage
{

    public function __construct(
        private int $value,
        private string $from,
        private string $to,
        private string $replyQueue
    ){}

    public function getValue(): int
    {
        return $this->value;
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function getReplyQueue(): string
    {
        return $this->replyQueue;
    }

    public function __toString(): string
    {
        return json_encode([
            "value" => $this->value,
            "from" => $this->from,
            "to" => $this->to,
            "replyQueue" => $this->replyQueue,
        ]);
    }

    public static function fromJson(string $json): self
    {
        $array = json_decode($json, true);
        $fields = ["value", "from", "to", "replyQueue"];
        foreach ($fields as $field) {
            if (!array_key_exists($field, $array)) {
                throw new \Exception("Field $field not found while deserializing" . self::class);
            }
        }
        return new self(
            value: $array['value'],
            from: $array["from"],
            to:  $array["to"],
            replyQueue: $array["replyQueue"],
        );
    }

}