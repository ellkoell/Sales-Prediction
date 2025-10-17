<?php
require "lib/apical.php";
require "lib/func.php";

$tv = $radio = $newspaper = "";
$result = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tv = isset($_POST["tv"]) ? $_POST["tv"] : "";
    $radio = isset($_POST["radio"]) ? $_POST["radio"] : "";
    $newspaper = isset($_POST["newspaper"]) ? $_POST["newspaper"] : "";

    if (validate($tv, $radio, $newspaper, $errors)) {
        echo "<p class='alert alert-success'>Die eingegebenen Daten sind in Ordnung!</p>";
        $ausgabe = ausgabe($tv, $radio, $newspaper);



        if ($ausgabe !== null) {
            echo "<div class='alert alert-info mb-4'>
  <h4 class='alert-heading'>Prognose</h4>
  <p class='mb-0'>
     TV: <strong>".(float)$tv."</strong>, 
    Radio: <strong>".(float)$radio."</strong> und 
    newspaper: <strong>".(float)$newspaper."</strong> (in 1.000) 
    Prediction:
    <strong>".number_format((float)$ausgabe, 2, ',', '.')."</strong> (1.000).
  </p>
</div>";


    }else {
        echo"<div class='alert alert-danger'><p>Die eingegebenen Daten sind fehlerhaft!</p><ul>";


        foreach ($errors as $key => $value){
            echo "<li>".$value."</li>";
        }
        echo"</ul></div>";
    }
}}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Prediction</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<div class="container py-4">
    <div class="text-center mb-4">
        <h1>Sales Prediction</h1>
        <p>Gib dein Werbebudget ein, um den vorhergesagten Verkauf zu berechnen.</p>
    </div>

    <div class="card mx-auto" style="max-width: 500px;">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php elseif (isset($_POST['submit']) && empty($errors)): ?>
            <div class="alert alert-success">
                Eingaben sind gültig.
            </div>
        <?php endif; ?>

        <form method="post" action="" novalidate>
            <div class="mb-3">
                <label>TV-Budget (in 1000 Dollar):</label>
                <input type="number" class="form-control" name="tv" min="1" max="999"  value="<?= htmlspecialchars($tv) ?>" required>
            </div>

            <div class="mb-3">
                <label>Radio-Budget (in 1000 Dollar):</label>
                <input type="number" class="form-control" name="radio" min="1" max="999" " value="<?= htmlspecialchars($radio) ?>" required>
            </div>

            <div class="mb-3">
                <label>Zeitung-Budget (in 1000 Dollar):</label>
                <input type="number" class="form-control" name="newspaper" min="1" max="999"  value="<?= htmlspecialchars($newspaper) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary w-100" name="submit">
                Vorhersage berechnen
            </button>
        </form>

        <?php if (!empty($result)): ?>
            <div class="alert alert-success text-center mt-3">
                <strong>Vorhergesagter Verkauf:</strong> <?= htmlspecialchars($result) ?>
            </div>
        <?php endif; ?>
    </div>

    <footer class="text-center mt-4 text-muted">

    </footer>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/index.js"></script>
</body>
</html>