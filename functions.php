<?php // sad moram napisat funkcije za slova (samoglasnici, suglasnici, broj slova)
function brojacZnakova($word)
{
    $word = strtolower($word); // prebaci slova u lower case
    $word = str_split($word); // podijeli riječ na slova

    $suglasnik = 0;
    $samoglasnik = 0;

    foreach($word as $character) // $word je ime niza (riječ) a ovo as je naziv kojeg smo dodijelili svakom elementu tog niza (svako slovo)
    {
    switch($character)
    {
        case "a":
        case "e":
        case "i":
        case "o":
        case "u":
            $samoglasnik++;
            break;

        default:
            $suglasnik++;
            break;
    }
    }
    return array($samoglasnik, $suglasnik); // vraća nam ta dva polja
}
?>