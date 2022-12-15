<?php

//this function validates the entered password based upon the following parameters:
//->Contains an upper case character
//->Contains a digit
//->Contains a symbol

function validatePassword(string $password)
{
    $hasCapital = false;
    $hasSymbol = false;
    $hasNumber = false;

    $passwordArray = str_split($password);

    foreach($passwordArray as $character)
    {
        if(ctype_upper($character))
        {
            $hasCapital = true;
        }
        if(ctype_digit($character))
        {
            $hasNumber = true;
        }
        if(ctype_punct($character))
        {
            $hasSymbol = true;
        }
    }

    if($hasCapital and $hasSymbol and $hasNumber)
    {
        return true;
    }

}

?>