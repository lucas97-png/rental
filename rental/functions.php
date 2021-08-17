<?php
require_once('admin/sqlconnect.php');

function getCars($type) {
    
    global $mysqli;


    switch($type) {
        case 'available':
            $sql = "SELECT cars.id,cars.name,cars.photo_url,cars.type,cars.price FROM cars WHERE available = 1";
        break;
        case 'unavailable':
            $sql = "SELECT cars.id,cars.name,cars.photo_url,cars.type,cars.price, reservations.to_date FROM cars INNER JOIN reservations ON cars.id = reservations.car_id WHERE cars.available = 0";
        break;
        case 'select':
            $sql = "SELECT cars.id,cars.name FROM cars WHERE available = 1";
        break;
    }
    
    $result = $mysqli->query($sql);

    $rows = $result->fetch_all(MYSQLI_ASSOC);

    return $rows;
};


function generateDashboard() {
    
    global $mysqli;

    $sql = "SELECT cars.name, clients.surname, reservations.cost, reservations.to_date FROM reservations INNER JOIN cars ON cars.id = reservations.car_id INNER JOIN clients ON clients.id = reservations.client_id";

    $result = $mysqli->query($sql);

    $rows = $result->fetch_all(MYSQLI_ASSOC);

    return $rows;
}


function reserve($name, $surname, $phoneNumber, $carId, $date, $days, $hours) {
    global $mysqli;

    $from_date = $date;

    $to_date = date('Y-m-d H:i', strtotime($from_date. '+ ' .$days.' days +' .$hours.' hours'));

    $sql = "SELECT price,name,available name FROM cars WHERE id = $carId";
    $result = $mysqli->query($sql);
    $row = $result->fetch_row();

    $price = $row[0];
    $carName = $row[1];
    $available = $row[2];

    if($available != 1) {
        die('Samochód zajęty');
    }

    $cost = ($days * 24 + $hours) * $price;

    

    $sqlSecond = "INSERT INTO clients(name,surname,phone_number) VALUES (?,?,?)";

    if($stmt = $mysqli->prepare($sqlSecond)) {
        
        if($stmt->bind_param('sss', $name, $surname, $phoneNumber)) {
            $stmt->execute();
            
            $client_id = $mysqli->insert_id;
        
            $sqlThird = "INSERT INTO reservations(client_id,car_id,from_date,to_date,cost) VALUES (?,?,?,?,?)";
               
                if($stmtSecond = $mysqli->prepare($sqlThird)) {
                    if($stmtSecond->bind_param('iissi',$client_id,$carId,$from_date,$to_date,$cost)) {
                        
                        

                        $stmtSecond->execute();
                        
                        

                        $mysqli->query("UPDATE cars SET available = 0 WHERE id = $carId");

                        

                        header("Location: index.php");
                    }
                }
        } else {
            die('Niepoprawne dane');
        }
    }

    
}




