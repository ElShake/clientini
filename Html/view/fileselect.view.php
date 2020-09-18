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
    // evitare che un reset di sessione faccia perdere il puntatore cliente
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
                        <div class="form-group  m-2 ml-4  rounded-5">
                            <button type="submit" name="link" value="<?php echo ($path) ?>" class="btn btn-sm btn-warning"><?php echo ($item->getFilename()) ?></button><br>
                        </div>
                    </form>
            <?php
                        }
                    endforeach;

            ?>
            <!-- mostra file non assegnati -->
            <?php foreach ($elenco as $item) :
                $presente = false;
                foreach ($pres as $presenti) {
                    if (($item->getFilename() == $presenti["FileName"]) && ($item->getPathname() == $presenti["FilePath"])) {
                        $presente = true;
                        break;
                    };
                };
                $path = $item->getPathname();
                if ((substr($path, -1) != ".") && (substr($path, -2) != "..") && ($item->getType() != "dir") && ($presente == false)) :
            ?>
                    <div class="p-1 ml-3">
                        <form action="../includes/linkcontrol.inc.php" method="POST">
                            <input name="RagSoc" hidden value="<?php echo $info["RagSoc"] ?>">
                            <input hidden name="IdCliente" value="<?php echo $info["IDCLI"] ?>">
                            <input hidden name="FileName" value="<?php echo ($item->getFilename()) ?>">
                            <input hidden name="link" value="<?php echo ($item->getPath()) ?>">
                            <button type="submit" name="FilePath" value="<?php echo ($path) ?>" class="btn btn-sm btn-info"><?php echo ($item->getFilename()) ?></button>
                            <select class="btn btn-light btn-sm" name="Anno" id="Anno" required>
                                <?php for ($y = "2016"; $y <= (strftime("%Y") + 1); $y++) : ?>
                                    <option value="<?php echo ($y) ?>"><?php echo ($y) ?></option>
                                <?php endfor; ?>
                            </select>
                        </form>
                    </div>
            <?php
                endif;
            endforeach; ?>
            <!-- mostra file assegnati -->
            <?php foreach ($elenco as $item) :
                $presente = false;
                foreach ($pres as $presenti) {
                    if (($item->getFilename() == $presenti["FileName"]) && ($item->getPathname() == $presenti["FilePath"])) {
                        $presente = true;
                        break;
                    };
                };
                $path = $item->getPathname();
                if ((substr($path, -1) != ".") && (substr($path, -2) != "..") && ($item->getType() != "dir") && ($presente != false)) :
            ?><div class="p-1 ml-3">
                        <button type="submit" name="link" value="" class="btn btn-sm btn-dark popup" onclick="myFunction()"><?php echo ($item->getFilename()) ?>
                            <span class="popuptext" id="myPopup">File già allegato a: <?php echo ($presenti["RagSoc"]) ?></span>
                        </button><br>
                    </div>
            <?php
                endif;
            endforeach; ?>
        </div>
    </div>
    <!-- view cliente -->
    <div class="split right">
        <div class="form-group  m-5 p-4 rounded-5 font-weight-bold font-italic">
            <?php if (isset($info["RagSoc"])) { ?>
                <h3><?php echo ($info["RagSoc"]) ?></h3><br>
            <?php  } ?>
            <?php if (isset($info["Via"])) { ?>
                <a>VIA: </a>
                <a class="text-danger"><?php echo ($info["Via"]) ?></a><br>
            <?php  } ?>
            <?php if (isset($info["Cap"])) { ?>
                <a>CAP: </a>
                <a class="text-danger"><?php echo ($info["Cap"]) ?></a><br>
            <?php  } ?>
            <?php if (isset($info["Citta"])) { ?>
                <a>CITTA: </a>
                <a class="text-danger"><?php echo ($info["Citta"]) ?></a><br>
            <?php  } ?>
            <?php if (isset($info["Provincia"])) { ?>
                <a>PROVINCIA: </a>
                <a class="text-danger"><?php echo ($info["Provincia"]) ?></a><br>
            <?php  } ?>
            <?php if (isset($info["PIVA"])) { ?>
                <a>P. IVA: </a>
                <a class="text-danger"><?php echo ($info["PIVA"]) ?></a><br>
            <?php  } ?>
            <?php if (isset($info["Referente"])) { ?>
                <a>REFERENTE: </a>
                <a class="text-danger"><?php echo ($info["Referente"]) ?></a><br>
            <?php  } ?>
            <?php if (isset($info["CodDest"])) { ?>
                <a>CODICE DEST.: </a>
                <a class="text-danger"><?php echo ($info["CodDest"]) ?></a><br>
            <?php  } ?>
            <?php if (isset($info["Pec"])) { ?>
                <a>PEC: </a>
                <a class="text-danger"><?php echo ($info["Pec"]) ?></a><br>
            <?php  } ?>
            <?php if (isset($info["EmailForn"])) { ?>
                <a>EMAIL FORNITORE: </a>
                <a class="text-danger"><?php echo ($info["EmailForn"]) ?></a><br>
            <?php  } ?>
            <br>
            <h3>FILES:</h3>
                <!-- mostra al click il i file apparteneti al cliente dell' anno cliccato -->
            <button class="btn btn-warning btn-sm" onclick="duemilasedici()">2016</button>
            <div class="hidden" id="sedici">
                <?php foreach ($links as $link) {
                    if ($link["Anno"] == (2016)) {
                ?>
                        <form action="../includes/linkcontrol.inc.php" method="POST">
                            <a><?php echo ($link["FileName"]) ?> </a>
                            <input hidden name="link" value="<?php echo ($item->getPath()) ?>">
                            <button class="btn text-danger" name="delete-link" value="<?php echo ($link["IdLink"]) ?>">Delete</button>
                        </form>
                <?php }
                }
                ?>
                <br>
            </div>
            <button class="btn btn-warning btn-sm" onclick="duemiladiciassette()">2017</button>
            <div class="hidden" id="diciassette">
                <?php foreach ($links as $link) {
                    if ($link["Anno"] == (2017)) {
                ?>
                        <form action="../includes/linkcontrol.inc.php" method="POST">
                            <a><?php echo ($link["FileName"]) ?> </a>
                            <input hidden name="link" value="<?php echo ($item->getPath()) ?>">
                            <button class="btn text-danger" name="delete-link" value="<?php echo ($link["IdLink"]) ?>">Delete</button>
                        </form>
                <?php }
                }
                ?>
                <br>
            </div>
            <button class="btn btn-warning btn-sm" onclick="duemiladiciotto()">2018</button>
            <div class="hidden" id="diciotto">
                <?php foreach ($links as $link) {
                    if ($link["Anno"] == (2018)) {
                ?>
                        <form action="../includes/linkcontrol.inc.php" method="POST">
                            <a><?php echo ($link["FileName"]) ?> </a>
                            <input hidden name="link" value="<?php echo ($item->getPath()) ?>">
                            <button class="btn text-danger" name="delete-link" value="<?php echo ($link["IdLink"]) ?>">Delete</button>
                        </form>
                <?php }
                }
                ?>
                <br>
            </div>
            <button class="btn btn-warning btn-sm" onclick="duemiladiciannove()">2019</button>
            <div class="hidden" id="diciannove">
                <?php foreach ($links as $link) {
                    if ($link["Anno"] == (2019)) {
                ?>
                        <form action="../includes/linkcontrol.inc.php" method="POST">
                            <a><?php echo ($link["FileName"]) ?> </a>
                            <input hidden name="link" value="<?php echo ($item->getPath()) ?>">
                            <button class="btn text-danger" name="delete-link" value="<?php echo ($link["IdLink"]) ?>">Delete</button>
                        </form>
                <?php }
                }
                ?>
                <br>
            </div>
            <button class="btn btn-warning btn-sm" onclick="duemilaventi()">2020</button>
            <div class="hidden" id="venti">
                <?php foreach ($links as $link) {
                    if ($link["Anno"] == (2020)) {
                ?>
                        <form action="../includes/linkcontrol.inc.php" method="POST">
                            <a><?php echo ($link["FileName"]) ?> </a>
                            <input hidden name="link" value="<?php echo ($item->getPath()) ?>">
                            <button class="btn text-danger" name="delete-link" value="<?php echo ($link["IdLink"]) ?>">Delete</button>
                        </form>
                <?php }
                }
                ?>
                <br>
            </div>
            <button class="btn btn-warning btn-sm" onclick="duemilaventuno()">2021</button>
            <div class="hidden" id="ventuno">
                <?php foreach ($links as $link) {
                    if ($link["Anno"] == (2021)) {
                ?>
                        <form action="../includes/linkcontrol.inc.php" method="POST">
                            <a><?php echo ($link["FileName"]) ?> </a>
                            <input hidden name="link" value="<?php echo ($item->getPath()) ?>">
                            <button class="btn text-danger" name="delete-link" value="<?php echo ($link["IdLink"]) ?>">Delete</button>
                        </form>
                <?php }
                }
                ?>
                <br>
            </div>
        </div>

    </div>
    <?php require "footer.view.php"; ?>
</body>
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
    function duemilasedici() {
        var x = document.getElementById("sedici");
        if (x.style.display == "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }

    function duemiladiciassette() {
        var x = document.getElementById("diciassette");
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }

    function duemiladiciotto() {
        var x = document.getElementById("diciotto");
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }

    function duemiladiciannove() {
        var x = document.getElementById("diciannove");
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }

    function duemilaventi() {
        var x = document.getElementById("venti");
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }

    function duemilaventuno() {
        var x = document.getElementById("ventuno");
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }


    function myFunction() {
        var popup = document.getElementById("myPopup");
        popup.classList.toggle("show");

    }
</script>