<?php

session_start();
session_unset();
session_destroy();

header('Location: /Laprak_7/mvc/login.php');
exit;