<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../../config/database.php';
include_once '../../models/activity/activity.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare activity object
$activity = new Activity($db);

// get id of activity to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of activity to be edited
$activity->idActivity = $data->idActivity;

// set activity property values
$activity->nameActivity = $data->nameActivity;
$activity->description = $data->description;
$activity->idDay = $data->idDay;
$activity->idActType = $data->idActType;
$activity->idTrainer = $data->idTrainer;


// update the activity
if($activity->update()){

    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    echo json_encode(array("message" => "activity was updated."));
}

// if unable to update the activity, tell the user
else{

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to update activity."));
}
?>