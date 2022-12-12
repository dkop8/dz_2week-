<?php

include 'trait/traits.php';
include 'interface/IService.php';

class AddedService implements IService
{
    use AddDriver;
    use GPS;
    private $typeService;
    private $nameService;
    public function __construct(string $typeService) 
    {
        if ($typeService == 'GPS') {
            $this->nameService = 'GPS';

        } elseif ($typeService == 'Driver') {
            $this->nameService = 'Дополнительный водитель';
        }
        $this->typeService = $typeService;
    }
    
    public function apply ($tariff, &$price) 
    {
        $rez = [
            'priceServiceGPS' => 0,
            'priceAddDriver' => 0,
            'final' => $price,
        ];
        if ($this->typeService == 'GPS') {
            $additionalPrice = $this->setGPS($tariff);
            $rez['priceServiceGPS'] = $additionalPrice;
        } elseif ($this->typeService == 'Driver') {
            $additionalPrice = $this->addDriver();
            $rez['priceAddDriver'] = $additionalPrice;
        }
        $price = $price + $additionalPrice;
        $rez['final'] = $price;
        return $rez;
    }

    public function getInfoService() 
    {
        return "- добавить услугу {$this->nameService}";
    }
    public function addInfo () 
    {
        if ($this->typeService == 'GPS') {
            return "{$this->priceGPS} руб/час * {$this->hours}";
        } elseif ($this->typeService == 'Driver') {
            return "{$this->priceDriver} руб";
        }

    }
}