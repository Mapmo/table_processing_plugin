<?php

function sanitizeInput($input)
{
    $input = trim($input);
    $input = htmlspecialchars($input);
    $input = stripslashes($input);

    return $input;
}
