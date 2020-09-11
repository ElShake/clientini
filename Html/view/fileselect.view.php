<!doctype html>
<html lang="en">

<head>
    <title>File Select</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="dist/css/tabulator.min.css" rel="stylesheet">
    <script type="text/javascript" src="dist/js/tabulator.min.js"></script>

</head>

<body>

    <?php
    require "header.view.php";

    if (!isset($_SESSION['RagSoc'])) {
        $_SESSION['RagSoc'] = $_POST['RagSoc'];
    }
    require(SITE_ROOT . "/includes/info.inc.php");
    require(SITE_ROOT . "/includes/fileselect.inc.php");
    ?>
    <div class="split left">
        <div class="ml-2">
            <?php
            //mette come path base Z:
            if (isset($_REQUEST["link"])) {
                $path = $_REQUEST["link"];
            } elseif (isset($_SESSION["link"])) {
                $path = $_SESSION["link"];
            } else {
                $path = "Z:";
            }
            //seleziona le directory
            $elenco = new DirectoryIterator($path);
            foreach ($elenco as $item) :
                $presente = false;
                $path = $item->getPathname();
                //elimina la directory corrente dalle possibilità
                if (substr($path, -1) == "." && substr($path, -2) != "..") {
                    continue;
                }
                //rende la directory superiore utilizzabile senza ridondanze
                elseif (substr($path, -2) == "..") {
                    $path = cut_string_using_last("\'", $path, 'left', false);
                    $path = cut_string_using_last("\'", $path, 'left', false);
            ?><form action="../view/fileselect.view.php" method="POST">
                        <div class="form-group  m-2 p-2 rounded-5">
                            <h2 class="text-white"><?php echo ($item->getPathname()) ?></h1>
                                <button type="submit" name="link" value="<?php echo ($path) ?>" class="btn btn-success"><?php echo ($path) ?></button><br>
                        </div>
                    </form><?php continue;
                        }
                        //per sapere se il file è già assegnato ad un cliente
                        foreach ($pres as $presenti) {
                            if (($item->getFilename() == $presenti["FileName"]) && ($item->getPathname() == $presenti["FilePath"])) {
                                $presente = true;
                                break;
                            };
                        };
                        // mostra directories
                        if ($item->getType() == "dir") { ?>
                    <form action="../view/fileselect.view.php" method="POST">
                        <div class="form-group  m-2 p-2 rounded-5">
                            <button type="submit" name="link" value="<?php echo ($path) ?>" class="btn btn-warning"><?php echo ($item->getFilename()) ?></button><br>
                        </div>
                    </form>
                <?php
                        }
                        //mostra files non assegnati
                        elseif ($presente == false) { ?>
                    <form action="../includes/linkcontrol.inc.php" method="POST">
                        <input name="RagSoc" hidden value="<?php echo $info["RagSoc"] ?>">
                        <input hidden name="IdCliente" value="<?php echo $info["IDCLI"] ?>">
                        <input hidden name="FileName" value="<?php echo ($item->getFilename()) ?>">
                        <input hidden name="link" value="<?php echo ($item->getPath()) ?>">
                        <button type="submit" name="FilePath" value="<?php echo ($path) ?>" class="btn btn-info"><?php echo ($item->getFilename()) ?></button>
                        <select name="Anno" id="Anno" required>
                            <?php for ($y = "2016"; $y <= (strftime("%Y") + 1); $y++) : ?>
                                <option value="<?php echo ($y) ?>"><?php echo ($y) ?></option>
                            <?php endfor; ?>
                        </select>
                    </form>
                    <br>
                <?php
                        } else { ?>
                    <button type="submit" name="link" value="" class="btn btn-dark popup" onclick="myFunction()"><?php echo ($item->getFilename()) ?>
                        <span class="popuptext" id="myPopup">File già allegato a: <?php echo ($presenti["RagSoc"]) ?></span>
                    </button><br>
            <?php };
                    endforeach;

            ?>
        </div>
    </div>
    <!-- view cliente -->
    <div class="split right">
        <div class="form-group  m-2 p-2 rounded-5">
            <?php
            echo '<pre>'; print_r($info); echo '</pre>';
             ?>
        </div>
        <?php foreach ($links as $link) {
           ?>
           <form action="../includes/linkcontrol.inc.php" method="POST">
           <a><?php echo ($link["FileName"]) ?>  </a>
           <input hidden name="link" value="<?php echo ($item->getPath()) ?>">
           <button class="btn text-danger" name="delete-link" value="<?php echo ($link["IdLink"])?>">Delete</button>
           </form>
        <?php }
        ?>


    </div>
    <?php

    // Funzione per ottenere la directory superiore
    function cut_string_using_last($character, $string, $side, $keep_character = true)
    {
        $offset = ($keep_character ? 1 : 0);
        $whole_length = strlen($string);
        $right_length = (strlen(strrchr($string, $character)) - 1);
        $left_length = ($whole_length - $right_length - 1);
        switch ($side) {
            case 'left':
                $piece = substr($string, 0, ($left_length + $offset));
                break;
            case 'right':
                $start = (0 - ($right_length + $offset));
                $piece = substr($string, $start);
                break;
            default:
                $piece = false;
                break;
        }
        return ($piece);
    } ?>
    <script>
        function myFunction() {
            var popup = document.getElementById("myPopup");
            popup.classList.toggle("show");

        }
    </script>