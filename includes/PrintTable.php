<?php
	include "SimpleXLSX.php";
	if ($xlsx = SimpleXLSX::parse( $_GET['table'])) {
        	echo '<table><tbody>';

                foreach ($xlsx->rows() as $r) {
                    echo '<tr><td><div contenteditable>' . implode('</div></td><td><div contenteditable>', $r) . '</div></td></tr>';
                }
	} else {
                echo SimpleXLSX::parseError();
        }
