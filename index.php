<?php
    include 'functions.php';
?>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parcijalni ispit - PHP</title>
</head>
<body>
    <div style = "width: 50%; float: left";>
    <form action = "" method = "POST"> <!-- prazni "" znači da poziva samog sebe -->
        <label for ="word"><strong>Koja vas riječ zanima?</strong></label>
        </br>
        </br>
        <input type = "text" name = "word">
        </br>
        </br>
        <input type = "submit" value = "Analiziraj!">
        </form>
    </div>

    <div style = "width: 50%; float: right";>
        <table border = "1" cellpadding = "10">
            <tr> 
                <th>Riječ</th>
                <th>Broj slova</th>
                <th>Broj suglasnika</th>
                <th>Broj samoglasnika</th>
            </tr>

            <?php 
            $wordsJson = file_get_contents(__DIR__."/words.json"); // dir nas dovede do te mape
            $letters = json_decode($wordsJson, true); // sad smo od jsona dobili niz
            // var_dump($letters); // ovo je za provjeru - ako napišemo nešto u json file, sada će biti ispisano ovdje
            if(empty($_POST)) // provjeravamo jel POST prazan
            {
                echo "Unesite željenu riječ";
            }
            elseif(empty($_POST["word"]))
            {
                echo "Polje mora biti popunjeno";
            }
            elseif(!empty($_POST["word"]) && ctype_alpha($_POST["word"])) // provjerava da li su upisano slova
            {
                echo "Unesite riječ";
                $word = $_POST["word"];
                $letters[] = $_POST["word"];
            }
            else
            {
                echo "Uneseno moraju biti slova";
            }
// ------------------------------------------------------------------------------------------------------------------------------------------------

            $wordsJson = json_encode($letters);
            file_put_contents(__DIR__."/words.json", $wordsJson); // kud da spremi i šta da spremi

            foreach($letters as $character)
            {
                $characterCount = strlen($character); // dužina stringa
                $samoglasnikCount = brojacZnakova($character)[0]; // to 0 i 1 je ono u arrayu $samoglasnik $suglasnik - 2 ishoda
                $suglasnikCount = brojacZnakova($character)[1];

                echo '<tr>';
                echo '<td>'.$character.'</td>';
                echo '<td>'.$characterCount.'</td>';
                echo '<td>'.$suglasnikCount.'</td>';
                echo '<td>'.$samoglasnikCount.'</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</body>
</html>