<?php
function execPrint($command) {
    $result = array();
    exec($command, $result);
    foreach ($result as $line) {
        print($line . "<br>");
    }
}
// Print the exec output inside of a pre element
print("<pre>" . execPrint("git pull https://Shivek-brightcode:ea2392cd8977d4c05210334d1e72dc3b29541e30@github.com/Shivek-brightcode/admin_template.git master") . "</pre>");
?>