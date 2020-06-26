<?php

//check if it's locked ---> mutex?

include("../includes/utils/yaml.php");
include("../includes/add_coeditor.php");

$curUser = $_POST['user'];
$tablePath = $_POST['table'];
$owner = $_POST['owner'];

$tableName = pathinfo($tablePath)['filename'];
$tableNameWithExt = pathinfo($tablePath)['basename'];

$coeditorsFilePath = "../users/" . $owner . "/coeditors/" . $tableName . ".txt";

$content = file_get_contents($coeditorsFilePath);

$coeditors = explode("\n", $content);

if ($curUser === $owner) {

    array_push($coeditors, $curUser);

    foreach ($coeditors as $coeditor) {

        if ($coeditor !== "") {

            $sharedPath = "../users/" . $coeditor . "/shared_files.yml";
            $sharedArr = YamlParse(file_get_contents($sharedPath));

            // remove the table that is being deleted from all coeditors' shared_tables.yml file
            foreach ($sharedArr as $key => $sharedFileDetails) {
                if ($sharedFileDetails['name'] === $tableNameWithExt && $sharedFileDetails['owner'] === $owner) {
                    unset($sharedArr[$key]);
                }
            }

            //rewrite the shared_tables.yml file
            file_put_contents($sharedPath, "");

            foreach ($sharedArr as $sharedFileDetails) {
                try {
                    YamlAppend($sharedPath, $sharedFileDetails['name'], $sharedFileDetails['owner'], $sharedFileDetails['write']);
                } catch (Exception $e) {
                    header('Location: ../index.php?warn=permissions');
                    exit;
                }
            }
        }
    }

    $beautifierPath = "../users/" . $owner . "/beautifiers/" . $tableName . ".json";
    $cellLockingPath = "../users/" . $owner . "/cell_locking/" . $tableName . ".json";

    //delete beautifiers, locking_cell and coeditor files for the table
    unlink($beautifierPath);
    unlink($cellLockingPath);
    unlink($coeditorsFilePath);

    //delete the table itself from uploads subdirectory
    unlink("../" . $tablePath);

    header('Location: ../index.php?ok=delete_table');
} else {

    //remove the coeditor that deletes the table
    foreach ($coeditors as $key => $coeditor) {

        if ($coeditor === $curUser) {
            unset($coeditors[$key]);
        }
    }

    //rewrite the coeditors file
    foreach ($coeditors as $coeditor) {
        if ($coeditor !== "") {
            AddCoeditor($coeditorsFilePath, $coeditor);
        }
    }

    $sharedPath = "../users/" . $curUser . "/shared_files.yml";
    $sharedArr = YamlParse(file_get_contents($sharedPath));

    // remove the table that is being deleted from current user's shared_tables.yml file
    foreach ($sharedArr as $key => $sharedFileDetails) {
        if ($sharedFileDetails['name'] === $tableNameWithExt && $sharedFileDetails['owner'] === $owner) {
            unset($sharedArr[$key]);
        }
    }

    //rewrite the shared_tables.yml file
    file_put_contents($sharedPath, "");

    foreach ($sharedArr as $sharedFileDetails) {
        try {
            YamlAppend($sharedPath, $sharedFileDetails['name'], $sharedFileDetails['owner'], $sharedFileDetails['write']);
        } catch (Exception $e) {
            header('Location: ../index.php?warn=permissions');
            exit;
        }
    }
}

header('Location: ../index.php?ok=delete_table');
