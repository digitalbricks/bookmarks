<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bookmarks Test</title>
    <link rel="stylesheet" type="text/css" href="notie.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Bookmarks Test</h1>
        <p><a href="bookmarks.php">Zum Merkzettel</a></p>
        <?php
        for($i=1;$i<=10;$i++){
            echo "<div class='item'>
                    <div>
                        <h2>Item {$i}</h2>
                    </div>
                    <div>
                        <form action='bookmarks.php' method='post' data-ajax-processor='bookmarks-ajax-processor.php' class='bookmark-form-actions'>
                            <input type='hidden' name='action' value='add'>
                            <input type='hidden' name='id' value='{$i}'>
                            <button type='submit'>Merken</button>
                        </form>
                    </div>
                </div>";
        }
        ?>

    </div>
<script src='jquery-3.4.1.min.js'></script>
<script src='jquery.cookie.js'></script>
<script src='notie.min.js'></script>
<script src='bookmarks.js'></script>
</body>
</html>