<?php
 // Headers
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');

 include_once '../../config/Database.php';
 include_once '../../models/Author.php';

 // Instantiate DB & connect
 $database = new Database();
 $db = $database->connect();

 // Instantiate blog post object
 $authors = new Author($db);

 //Get ID
 $authors->id = isset($_GET['id']) ? $_GET['id'] : die();

 // Get Post
 $authors->read_single();

 // Create array
 $author_arr = array(
    'id' => $author->id,
    'author' => $author->author,
 );

 // Make JSON
 print_r(json_encode($author_arr));