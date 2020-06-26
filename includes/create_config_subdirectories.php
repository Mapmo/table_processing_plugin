<?php

function create_config_subdirectory($path, $newFileName, $extension)
{

    #Create config subdirectory of users/$_SESSION['user'] if it doesn't exist
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }

    #Create config file for the new table in the corresponding subdirectory of users/$_SESSION['user']/
    $configFilePath = $path . $newFileName . $extension;
    $configFile = fopen($configFilePath, 'a');

    #validation if the config file is writeable
    if (is_writeable($configFile) === false) {
        throw new Exception("Error 403, permission to " . $configFile . " denied");
    }
}
