<?php
/**
 * Created by PhpStorm.
 * User: пользователь
 * Date: 19.11.2017
 * Time: 17:20
 */

trait pushEngine {
    private function turnOnEngine()
    {
        $this->_engineWork = true;
        echo "Завели мотор<br>";
    }

    private function turnOffEngine()
    {
        $this->_engineWork = false;
        echo "Заглушили мотор<br>";
    }

    private function fun()
    {
        $this->_temperature -= self::FUN_COOLING;
        echo "Включен вентилятор. Охладили мотор на ".self::FUN_COOLING." градусов.<br>";
    }
}

trait speed {
    private function countSpeed()
    {
        $this->_speed = self::HP * $this->_countHP;
        echo "Максимальная скорость транспорта составляет - ".$this->_speed."м/с<br>";
    }
}

trait transmission {
    private function autoTransmission()
    {
        if ($this->_direction == 'forward') {
            $this->_transmission = 1;
        } elseif ($this->_direction == 'back') {
            self::backTransmission();
        }
    }

    private function manualTransmission()
    {
        if ($this->_direction == 'forward' && $this->_speed <= 20) {
            $this->_transmission = 1;
        } elseif ($this->_direction == 'forward') {
            $this->_transmission = 2;
        } elseif ($this->_direction == 'back') {
            self::backTransmission();
        }
    }

    private function backTransmission()
    {
        $this->_transmission = -1;
    }
}

class Car {
    const HP = 2;
    const BOUNDARY_TEMP = 90;
    const FUN_COOLING = 10;

    protected $_distance;
    protected $_currentDistance = 0;
    protected $_countHP = 0;
    protected $_speed = 0;
    protected $_direction = "forward";
    protected $_engineWork = false;
    protected $_transmissionType = 'manual'; // or auto
    protected $_transmission = NULL;
    protected $_temperature = 0;


    public function __construct($distance,$direction)
    {
        $this->_distance = $distance;
        $this->_direction = $direction;
        $this->engine();
    }

    private function engine()
    {
        $getTransFunc = $this->_transmissionType."Transmission";
        self::turnOnEngine();
        self::countSpeed();
        if ($this->_direction == "forward") {
            echo "Движение вперед!<br>";
        } else {
            echo "Движение назад!<br>";
        }
        while (($this->_distance - $this->_speed) >= $this->_currentDistance) {
            $prevTrans = $this->_transmission;
            self::$getTransFunc();
            if ($prevTrans != $this->_transmission) {
                echo "Включили ".$this->_transmission." передачу.<br>";
            }
            $this->_currentDistance += $this->_speed;
            $this->_temperature += round($this->_speed / 10 * 5);
            echo "Расстояние ".$this->_currentDistance."м.<br>";
            echo "Температура мотора - ".$this->_temperature."C.<br>";
            if (self::BOUNDARY_TEMP < $this->_temperature) {
                self::fun();
            }
        }
        self::turnOffEngine();
    }

    use pushEngine, speed, transmission;
}

class Niva extends Car
{
    protected $_countHP = 30;
    protected $_transmissionType = "manual";
}

new Niva (1000,"forward");