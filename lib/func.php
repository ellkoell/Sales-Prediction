<?php


$errors = [];

function validate($tv, $radio, $newspaper)
{

    return validateTv($tv) & validateRadio($radio) & validateNewspaper($newspaper);
}

function validateTv($tv)
{
    global $errors;

    if (strlen($tv) == 0) {
        $errors['tv'] = " Tv budget muss inhalt haben";
        return false;
    } else if (strlen($tv) < 0) {
        $errors['tv'] = "budget darf nicht negativ sein";
        return false;
    } else {
        return true;
    }
}

function validateRadio($radio)
{
    global $errors;

    if (strlen($radio) == 0) {
        $errors['radio'] = " radio muss inhalt haben";
        return false;
    } else if (strlen($radio) < 0) {
        $errors['radio'] = "radio darf nicht negativ sein";
        return false;
    } else {
        return true;
    }
}

function validateNewspaper($newspaper)
{
    global $errors;

    if (strlen($newspaper) == 0) {
        $errors['newspaper'] = " zeitung muss inhalt haben";
        return false;
    } else if (strlen($newspaper) < 0) {
        $errors['newspaper'] = "newspaper muss positiv sein!";
        return false;
    } else {
        return true;
    }
}



