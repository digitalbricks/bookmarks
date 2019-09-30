<?php
require_once('classes/class.bookmarks.php');
$bookmarks = new Bookmarks;

// get bookmarks limit
$bookmarks_limit = $bookmarks->getLimit();

if(isset($_POST) AND isset($_POST['id']) AND isset($_POST['action'])){
    // get id from post
    $id = intval($_POST['id']);

    if($_POST['action']=='add'){
        if($bookmarks->is_allready_there($id)){
            send_response("add",200,"done","Wohnung bereits gemerkt");
        } else {
            // add only if limit is not reached yet
            if($bookmarks->count()<$bookmarks_limit){
                // add to bookmarks
                $bookmarks->add($id);
                send_response("add",200,"done","Wohnung gemerkt ({$bookmarks->count()}/{$bookmarks_limit})");
            } else {
                send_response("add",200,"failed","Es sind bereits {$bookmarks_limit} Wohnungen gemerkt");
            }
        }
        
    }

    if($_POST['action']=='remove'){
        // remove from bookmarks
        $bookmarks->remove($id);
        send_response("add",200,"done","Wohnung von Merkliste entfernt");
    }
} else {
    // if no POST, we just output the number of items
    echo $bookmarks->count();
}



/**
 * Sends the response, including HTTP status code
 * @param string $action performed action (for use in JS)
 * @param int $http_status http status code
 * @param string $status a status message for JS processing
 * @param string $message the message
 * @return void
 */
function send_response($action="",int $http_status=200,$status="done",$message=""){
    http_response_code($http_status);
    $response =  array(
        "action" => $action,
        "message" => $message,
        "status" => $status
    );
    echo json_encode($response);
}
