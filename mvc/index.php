<?php

require_once __DIR__ . '/auth.php';
harusLogin();

require_once __DIR__ . '/koneksiMVC.php';
require_once __DIR__ . '/m_programKerja.php';
require_once __DIR__ . '/c_programKerja.php';

$pengguna = penggunaAktif();
$model = new m_programKerja($mysqli);
$controller = new c_programKerja($model, $pengguna);

$aksi = $_GET['aksi'] ?? 'tampil';

switch ($aksi) {
    case 'tambah':
        $controller->tambah();
        break;

    case 'simpan':
        $controller->simpan();
        break;

    case 'edit':
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if (!$id) {
            exit('Nomor program tidak valid.');
        }

        $controller->edit($id);
        break;

    case 'update':
        $controller->update();
        break;

    case 'hapus':
        $controller->hapus();
        break;

    default:
        $controller->tampilkan();
        break;
}