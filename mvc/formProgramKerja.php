<?php

$sedangEdit = $program !== null;

$nomorProgram = $program['nomorProgram'] ?? '';
$namaProgram = $program['namaProgram'] ?? '';
$suratKeterangan = $program['suratKeterangan'] ?? '';

$aksiForm = $sedangEdit ? 'update' : 'simpan';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <title>
        <?= $sedangEdit ? 'Edit' : 'Tambah' ?> Program Kerja
    </title>
</head>
<body>

<h1>
    <?= $sedangEdit ? 'Edit' : 'Tambah' ?> Program Kerja
</h1>

<form
    method="POST"
    action="/Laprak_7/mvc/index.php?aksi=<?= $aksiForm ?>"
>
    <?php if ($sedangEdit): ?>
        <input
            type="hidden"
            name="nomorProgram"
            value="<?= (int) $nomorProgram ?>"
        >
    <?php endif; ?>

    <p>
        <label>Nama Program</label><br>

        <input
            type="text"
            name="namaProgram"
            value="<?= htmlspecialchars($namaProgram) ?>"
            required
        >
    </p>

    <p>
        <label>Surat Keterangan</label><br>

        <input
            type="text"
            name="suratKeterangan"
            value="<?= htmlspecialchars($suratKeterangan) ?>"
            required
        >
    </p>

    <button type="submit">
        <?= $sedangEdit ? 'Simpan Perubahan' : 'Simpan' ?>
    </button>

    <a href="/Laprak_7/mvc/index.php">
        Batal
    </a>
</form>

</body>
</html>