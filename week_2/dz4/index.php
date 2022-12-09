<?php

    include 'src/AddedService.php';
    include 'src/TariffAbstract.php';
    include 'src/classTarrif/TariffBasic.php';
    include 'src/classTarrif/TariffStudent.php';
    include 'src/classTarrif/tariffHourly.php';
    


    echo "<h2> Базовый тариф </h2>";
    $tariff = new BasicTariff();
    $user1 = $tariff->activateTariff(5, 5, 18);
    if ($user1) {
        $tariff->addService(new AddedService('GPS'));
        // $tariff->addService(new AddedService('Driver'));
        echo $tariff->orderTrip() . "<br>";
    }

    echo "<h2> Базовый тариф: две доп. услуги </h2>";
    $tariff2 = new BasicTariff();
    $user2 = $tariff2->activateTariff(5, 60, 18);

    if ($user2) {
        $tariff2->addService(new AddedService('Driver'));
        $tariff2->addService(new AddedService('GPS'));
        echo $tariff2->orderTrip();
    }

    echo "<h2> Студенческий тариф:</h2>";

    $tariff3 = new BasicTariff();
    $user3 = $tariff3->activateTariff(10, 180, 18);

    if ($user3) {
        $tariff3->addService(new AddedService('Driver'));
        $tariff3->addService(new AddedService('GPS'));
        echo $tariff3->orderTrip();
    }

    echo "<h2> Студенческий тариф - возраст меньше 18:</h2>";

    $tariff4 = new BasicTariff();
    $user4 = $tariff4->activateTariff(5, 60, 16);

    if ($user4) {
        echo $tariff4->orderTrip();
    }


    echo "<h2> Почасовой тариф </h2>";
    $tariff5 = new HourlyTariff();
    $user5 = $tariff5->activateTariff(5, 5, 18);
    if ($user5) {
        $tariff5->addService(new AddedService('GPS'));
        echo $tariff5->orderTrip() . "<br>";
    }




