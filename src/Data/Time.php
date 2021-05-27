<?php declare(strict_types=1);


namespace Gusnod\MqDemo\Data;


class Time
{

    public const MILLISECOND = "MS";
    public const SECOND = "S";
    public const MINUTE = "M";
    public const HOUR = "H";
    private int $milliseconds;

    public function __construct(int $timestamp, string $format = self::MILLISECOND)
    {
        $this->milliseconds = $this->convertToMilliseconds($timestamp, $format);
    }

    private function convertToMilliseconds(int $timestamp, string $format): int
    {
        return match ($format) {
            self::MILLISECOND => $timestamp,
            self::SECOND => $timestamp * 1000,
            self::MINUTE => $timestamp * (1000 * 60),
            self::HOUR => $timestamp * (1000 * 60 * 60),
            default => throw new \Exception("Invalid format")
        };
    }

    public function format(string $format = self::MILLISECOND): float|int
    {
        return match ($format) {
            self::MILLISECOND => $this->milliseconds,
            self::SECOND => $this->milliseconds / 1000,
            self::MINUTE => $this->milliseconds / (1000 * 60),
            self::HOUR => $this->milliseconds / (1000 * 60 * 60),
            default => throw new \Exception("Invalid format")
        };
    }

}