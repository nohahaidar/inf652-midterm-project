<?php
 // Headers
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');

 include_once '../../config/Database.php';
 include_once '../../models/Quote.php';

 // Instantiate DB & connect
 $database = new Database();
 $db = $database->connect();

 // Instantiate blog post object
 $quotes = new Quote($db);

 //Get ID
 $quotes->id = isset($_GET['id']) ? $_GET['id'] : die();

 // Get Post
 $quotes->read_single();

 // Create array
 $quote_arr = array(
    'id' => $quote->id,
    'author' => $quote->quote,
 );

 // Make JSON
 print_r(json_encode($quote_arr));