<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once dirname(__DIR__) . '/oop/pengurusBEM.php';
require_once dirname(__DIR__) . '/oop/menteri.php';
require_once dirname(__DIR__) . '/oop/kepalaDepartemen.php';

function harusLogin(): void {
    if (!isset($_SESSION['username'], $_SESSION['jabatan'])) {
        header('Location: /Laprak_7/mvc/login.php');
        exit;
    }
}

function penggunaAktif(): pengurusBEM {
    $username = $_SESSION['username'];
    $jabatan = $_SESSION['jabatan'];

    if ($jabatan === 'kepala_departemen') {
        return new kepalaDepartemen($username);
    }

    return new menteri($username);
}