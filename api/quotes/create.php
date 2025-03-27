<?php
 // Headers
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: POST');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


 include_once '../../config/Database.php';
 include_once '../../models/Quote.php';

 // Instantiate DB & connect
 $database = new Database();
 $db = $database->connect();

 // Instantiate blog post object
 $quotes = new Quote($db);

 // Get raw posted data
 $data = json_decode(file_get_contents("php://input"));
 $quotes->quote=$data->author;
echo("made it into create");
 // Create post
 if($quotes->create()) {
    echo json_encode(
        array('id' => $quotes->id; 'quote' => $quotes->quote)
    );
 } else {
    echo json_encode(
        array('message' => 'Quote Not Created')
    );
 }