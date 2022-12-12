<?php

interface IService
{
    public function apply(ITariff $tariff, &$price);
    public function addInfo();
}