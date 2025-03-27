<?php
 // Headers
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: DELETE');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


 include_once '../../config/Database.php';
 include_once '../../models/Category.php';

 // Instantiate DB & connect
 $database = new Database();
 $db = $database->connect();

 // Instantiate blog author object
 $categories = new Category($db);

 // Get raw posted data
 $data = json_decode(file_get_contents("php://input"));

 $categories->category=$data->category;

 // Delete author
 if($categories->delete()) {
    echo json_encode(
        array('message' => 'Category Deleted')
    );
 } else {
    echo json_encode(
        array('message' => 'Category Not Deleted')
    );
 }