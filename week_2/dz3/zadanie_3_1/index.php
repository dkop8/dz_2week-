<?php

    require('src/functions.php');

    echo "<h2> Задача №1 </h2>";
    for ($i = 0; $i < 50; $i++) {
        $masPolz[] = task1($i);
    }

    file_put_contents('users.json', json_encode($masPolz)); 

    $dataFile = task2();
    task3($dataFile);


    echo "<br><br> --------------------- <br><br>\n";
