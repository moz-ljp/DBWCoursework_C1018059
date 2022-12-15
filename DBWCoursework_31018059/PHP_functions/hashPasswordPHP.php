<?php

//this function simply returns a hashed value of the password using PHPs inbuilt hashing function.

function hashPass(string $password)
{
    return(md5($password));
}

?>