<?php
require_once 'include/sitemap.php';

$sitemap = new sitemap();

if(isset($_POST['obj'])){
    $sitemap->save($_POST['obj']);
    exit;
}
?>
<!DOCTYPE  HTML>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="css/css.css" media="screen" />

        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script src="js/fw.js"></script>
        <script src="js/simple-modal.js"></script>
        <script src="js/misc.js"></script>
    </head>
    <body>
        <input id="save_btn" type="button" value="Save order"/>
        <div class="container canvas">
            <div class="row">
                <?php echo $sitemap->build(); ?>
            </div>
        </div>
    </body>
</html>
