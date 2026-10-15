<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$mysqli = new mysqli(
    'localhost',
    'root',
    'Dzaikra696.',
    'PrakPAW7'
);

$mysqli->set_charset('utf8mb4');