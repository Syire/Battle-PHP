<?php

function inizializzaGriglia()
{
    $ships = [
        "Portaerei" => [
            "position" => [],
            "fired" => [],
            "lenght" => 5
        ],
        "Cacciatorpediniere" => [
            "position" => [],
            "fired" => [],
            "lenght" => 4
        ],
        "Torpediniere" => [
            "position" => [],
            "fired" => [],
            "lenght" => 3
        ],
        "Sottomarino" => [
            "position" => [],
            "fired" => [],
            "lenght" => 3
        ],
        "Fregata" => [
            "position" => [],
            "fired" => [],
            "lenght" => 2
        ],
        "allPosition" => []
    ];

    foreach (["Portaerei", "Cacciatorpediniere", "Torpediniere", "Sottomarino", "Fregata"] as $ship) {
        $ships = posizionaNave($ships, $ship);
    }

    return $ships;
}

function posizionaNave($ships, $nomeNave)
{
    $colonne = range("A", "J");
    $righe = range(1, 10);
    do {
        $posizioni = [];
        $valide = true;
        $orientamento = rand(0, 1); 
        $colIndex = rand(0, 9);
        $rowIndex = rand(0, 9);
        $lunghezza = $ships[$nomeNave]['lenght'];
        for ($i = 0; $i < $lunghezza; $i++) {
            if ($orientamento == 0) {
                $riga = $rowIndex + $i;
                if ($riga > 9) {
                    $valide = false;
                    break;
                }
                $cella = $colonne[$colIndex] . $righe[$riga];
            } else {
                $col = $colIndex + $i;
                if ($col > 9) {
                    $valide = false;
                    break;
                }
                $cella = $colonne[$col] . $righe[$rowIndex];
            }
            if (in_array($cella, $ships['allPosition'])) {
                $valide = false;
                break;
            }
            $posizioni[] = $cella;
        }
    } while (!$valide);
    $ships[$nomeNave]['position'] = $posizioni;
    $ships['allPosition'] = array_merge($ships['allPosition'], $posizioni);
    return $ships;
}

function gestisciColpo($target)
{
    foreach ($_SESSION['ships'] as $nome => &$nave) {
        if ($nome === 'allPosition') continue;

        if (in_array($target, $nave['fired'])) {
            return "Hai già sparato in $target!";
        }

        if (in_array($target, $nave['position'])) {
            $nave['fired'][] = $target;
            $_SESSION['log'][] = "$target: COLPITO sulla $nome!";

            if (count(array_intersect($nave['position'], $nave['fired'])) === count($nave['position'])) {
                $_SESSION['log'][] = "Hai affondato la $nome!";
                return "Hai affondato la $nome!";
            }

            return "COLPITO in $target!";
        }
    }

    foreach ($_SESSION['ships'] as $nome => &$nave) {
        if ($nome === 'allPosition') continue;

        $nave['fired'][] = $target;
    }

    $_SESSION['log'][] = "$target: ACQUA!";
    return "ACQUA in $target!";
}

function giocoCompletato()
{
    foreach ($_SESSION['ships'] as $nome => $nave) {
        if ($nome === 'allPosition') continue;

        if (count(array_intersect($nave['position'], $nave['fired'])) < count($nave['position'])) {
            return false;
        }
    }
    return true;
}

function getStatoCella($cella)
{
    foreach ($_SESSION['ships'] as $nome => $nave) {
        if ($nome === 'allPosition') continue;

        if (in_array($cella, $nave['fired'])) {
            if (in_array($cella, $nave['position'])) {
                return "hit";
            } else {
                return "miss";
            }
        }
    }
    return "";
}
