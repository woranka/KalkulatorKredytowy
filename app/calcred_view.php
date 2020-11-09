<?php

?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

<head>
    <meta charset="utf-8" />
    <title>Kalkulator Kredytowy</title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
</head>

<body>
    <div style="width:90%; margin: 2em auto;">
	<a href="<?php print(_APP_ROOT); ?>/app/inna_chroniona.php" class="pure-button">Przejdź dalej</a>
	<a href="<?php print(_APP_ROOT); ?>/app/security/logout.php" class="pure-button pure-button-active">Wyloguj</a>
    </div>

    <div style="width:90%; margin: 2em auto;">
        <form action="<?php print(_APP_URL);?>/app/calcred.php" method="post" class="pure-form pure-form-stacked">
            <legend>Kalkulator Kredytowy</legend>
            <fieldset>
                <label for="id_kw">Kwota kredytu: </label>
                <input id="id_kw" type="text" name="kw" value="<?php out($kwota) ?>" />
                <label for="id_ok">Okres (w latach): </label>
                <input id="id_ok" type="text" name="ok" value="<?php out($okres) ?>" />
                <label for="id_op">Oprocentowanie: </label>
                <input id="id_op" type="text" name="op" value="<?php out($oprocentowanie) ?>" />
            </fieldset>
            <input type="submit" value="Oblicz ratę" class="pure-button pure-button-primary" />
        </form>

        <?php
        // wyswietlenie listy bledow jesli istnieja
        if (isset($messages)) {
            if (count($messages) > 0) {
                echo '<ol style="margin-top: 1em; padding: 1em 1em 1em 2em; border-radius: 0.5em; background-color: #f88; width:25em;">';
                foreach ($messages as $msg) {
                    echo '<li>'.$msg.'</li>';
                }
                echo '</ol>';
            }
        }
        ?>

        <?php if(isset($result)){ ?>
            <div style="margin-top: 1em; padding: 1em; border-radius: 0.5em; background-color: #ff0; width:25em;">
                <?php echo 'Rata: '.round($result,2); ?>
            </div>
        <?php } ?>
    </div>

</body>
</html>
