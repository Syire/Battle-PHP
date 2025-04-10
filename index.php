<?php
session_start();
require_once 'logic.php';

if (!isset($_SESSION['ships'])) {
    $_SESSION['ships'] = inizializzaGriglia();
    $_SESSION['log'] = [];
}

$messaggio = '';
if (isset($_POST['cell'])) {
    $messaggio = gestisciColpo($_POST['cell']);
}

$giocoFinito = giocoCompletato();

if (isset($_POST['reset'])) {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>Battaglia Navale</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>⚓ Battaglia Navale</h1>
    <?php if ($giocoFinito): ?>
        <h2>🎉 Hai vinto! Tutte le navi sono state affondate!</h2>
        <form method="post">
            <button type="submit" name="reset">Nuova Partita</button>
        </form>
    <?php else: ?>

        <div class="game-container">
            <form method="post" class="game-grid">
                <table>
                    <tr>
                        <th></th>
                        <?php foreach (range("A", "J") as $letter): ?>
                            <th><?= $letter ?></th>
                        <?php endforeach; ?>
                    </tr>
                    <?php
                    $colonne = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J"];
                    for ($r = 1; $r <= 10; $r++): ?>
                        <tr>
                            <th><?= $r ?></th>
                            <?php foreach ($colonne as $c):
                                $cell = $c . $r;
                                $status = getStatoCella($cell);
                            ?>
                                <td>
                                    <?php if ($status): ?>
                                        <button class="<?= $status ?>" disabled><?= $status == "hit" ? "X" : "·" ?></button>
                                    <?php else: ?>
                                        <?php if (!$giocoFinito): ?>
                                            <button type="submit" name="cell" value="<?= $cell ?>"></button>
                                        <?php else: ?>
                                            <button disabled></button>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endfor; ?>
                </table>
            </form>
            <div>
                <h3>
                    posizione navi
                </h3>
                <ul>
                    <?php foreach ($_SESSION['ships'] as $nome => $nave): ?>
                        <?php if ($nome === 'allPosition') continue; ?>
                        <li>
                            <strong>
                                <?= $nome ?>:
                            </strong>
                            <?= implode(",", $nave['position']) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="game-log">
                <h3>Log dei colpi:</h3>
                <ul>
                    <?php foreach ($_SESSION['log'] as $log): ?>
                        <li><?= htmlspecialchars($log) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="ship-map">
                <h3>Mappa delle Navi (debug):</h3>
                <table>
                    <tr>
                        <th></th>
                        <?php foreach (range("A", "J") as $letter): ?>
                            <th><?= $letter ?></th>
                        <?php endforeach; ?>
                    </tr>
                    <?php
                    $colonne = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J"];
                    for ($r = 1; $r <= 10; $r++): ?>
                        <tr>
                            <th><?= $r ?></th>
                            <?php foreach ($colonne as $c):
                                $cell = $c . $r;
                                $navePresente = false;
                                foreach ($_SESSION['ships'] as $nome => $nave) {
                                    if ($nome === 'allPosition') continue;
                                    if (in_array($cell, $nave['position'])) {
                                        $navePresente = $nome;
                                        break;
                                    }
                                }
                            ?>
                                <td class="<?= $navePresente ? 'ship-cell' : '' ?>">
                                    <?= $navePresente ? substr($navePresente, 0, 1) : '' ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endfor; ?>
                </table>
            </div>
            <form method="post" style="margin-top: 10px;">
                <button type="submit" name="reset" class="reset-button">Reset Partita</button>
            </form>
        </div>
    <?php endif; ?>
</body>

</html>