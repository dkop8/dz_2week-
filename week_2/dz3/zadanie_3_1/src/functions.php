<?php
    
    function task1 ($i) {
        $masName = ['Вася', 'Петя', 'Маша', 'Наташа', 'Андрей'];
            $newUser = [
                'id' => $i,
                'name' => $masName[random_int(0, 4)],
                'age' => random_int(18, 45),
            ];
        return $newUser;
    }

    function task2 (string $fileName = 'users.json') {
        return json_decode(file_get_contents($fileName));
    }

    function task3 (array $masPolz) {
        if (!is_array($masPolz)) {
            trigger_error("Получен не массив с пользователями");
            return 0;
        }
        $namePolz = array_column($masPolz, 'name');
        $countName = array_count_values($namePolz);
        
        foreach ($countName as $name => $value) {
            echo "Имя <b><i>{$name}</i></b> встречается - {$value} раз. <br>\n";
        }

        $agePolz = array_column($masPolz, 'age');
        $avAge = round(array_sum($agePolz) / count($agePolz));
        echo " Средний возраст пользователей <b><i>{$avAge}</i></b>";
    }