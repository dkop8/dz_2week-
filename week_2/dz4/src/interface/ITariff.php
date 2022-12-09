<?php

interface ITariff
{
    public function countPrice();
    public function addService(IService $service);
    public function getMin();
    public function getDistance();
}