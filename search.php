<?php

include 'connection.php';
//error_reporting(E_ERROR | E_PARSE);



if ($connected) {

    $countryPost = isset($_POST['countryName']) ? $_POST['countryName'] : "";


    $countryQuery = "SELECT * FROM Country";
    $result = $mysqli->query($countryQuery);
    $countriesData = array();
    $countryID = "";

    while ($row = mysqli_fetch_assoc($result)) {
        $countriesData[] = $row;
    }

    if ($countryPost != "All") {
        foreach ($countriesData as $data) {
            if ($countryPost !== "") {
                if ($countryPost == utf8_encode($data['countryName'])) {
                    $countryID = utf8_encode($data['countryID']);
                    break;
                }
            }
        }


    }

    if ($countryID !== "" && $countryPost != "All") {
        $libQuery = "SELECT * FROM Library WHERE countryID = '$countryID' GROUP BY library";
    } else {
        $libQuery = "SELECT * FROM Library GROUP BY library";
    }


    $result = $mysqli->query($libQuery);

    $librariesData = array();
    $manuscriptData = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $librariesData[] = $row;
    }

    $libraryPost = isset($_POST['libraryName']) ? $_POST['libraryName'] : "";
    $manuscriptQuery = "";
    if ($libraryPost != "") {
        foreach ($librariesData as $libdata) {

            $re = "/[^(\\x20-\\x7F\\n)]+/u";
            $enc = utf8_encode($libdata['library']);
            $subst = "'";
            $libName = preg_replace($re, $subst, $enc);
            $_libSiglum = $libdata['libSiglum'];

            $jsonObjs = array();

            if ($libName == $libraryPost) {
                $manuscriptQuery = "SELECT msSiglum FROM Manuscript WHERE libSiglum = '$_libSiglum' GROUP BY msSiglum";
                $result = $mysqli->query($manuscriptQuery);

                $msColumns = 'SHOW COLUMNS FROM Manuscript';
                $msRes = $mysqli->query($msColumns);

                $columns = "<tr><th>Country</th><th>Manuscript ID</th></tr>";
                $jsonObjs[] = $columns;

                $table_row = "";

                $countryName = "";
                foreach ($countriesData as $data) {
                    if ($libdata['countryID'] == $data['countryID']) {
                        $countryName = $data['countryName'];
                        break;
                    }
                }


                while ($row = mysqli_fetch_assoc($result)) {
                    $table_row .= "<tr><td>{$countryName}</td>";

                    foreach ($row as $field) {
                        $url = "manuscripts.php?msSiglum=$field&libName={$libName}&countryName={$countryName}";
                        $url = htmlspecialchars($url,ENT_IGNORE);
                        $table_row .= "<td class='ms-data'><a href=\"".$url."\">{$field}</a></td>";
                    }
                    $table_row .= "</tr>";

                }
                $jsonObjs[] = $table_row;
                echo json_encode($jsonObjs);
                break;
            }
        }
    }

    function loadCountries($countriesData)
    {
        if (!empty($countriesData)) {
            $i = 0;
            foreach ($countriesData as $data) {
                echo "<option value='country{$i}'>" . utf8_encode($data['countryName']) . "</option>\n";
                $i++;
            }

            unset($data);
        }
    }


    function replace_bad_utf8($to_check, $replace_with)
    {
        $re = "/[^(\\x20-\\x7F\\n)]+/u";
        $utf8 = utf8_encode($to_check);
        $encoded = preg_replace($re, $replace_with, $utf8);
        return $encoded;
    }


    function loadLibraries($librariesData)
    {
        global $countryID;
        global $countryPost;

        $jsonObjs = array();

        if (!empty($librariesData)) {
            $i = 0;
            foreach ($librariesData as $data) {

                $re = "/[^(\\x20-\\x7F\\n)]+/u";
                $enc = utf8_encode($data['library']);
                $subst = "'";
                $libName = preg_replace($re, $subst, $enc);

                if ($countryID != "") {

                    $jsonObj = "<option value='library{$i}'>" . $libName . "</option>";
                    $jsonObjs[] = $jsonObj;
                } else {
                    if ($countryPost != "All") {
                        echo "<option value='library{$i}'>" . $libName . "</option>\n";
                    } else {
                        $jsonObj = "<option value='library{$i}'>" . $libName . "</option>\n";
                        $jsonObjs[] = $jsonObj;
                    }
                }
                $i++;
            }
            unset($data);

            if ($countryID != "" || $countryPost == "All") {
                echo json_encode($jsonObjs);
            }
        }
    }

    if ($countryID != "" || $countryPost == "All" ||($countryPost != "All" && $countryPost != "")) {
        loadLibraries($librariesData);
    }


} else {
    exit();
}

?>