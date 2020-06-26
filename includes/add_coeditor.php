<?php

function AddCoeditor($pathCoeditors, $userTo){

    if(!is_writeable($pathCoeditors)) {
		throw new Exception('Failed to open');
    }
    
    $coeditorsFile = fopen($pathCoeditors, 'a');
    fwrite($coeditorsFile, $userTo);
    fwrite($coeditorsFile, "\n"); #for empty line
    fclose($coeditorsFile);
}
?>