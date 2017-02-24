<?php
// To Run API Simulator:
/*
 * #1: cd /path/to/source/api
 * #2: php -S localhost:8080 index.php
 * #3: from any client: "http://localhost:8080/api/widget/xxx" where "xxx" = the name of the widget
 *
 * Look in /path/to/source/api/data.txt for widgets
 */
$url = 'http://localhost:8080/api/widget/test';
echo file_get_contents($url);
