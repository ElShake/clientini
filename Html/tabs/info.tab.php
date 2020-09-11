<?php
define("SITE_ROOT", "C:/xampp/htdocs/clientini/Html");
require(SITE_ROOT . "/includes/info.inc.php");

?>
<form action="../view/fileselect.view.php" method="POST">
        <div class="form-group  m-2 p-2 rounded-5">
                <?php
                 echo '<pre>'; print_r($info); echo '</pre>';
                 ?>
                <button type="submit" value="<?php echo $RagSoc ?>" name="RagSoc"   class="btn btn-primary">Manage files</button>
        </div>
</form>
