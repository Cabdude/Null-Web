<?php
    include 'connection.php';

    $number_of_chants = 0;

    $chants_result = $mysqli->query("SELECT * FROM Chant WHERE msSiglum=");
?>
<html>


    <head>
        <meta content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" type="text/css" href="cantusstyle.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script type="text/javascript" src="maphelper.js"></script>
        <script type="text/javascript" src="search_help.js"></script>

    </head>

    <?php
        $msSiglum = $_GET['msSiglum'];
        $countryName = $_GET['countryName'];
        $libraryName = $_GET['libName'];
        echo "<h1> Manuscript {$msSiglum}</h1>";
    ?>

    <div class="grid-container">

        <div class="grid-item-map">
            <div id="map"></div>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnDhlZqdndiNq0tPLxlOgNYMDMXBVZ0Ks"></script>
        </div>


        <div class="grid-item-msdata">
            <?php


                $chants_result = $mysqli->query("SELECT * FROM Chant WHERE msSiglum = '{$msSiglum}'");
                $feasts_result = $mysqli->query("SELECT feastID FROM Chant WHERE msSiglum = '{$msSiglum}' GROUP BY feastID");
                $provenance_result = $mysqli->query("SELECT provenanceID,provenanceDetail FROM Section WHERE msSiglum='{$msSiglum}'");
                if($chants_result !== false)
                {
                    echo "<div class='ms-data-info'>";
                        echo "<p>Country: {$countryName}</p>";
                        echo "<p>Library: {$libraryName}</p>";
                        $number_of_chants = mysqli_num_rows($chants_result);
                        $number_of_feasts = mysqli_num_rows($feasts_result);
                        echo "<p>Number of chants: {$number_of_chants}</p>";
                        if($feasts_result !== false) {
                            echo "<p>Different types of feasts: {$number_of_feasts} </p>";
                        }

                        if($provenance_result !== false) {
                            $provenance = mysqli_fetch_row($provenance_result);

                            if ($provenance[1] != $provenance[0]) {
                                echo "<p>Provenance(Origin): {$provenance[0]},{$provenance[1]}</p>";
                            } else {
                                echo "<p>Provenance(Origin): {$provenance[0]}</p>";
                            }

                            echo "<script type='text/javascript'>";
                            echo "if(mapProvenance(\"{$provenance[1]},{$countryName}\") === false)";
                            echo "if(!mapProvenance(\"{$provenance[0]},{$countryName}\")=== false)";
                            echo "if(!mapProvenance(\"{$provenance[0]},{$provenance[1]},{$countryName}\")=== false)";
                            echo "if(!mapProvenance(\"{$provenance[0]},{$provenance[1]}\")=== false)";
                            echo "if(!mapProvenance(\"{$provenance[0]}\")=== false)";
                            echo "if(!mapProvenance(\"{$provenance[1]}\")=== false);";


                            echo "</script>";


                        }

                        echo "<button type=\"button\" onclick=\"alert('PDF Generation Coming Soon')\">Generate Manuscript PDF</button>";
                    echo "</div>";
                }
            ?>


        </div>




    </div>


</html>
