<?php
 // Headers
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: POST');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


 include_once '../../config/Database.php';
 include_once '../../models/Author.php';

 // Instantiate DB & connect
 $database = new Database();
 $db = $database->connect();

 // Instantiate blog post object
 $authors = new Author($db);

 // Get raw posted data
 $data = json_decode(file_get_contents("php://input"));
 $authors->author=$data->author;
echo("made it into create");
 // Create post
 if($authors->create()) {
    echo json_encode(
        array('id' => $authors->id; 'author' => $authors->author)
    );
 } else {
    echo json_encode(
        array('message' => 'Author Not Created')
    );
 }