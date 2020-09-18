<?php
define("SITE_ROOT", "C:/xampp/htdocs/clientini/Html");
require(SITE_ROOT . "/includes/info.inc.php");

?>
<!-- nistra cliente selezionato  -->
<form action="../view/fileselect.view.php" method="POST">
        <div class="form-group  m-5 p-4 rounded-5 font-weight-bold font-italic">
                <?php if (isset ($info["RagSoc"])) {?>
                <h3 ><?php echo ($info["RagSoc"])?></h3><br>
                <?php  }?>
                <?php if (isset ($info["Via"])) {?>
                <a>VIA: </a>
                <a class="text-danger"><?php echo ($info["Via"])?></a><br>
                <?php  }?>
                <?php if (isset ($info["Cap"])) {?>
                <a>CAP: </a>
                <a class="text-danger"><?php echo ($info["Cap"])?></a><br>
                <?php  }?>
                <?php if (isset ($info["Citta"])) {?>
                <a>CITTA: </a>
                <a class="text-danger"><?php echo ($info["Citta"])?></a><br>
                <?php  }?>
                <?php if (isset ($info["Provincia"])) {?>
                <a>PROVINCIA: </a>
                <a class="text-danger"><?php echo ($info["Provincia"])?></a><br>
                <?php  }?>
                <?php if (isset ($info["PIVA"])) {?>
                <a>P. IVA: </a>
                <a class="text-danger"><?php echo ($info["PIVA"])?></a><br>
                <?php  }?>
                <?php if (isset ($info["Referente"])) {?>
                <a>REFERENTE: </a>
                <a class="text-danger"><?php echo ($info["Referente"])?></a><br>
                <?php  }?>
                <?php if (isset ($info["CodDest"])) {?>
                <a>CODICE DEST.: </a>
                <a class="text-danger"><?php echo ($info["CodDest"])?></a><br>
                <?php  }?>
                <?php if (isset ($info["Pec"])) {?>
                <a>PEC: </a>
                <a class="text-danger"><?php echo ($info["Pec"])?></a><br>
                <?php  }?>
                <?php if (isset ($info["EmailForn"])) {?>
                <a>EMAIL FORNITORE: </a>
                <a class="text-danger"><?php echo ($info["EmailForn"])?></a><br>
                <?php  }?>
                <?php
                //  echo '<pre>'; print_r($info); echo '</pre>';
                 ?>
                 <br>
                <button type="submit" value="<?php echo $RagSoc ?>" name="RagSoc"   class="btn btn-primary">Manage files</button>
        </div>
</form>
