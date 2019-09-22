<?php
require_once('class.bookmarks.php');
$bookmarks = new Bookmarks;

if(isset($_POST) AND isset($_POST['id']) AND isset($_POST['action'])){
    // get id from post
    $id = intval($_POST['id']);

    if($_POST['action']=='add'){
        // add to bookmarks
        $bookmarks->add($id);
    }

    if($_POST['action']=='remove'){
        // remove from bookmarks
        $bookmarks->remove($id);
    }
}


