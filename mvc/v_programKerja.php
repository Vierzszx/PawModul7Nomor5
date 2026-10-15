<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Program Kerja</title>
</head>
<body>

<h1>Data Program Kerja BEM</h1>

<p>
    Login sebagai:
    <strong>
        <?= htmlspecialchars($pengguna->getUsername()) ?>
    </strong>
    —
    <?= htmlspecialchars($pengguna->getJabatan()) ?>
</p>

<p>
    <a href="/Laprak_7/mvc/logout.php">Logout</a>
</p>

<?php if ($pengguna->bolehMengelolaProgram()): ?>
    <p>
        <a href="?aksi=tambah">Tambah Program Kerja</a>
    </p>
<?php else: ?>
    <p>
        Menteri hanya memiliki akses untuk melihat data.
    </p>
<?php endif; ?>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Nomor</th>
            <th>Nama Program</th>
            <th>Surat Keterangan</th>

            <?php if ($pengguna->bolehMengelolaProgram()): ?>
                <th>Aksi</th>
            <?php endif; ?>
        </tr>
    </thead>

    <tbody>
        <?php if (empty($dataProgram)): ?>
            <tr>
                <td colspan="<?= $pengguna->bolehMengelolaProgram() ? 4 : 3 ?>">
                    Belum ada data program kerja.
                </td>
            </tr>
        <?php endif; ?>

        <?php foreach ($dataProgram as $program): ?>
            <tr>
                <td>
                    <?= (int) $program['nomorProgram'] ?>
                </td>

                <td>
                    <?= htmlspecialchars($program['namaProgram']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($program['suratKeterangan']) ?>
                </td>

                <?php if ($pengguna->bolehMengelolaProgram()): ?>
                    <td>
                        <a href="?aksi=edit&id=<?= (int) $program['nomorProgram'] ?>">
                            Edit
                        </a>

                        <form
                            method="POST"
                            action="?aksi=hapus"
                            style="display: inline;"
                            onsubmit="return confirm('Hapus program kerja ini?');"
                        >
                            <input
                                type="hidden"
                                name="nomorProgram"
                                value="<?= (int) $program['nomorProgram'] ?>"
                            >

                            <button type="submit">
                                Hapus
                            </button>
                        </form>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>