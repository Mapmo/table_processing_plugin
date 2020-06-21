<?php

function SanitizeInput($input)
{
    $input = trim($input);
    $input = htmlspecialchars($input);
    $input = stripslashes($input);

    return $input;
}

function RecursiveCopy($src,$dst) {
	if((file_exists($src) && file_exists($dst)) === false) {
		throw new Exception("Error 403, file not found");
	}
    $dir = opendir($src);
    @mkdir($dst);

    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                RecursiveCopy($src . '/' . $file,$dst . '/' . $file);
            }
            else {
                copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}

function locked($lockFile,$timeout) {
    session_start();
    clearstatcache();


    $who = $_SESSION['user'];
    if (file_exists($lockFile)) {

        $mtime = filemtime($lockFile);
        $lastModified = time() - $mtime;

        if($lastModified < $timeout) {
            $locker = file_get_contents($lockFile);
            if( $locker !== $who) {
                return $locker;
            }
        }
    }

	if(file_exists($lockFile) === true && is_writeable($lockFile) === false) {
		throw new Exception("Error 403, permission to " . $lockFile. " denied");
	}
    $fd = fopen($lockFile, "w+");
    fwrite($fd, $who);

    return $who;
}
