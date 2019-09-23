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

$marks = $bookmarks->get();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bookmarks</title>
    <link rel="stylesheet" type="text/css" href="styles/notie.min.css">
    <link rel="stylesheet" type="text/css" href="styles/styles.css">
</head>
<body>
    <div class="container">
        <h1>Bookmarks</h1>
        <p><a href="index.php">Zur Übersicht</a></p>
        <?php
        foreach($marks as $mark){
            echo "<div class='item'>
                    <div>
                        <h2>Item {$mark}</h2>
                    </div>
                    <div>
                        <form action='bookmarks.php' data-ajax-processor='bookmarks-ajax-processor.php' method='post' class='bookmark-form-actions'>
                            <input type='hidden' name='action' value='remove'>
                            <input type='hidden' name='id' value='{$mark}'>
                            <button type='submit'>Entfernen</button>
                        </form>
                    </div>
                </div>";
        }
        ?>
    </div>

<script src='scripts/jquery-3.4.1.min.js'></script>
<script src='scripts/jquery.cookie.js'></script>
<script src='scripts/notie.min.js'></script>
<script src='scripts/bookmarks.js'></script>
</body>
</html>