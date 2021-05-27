<?php declare(strict_types=1);


namespace Gusnod\MqDemo\Data;


class ConversionResponse
{

    public function __construct(
        private int $value,
        private float|int $result,
        private string $from,
        private string $to
    ){}

    public function getValue(): int
    {
        return $this->value;
    }

    public function getResult(): float|int
    {
        return $this->result;
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function __toString(): string
    {
        return json_encode([
            "value" => $this->value,
            "result" => $this->result,
            "from" => $this->from,
            "to" => $this->to,
        ]);
    }

    public static function fromJson(string $json): self
    {
        $array = json_decode($json, true);
        $fields = ["value", "from", "to", "result"];
        foreach ($fields as $field) {
            if (!array_key_exists($field, $array)) {
                throw new \Exception("Field $field not found while deserializing" . self::class);
            }
        }
        return new self(
            value: $array['value'],
            result: $array["result"],
            from: $array["from"],
            to:  $array["to"],
        );
    }

}