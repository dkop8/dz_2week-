<?php
    $nameFileUsers = 'users.json';
    $nameFileOrder = 'orders.json';
    $masUsers;
    $masOrder;


function firstRun() {
    global $nameFileUsers;
    global $nameFileOrder;

    if (!file_exists($nameFileUsers)) {
        file_put_contents($nameFileUsers, json_encode([]));
    }

    if (!file_exists($nameFileOrder)) {
        file_put_contents($nameFileOrder, json_encode([]));
    }

}

function getListEmailUsers () {
    global $nameFileUsers;
    if (file_exists($nameFileUsers)) {
        $tempArray = json_decode(file_get_contents($nameFileUsers), true);
        return array_column($tempArray, 'email');
    }
}

function getUsers () {
    global $nameFileUsers;
    global $masUsers;

    if (file_exists($nameFileUsers)) {
        $masUsers = json_decode(file_get_contents($nameFileUsers), true);
        return $masUsers;
    } else {
        trigger_error('Файл с пользователями не найден');
        return 0;
    }
}

function getOrder () {
    global $masOrder;
    global $nameFileOrder;

    if (file_exists($nameFileOrder)) {
        $masOrder = json_decode(file_get_contents($nameFileOrder), true);
    } else {
        trigger_error('Файл с заказами не найден');
        return 0;
    }
}

function addUser (array $infoPolz) {
    global $nameFileUsers;
    global $masUsers;

    if (file_exists($nameFileUsers)) {
        // $masUsers = getUsers();
        $newUser = [
            'id' => count($masUsers),
            'name' => $infoPolz['name'],
            'email' => $infoPolz['email'],
            'phone' => $infoPolz['phone'],
            'address' => [
                'street' => $infoPolz['street'],
                'home' => $infoPolz['home'],
                'part' => $infoPolz['part'],
                'appt' => $infoPolz['appt'],
                'floor' => $infoPolz['floor'],
            ],
        ];

        array_push($masUsers, $newUser);
        file_put_contents($nameFileUsers, json_encode($masUsers));

        return $newUser;

    }

}

function addOrder (int $idUser, array $infoOrder) {

    global $nameFileUsers;
    global $nameFileOrder;
    global $masUsers;
    global $masOrder;
    
    if (file_exists($nameFileUsers) && file_exists($nameFileOrder)) {
        if (is_int($idUser)) {
            if ($masUsers[$idUser]) {

                $newOrder = [
                    'id' => count($masOrder) !== 0 ? count($masOrder) : 1,
                    'id_user' => $idUser, 
                    'payment' => $infoOrder['payment'],
                    'callback' => $infoOrder['callback'],
                    'date' => date("d-m-Y, H:i"),
                    'address' => $infoOrder['address'],
                    'comment' => $infoOrder['comment'],
                ];

                array_push($masOrder, $newOrder);
                file_put_contents($nameFileOrder, json_encode($masOrder));

                return $newOrder;

            } else {
                trigger_error('Пользователя с таким id не найдено');
                return 0;                
            }

        }
    } else {
        trigger_error('Файл с пользователями или файл с заказамми не найден');
        return 0;
    }
}

function getCountOrder (int $idUser) {
    global $masOrder;
    $countOder = 0;
    for ($i = 0; $i < count($masOrder); $i++) {
        $mas = $masOrder[$i];
        if ($mas['id_user'] === $idUser) {
            $countOder++;
        }
    }
    return $countOder;
}
