<?php
function YamlAppend($yamlPath, $name, $owner, $write) {
	if(!is_writeable($yamlPath)) {
		throw new Exception('Failed to open');
	}
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

function YamlParse($content)
{
    $entities = explode("- ", $content);
    $parsedContent = array();

    foreach ($entities as $entity) {
        if (trim($entity) !== "") {
            $rows = explode("\n", $entity);
            $parsedEntity = array();

            foreach ($rows as $row) {
                if (strpos($row, ":") !== FALSE) {
                    $fields = explode(":", $row);

                    for ($i = 0; $i < count($fields); $i = $i + 2) {
                        $parsedEntity[trim($fields[$i])] = trim($fields[$i + 1]);
                    }
                }
            }
            $parsedContent[] = $parsedEntity;
        }
    }
    return $parsedContent;
}
