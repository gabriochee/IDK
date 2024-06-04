<?php

require('log.php');

$root_path = __FILE__;
$parent_path = dirname(dirname($root_path));
$relative_path = str_replace($parent_path, '', $root_path);

server_log("Consultation de la page " . $relative_path);

?>