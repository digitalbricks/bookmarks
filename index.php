<?php
require_once('classes/class.bookmarks.php');
$bookmarks = new Bookmarks;

$marks_count = $bookmarks->count();

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bookmarks Test</title>
    <link rel="stylesheet" type="text/css" href="styles/notie.min.css">
    <link rel="stylesheet" type="text/css" href="styles/styles.css">
</head>
<body>
    <div class="container">
        <h1>Item List</h1>
        <div id='boomarks_items' data-update-url='bookmarks-ajax-processor.php'>
            Bookmarked items: <span class='count'><?=$marks_count?></span> of <?=$bookmarks->getLimit()?>
        </div>
        <p><a href="bookmarks.php">Show Bookmarks</a></p>
        <?php
        for($i=1;$i<=15;$i++){
            echo "<div class='item'>
                    <div>
                        <h2>Item {$i}</h2>
                    </div>
                    <div>
                        <form action='bookmarks.php' method='post' data-ajax-processor='bookmarks-ajax-processor.php' class='bookmark-form-actions'>
                            <input type='hidden' name='action' value='add'>
                            <input type='hidden' name='id' value='{$i}'>
                            <button type='submit'>Add</button>
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