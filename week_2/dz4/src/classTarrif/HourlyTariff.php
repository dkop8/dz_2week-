<?php


class HourlyTariff extends TariffAbstract
{
    protected $priceKM = 0;
    protected $priceMin = 200/60;
    protected $nameTariff = 'Почасовой';

    protected $maxAge = 65;
    protected $minAge = 18;
    private function roundHour($minutes)
    {
        $this->min = ceil($minutes / 60) * 60;
        return ceil($minutes / 60) * 60;
    }

    public function countPrice() 
    {
        $this->min = $this->roundHour($this->min);
        return parent::countPrice();
    }
    
}