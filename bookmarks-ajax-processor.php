<?php
require_once('class.bookmarks.php');
$bookmarks = new Bookmarks;

if(isset($_POST) AND isset($_POST['id']) AND isset($_POST['action'])){
    // get id from post
    $id = intval($_POST['id']);

    if($_POST['action']=='add'){
        // add to bookmarks
        $bookmarks->add($id);
        send_response("add",200,"item {$id} added");
    }

    if($_POST['action']=='remove'){
        // remove from bookmarks
        $bookmarks->remove($id);
        send_response("add",200,"item {$id} removed");
    }
} else {
    send_response("none",400,"bad request");
}



/**
 * Sends the response, including HTTP status code
 * @param string $action performed action (for use in JS)
 * @param int $http_status http status code
 * @param string $message the message
 * @return void
 */
function send_response($action="",int $http_status=200,$message=""){
    http_response_code($http_status);
    $response =  array(
        "action" => $action,
        "message" => $message
    );
    echo json_encode($response);
}
