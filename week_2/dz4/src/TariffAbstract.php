<?php
    include 'interface/ITariff.php';
    
    abstract class TariffAbstracrt implements ITariff
    {
        protected $nameTariff;
        protected $priceKM;
        protected $priceMin;
        protected $distance;
        protected $min;
        protected $price;
        protected $services = [];

        protected $maxAge;
        protected $minAge;

        public function activateTariff(int $distance, int $minutes, int $age) 
        {
            if ($age >= $this->minAge && $age <= $this->maxAge) {
                $this->distance = $distance;
                $this->min = $minutes;
                return true;
            } else {
                echo "Данный тариф Вам недоступен.";
                return false;
            }
        }

        public function countPrice() 
        {
            $price = $this->priceKM * $this->distance + $this->priceMin * $this->min;
            $final = [];
            $final += $this->countPriceAddService($price);
            return $final;
        }

        public function countPriceAddService($price) 
        {
            if ($this->services) {
                $final = ['finalPrice' => $price];
                foreach ($this->services as $service) {
                    $rez = $service->aplly($this, $price);

                    if ($rez['priceServiceGPS'] != 0) {
                        $final += [
                            'priceServiceGPS' => $rez['priceServiceGPS'],
                        ];
                    }
                    
                    if ($rez['priceAddDriver'] != 0) {
                        $final += [
                            'priceAddDriver' => $rez['priceAddDriver'],
                        ];   
                    }
                    $final['finalPrice'] = $rez['final'];

                }

                $final += [
                    'km' => $this->priceKM * $this->distance,
                    'min' => $this->priceMin * $this->min,
                ];
                $this->price = $final['finalPrice'];
            }

            return $final;
        }
        public function orderTrip () 
        {
            echo "Тариф {$this->nameTariff} ({$this->distance} км, {$this->min} минут). <br>";
            $listPrice = $this->countPrice();

            $str = '';
            $infoAddedService = '';
            $dop = ''; 
            
            if ($this->services) {
                foreach ($this->services as $service) {
                    $str .= ' + ' . $service->addInfo();
                    $infoAddedService .= " " .  $service->getInfoService() . "<br>";
                }
                echo $infoAddedService . "<br>";

            }

            if (isset($listPrice['priceServiceGPS']) && $listPrice['priceServiceGPS'] != 0) {
                $dop = " + {$listPrice['priceServiceGPS']}";
            }
            if (isset($listPrice['priceAddDriver']) && $listPrice['priceAddDriver'] != 0) {
                $dop .= " + {$listPrice['priceAddDriver']}";
            }

            if (is_float($this->priceMin)) {
                $this->priceMin = number_format($this->priceMin, 1);
            }
            echo "= {$this->distance} км * {$this->priceKM} руб / км + {$this->min} мин * {$this->priceMin} руб / мин {$str}= {$listPrice['km']} + {$listPrice['min']} {$dop}= {$this->price} <br><br>";
        }

        public function addService(IService $service) 
        {
            array_push($this->services, $service);
            return $this;
        }
        public function getMin() 
        {
            return $this->min;
        }
        public function getDistance() 
        {
            return $this->distance;
        }
    }