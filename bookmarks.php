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
            $notice = 'Item allready bookmarked!';
        } else {
            // add only if limit is not reached yet
            if($bookmarks->count()<$bookmarks_limit){
                // add to bookmarks
                $bookmarks->add($id);
                $notice = 'Item added';
            } else {
                $notice = "Limit of {$bookmarks_limit} reached.";
            }
        }
    }

    if($_POST['action']=='remove'){
        // remove from bookmarks
        $bookmarks->remove($id);
        $notice = 'Item removed';
    }
}

$marks = $bookmarks->get();
$marks_count = $bookmarks->count();
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
        <div id='boomarks_items' data-update-url='bookmarks-ajax-processor.php'>
            Bookmarked items: <span class='count'><?=$marks_count?></span> of <?=$bookmarks_limit?>
        </div>
        <p><a href="index.php">Item list</a></p>
        <?php
        if(isset($notice)){
            echo "<div class='notice'>{$notice}</div>";
        }

        foreach($marks as $mark){
            echo "<div class='item' id='item-{$mark}'>
                    <div>
                        <h2>Item {$mark}</h2>
                    </div>
                    <div>
                        <form action='bookmarks.php' data-ajax-processor='bookmarks-ajax-processor.php' method='post' class='bookmark-form-actions'>
                            <input type='hidden' name='action' value='remove'>
                            <input type='hidden' name='id' value='{$mark}'>
                            <button type='submit'>Remove</button>
                        </form>
                    </div>
                </div>";
        }
        ?>
    </div>

<script src='scripts/jquery-3.4.1.min.js'></script>
<script src='scripts/notie.min.js'></script>
<script src='scripts/bookmarks.js'></script>
</body>
</html>