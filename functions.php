<?php

require 'connection.php';

  function error422($message){
    $data = [
      'status' => 422,
      'message' => $message,
    ];
    header('HTTP/1.0 422 Unprocessable Entity');
    echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    exit();
  }

function storeSwatch($swatchInput){

  global $conn;
  $swatchId = mysqli_real_escape_string($conn, $swatchInput['id']);
  $swatchOrder = mysqli_real_escape_string($conn, $swatchInput['sort_order']);
  $swatchImage = mysqli_real_escape_string($conn, $swatchInput['image']);
  $swatchName = mysqli_real_escape_string($conn, $swatchInput['name']);
  $swatchType = mysqli_real_escape_string($conn, $swatchInput['fabric']);
  $swatchColor = mysqli_real_escape_string($conn, $swatchInput['color']);
  $swatchDescription = mysqli_real_escape_string($conn, $swatchInput['description']);
  $swatchBullets = mysqli_real_escape_string($conn, $swatchInput['attributes']);
  $swatchEco = mysqli_real_escape_string($conn, $swatchInput['is_eco']);
  $swatchEcoOrder = mysqli_real_escape_string($conn, $swatchInput['eco_order']);
  $swatchCleaningCode = mysqli_real_escape_string($conn, $swatchInput['cleancode']);
  $swatchAvailable = mysqli_real_escape_string($conn, $swatchInput['is_available']);


  $query = 'INSERT INTO swatches (id,sort_order, image, name, fabric, color, description, attributes, is_eco, eco_order, cleancode, is_available VALUES("$swatchId","$swatchOrder","$swatchImage","$swatchName","$swatchType","$swatchColor","$swatchDescription", "$swatchBullets","$swatchEco","$swatchEcoOrder","$swatchCleaningCode","$swatchAvailable")';

  $result = mysqli_query($conn, $query);


  if(empty(trim($swatchName))){
    return error422('Name is required.');
  }
  elseif(empty(trim($swatchOrder))){
    return error422('Enter the sort order.');
  }
  elseif(empty(trim($swatchType))){
    return error422('Fabric Type is required.');
  }
  elseif(empty(trim($swatchName))){
    return error422('Swatch Color Family is required.');
  }
  elseif(empty(trim($swatchDescription))){
    return error422('Please enter a description for the swatch.');
  }
  elseif(empty(trim($swatchImage))){
    return error422('Swatch image link is required.');
  }
  /*elseif(empty(trim($swatchEco))){
    return error422('1 or 0 required: 0 = NOT Eco | 1 = IS Eco');
  }
  elseif(empty(trim($swatchEcoOrder))){
    return error422('Enter 0 if NO eco sort order defined');
  }*/
  elseif(empty(trim($swatchCleaningCode))){
    return error422('Cleaning Code [ W, S, W/S, X, or D ] is required.');
  }
  elseif(empty(trim($swatchBullets))){
    return error422('Please Enter bullet points and use | between text to separate like: point one | point two | point three');
  }
  else{

      if ($result){
        $data = [
          'status' => 200,
          'message' => 'Swatch Created Successfully',
        ];
        header('HTTP/1.0 200 Created');
        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
      }
      else{
        $data = [
          'status' => 405,
          'message' => $_SERVER['REQUEST_METHOD']. ' METHOD NOT ALLOWED',
        ];
        header('HTTP/1.0 405 Internal Server Error');
        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
      }
  }
}

function getSwatchList(){

  global $conn;

  $query = 'SELECT * FROM details WHERE sort_order != "" ORDER BY sort_order ASC ';
  $query_run = mysqli_query($conn, $query);

  if($query_run){
    if(mysqli_num_rows($query_run) > 0 ){
      
      $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

      $data = [
        'status' => 200,
        'message' => 'Swatch List Fetched Successfully',
        'data' => $res
      ];
      header('HTTP/1.0 200 SUCCESS');
      return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

    }
    else {
      $data = [
        'status' => 404,
        'message' => $requestMethod. 'NO SWATCHES FOUND',
      ];
      header('HTTP/1.0 500 NO SWATCHES FOUND');
      return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

      }
  }
  else {
    $data = [
      'status' => 500,
      'message' => $requestMethod. 'METHOD NOT ALLOWED',
    ];
    header('HTTP/1.0 500 Internal Server Error');
    return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
  }
}

?>