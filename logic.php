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
    do {
        $orientamento = rand(0, 1);
        $colonna = chr(rand(65, 74)); 
        $riga = rand(1, 10); 
        $posizioni = [];
        for ($i = 0; $i < $ships[$nomeNave]['lenght']; $i++) {
            $nuovaPosizione = $orientamento == 0 ? $colonna . ($riga + $i) : chr(ord($colonna) + $i) . $riga;
            if (!in_array($nuovaPosizione, $ships['allPosition'])) {
                $posizioni[] = $nuovaPosizione;
            }
        }
    } while (count($posizioni) != $ships[$nomeNave]['lenght']);

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
