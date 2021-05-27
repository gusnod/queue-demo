<?php


class TimeTest extends \PHPUnit\Framework\TestCase
{

    public function testTimeConstruction()
    {
        $time = new \Gusnod\MqDemo\Data\Time(1, \Gusnod\MqDemo\Data\Time::HOUR);
        $this->assertEquals(3600000.0, $time->format());
        $time = new \Gusnod\MqDemo\Data\Time(1, \Gusnod\MqDemo\Data\Time::MINUTE);
        $this->assertEquals(60000.0, $time->format());
        $time = new \Gusnod\MqDemo\Data\Time(1, \Gusnod\MqDemo\Data\Time::SECOND);
        $this->assertEquals(1000.0, $time->format());
        $time = new \Gusnod\MqDemo\Data\Time(1, \Gusnod\MqDemo\Data\Time::MILLISECOND);
        $this->assertEquals(1.0, $time->format());
    }

    public function testTimeConversion()
    {
        $time = new \Gusnod\MqDemo\Data\Time(3600000.0);
        $this->assertEquals(1, $time->format($time::HOUR));
        $this->assertEquals(60, $time->format($time::MINUTE));
        $this->assertEquals(3600, $time->format($time::SECOND));
        $this->assertEquals(3600000, $time->format($time::MILLISECOND));

        $time = new \Gusnod\MqDemo\Data\Time(1);
        $this->assertEquals(0.00000027777777777777776, $time->format($time::HOUR));
        $this->assertEquals(0.000016666666666666667, $time->format($time::MINUTE));
        $this->assertEquals(0.001, $time->format($time::SECOND));
        $this->assertEquals(1, $time->format($time::MILLISECOND));
    }

    public function testException()
    {
        $this->expectException(Exception::class);
        new \Gusnod\MqDemo\Data\Time(42, "d");
    }

}