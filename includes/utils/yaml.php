<?php
function YamlAppend($yamlPath, $name, $owner, $write) {
    $shared = fopen($yamlPath, 'a');
    $nameStr = "- name: " . $name . "\n";
   	$ownerStr = "  owner: " . $owner . "\n";
    $writeStr = "  write: " . $write . "\n\n";

    fwrite($shared, $nameStr);
    fwrite($shared, $ownerStr);
    fwrite($shared, $writeStr);
    fwrite($shared, ""); #for empty line

    fclose($shared);
}
?>
