<?php

require_once __DIR__ . '/inc/db.php';

?>

<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rotating text</title>
</head>

<body>
    <?php

    $sqlAll = "SELECT * FROM countdown";
    $resultAll = $db->query($sqlAll);

    $x = 15;
    $y = 18;

    $sqlIsAvailable = "
        SELECT * 
        FROM `countdown` 
        WHERE 
        (
            -- Nový interval nepřesahuje půlnoc
            (
                $x < $y AND (
                    (start < end AND NOT (end <= $x OR start >= $y)) OR
                    (start > end AND NOT (end <= $x AND start >= $y))
                )
            )
            OR
            -- Nový interval přesahuje půlnoc
            (
                $x > $y AND (
                    (start < end AND NOT (end <= $x AND start >= $y)) OR
                    (start > end)
                )
            )
        );";

    echo "<pre>$sqlIsAvailable</pre>";

    $resultIsAvailable = $db->query($sqlIsAvailable);

    ?>
    <h2>Vkládám</h2>
    <p>
        <?= $x ?> - <?= $y ?>
    </p>
    <h2>Aktuální intervaly, které se překrývají</h2>
    <?php
    if ($resultIsAvailable->num_rows > 0) {
        while ($row = $resultIsAvailable->fetch_assoc()) { ?>
            <p>
                <?= $row['start'] ?> - <?= $row['end'] ?> <?= $row['text'] ?>
            </p>
    <?php }
    } else {
        echo 'V databázi nejsou žádné záznamy.';
    }
    ?>

    <h2>Všechny intervaly</h2>
    <?php
    if ($resultAll->num_rows > 0) {
        while ($row = $resultAll->fetch_assoc()) { ?>
            <p>
                <?= $row['start'] ?> - <?= $row['end'] ?> <?= $row['text'] ?>
            </p>
    <?php }
    } else {
        echo 'V databázi nejsou žádné záznamy.';
    }
    ?>
</body>

</html>