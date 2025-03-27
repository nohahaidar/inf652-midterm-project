<?php
 // Headers
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');

 include_once '../../config/Database.php';
 include_once '../../models/Quotes.php';

 // Instantiate DB & connect
 $database = new Database();
 $db = $database->connect();

 // Instantiate category object
 $quotes = new Quote($db);

 // Category read query
 $result = $quotes->read();
 //Get row count
 $num = $result->rowCount();

 // Check if any categories
 if($num > 0) {
    // Cat array
    $quote_arr = array();
    $quote_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $quote_item = array(
            'id' => $id,
            'name' => $name
        );

        // Push to "data"
        array_push($quote_arr['data'], $quote_item);
    }

    //Turn to JSON & output
    echo json_encode($quote_arr);

 } else {
     // No Categories
     echo json_encode(
        array('message' => 'No Quote Found')
     );
 }