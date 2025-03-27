<?php
 // Headers
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');

 include_once '../../config/Database.php';
 include_once '../../models/Category.php';

 // Instantiate DB & connect
 $database = new Database();
 $db = $database->connect();

 // Instantiate blog post object
 $categories = new Category($db);

 //Get ID
 $categories->id = isset($_GET['id']) ? $_GET['id'] : die();

 // Get Post
 $categories->read_single();

 // Create array
 $cat_arr = array(
    'id' => $category->id,
    'author' => $category->author,
 );

 // Make JSON
 print_r(json_encode($cat_arr));