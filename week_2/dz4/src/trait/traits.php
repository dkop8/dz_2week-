<?php

    trait GPS 
    {
        private $priceGPS = 15;
        private $hours;

        public function setGPS($tariff) 
        {
            $this->hours = ceil($tariff->getMin() / 60);
            return $this->hours * $this->priceGPS; 
        }
    }

    trait AddDriver
    {
        private $priceDriver = 100;
        public function addDriver() 
        {
            return $this->priceDriver;
        }
    }