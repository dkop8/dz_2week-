<?php
    require('function.php');


    firstRun();
    getUsers();
    getOrder();

        if ($_POST['name'] !== '' && $_POST['email'] !== '' && $_POST['phone'] !== '' && $_POST['street'] !== '' && $_POST['home'] !== '' && $_POST['part'] !== '' && $_POST['appt'] !== '' && $_POST['floor']) {
            $emailPolz = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    
            $masEmailUsers = getListEmailUsers();
            if (array_search($emailPolz, $masEmailUsers) === false) {
                $user = addUser([
                    'name' => $_POST['name'], 
                    'email' => $emailPolz,
                    'phone' => $_POST['phone'],
                    'street' => $_POST['street'],
                    'home' => $_POST['home'],
                    'part' => $_POST['part'],
                    'appt' => $_POST['appt'],
                    'floor' => $_POST['floor'],
                ]);
            } else {
                $idUser = array_search($emailPolz, $masEmailUsers);
                $user = $masUsers[$idUser];
            }
    
    
            $newOrder = addOrder($user['id'], ['payment' => $_POST['payment'], 'callback' => $_POST['payment'], 'comment' => $_POST['comment'], 'address' => $user['address']]);
    
            echo "Спасибо, ваш заказ будет доставлен по адресу: улица {$newOrder['address']['street']} дом {$newOrder['address']['home']}, корпус {$newOrder['address']['part']}, квартира {$newOrder['address']['appt']}, этаж {$newOrder['address']['floor']}. <br> \n";
            echo "Номер вашего заказа: {$newOrder['id']} <br> \n";
            echo "Это ваш " . getCountOrder($user['id']) . "-й заказ! \n";

        } else {
            trigger_error("Отправленны не все данные");
            return 0;
        }
