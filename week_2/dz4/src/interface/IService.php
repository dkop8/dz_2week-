<?php

interface IService
{
    public function aplly(ITariff $tariff, &$price);
    public function addInfo();
}