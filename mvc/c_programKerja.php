<?php

class c_programKerja {
    private m_programKerja $model;
    private pengurusBEM $pengguna;

    public function __construct(
        m_programKerja $model,
        pengurusBEM $pengguna
    ) {
        $this->model = $model;
        $this->pengguna = $pengguna;
    }

    public function tampilkan(): void {
        $dataProgram = $this->model->semuaProgramKerja();
        $pengguna = $this->pengguna;

        require __DIR__ . '/v_programKerja.php';
    }

    public function tambah(): void {
        $this->pastikanBolehMengelola();

        $program = null;
        require __DIR__ . '/formProgramKerja.php';
    }

    public function simpan(): void {
        $this->pastikanBolehMengelola();
        $this->pastikanPost();

        $namaProgram = trim($_POST['namaProgram'] ?? '');
        $suratKeterangan = trim($_POST['suratKeterangan'] ?? '');

        if ($namaProgram === '' || $suratKeterangan === '') {
            exit('Nama program dan surat keterangan wajib diisi.');
        }

        $this->model->tambahProgramKerja(
            $namaProgram,
            $suratKeterangan
        );

        $this->kembaliKeIndex();
    }

    public function edit(int $id): void {
        $this->pastikanBolehMengelola();

        $program = $this->model->programBerdasarkanId($id);

        if ($program === null) {
            http_response_code(404);
            exit('Data program kerja tidak ditemukan.');
        }

        require __DIR__ . '/formProgramKerja.php';
    }

    public function update(): void {
        $this->pastikanBolehMengelola();
        $this->pastikanPost();

        $id = filter_input(
            INPUT_POST,
            'nomorProgram',
            FILTER_VALIDATE_INT
        );

        $namaProgram = trim($_POST['namaProgram'] ?? '');
        $suratKeterangan = trim($_POST['suratKeterangan'] ?? '');

        if (!$id || $namaProgram === '' || $suratKeterangan === '') {
            exit('Data yang dikirim tidak lengkap.');
        }

        $this->model->ubahProgramKerja(
            $id,
            $namaProgram,
            $suratKeterangan
        );

        $this->kembaliKeIndex();
    }

    public function hapus(): void {
        $this->pastikanBolehMengelola();
        $this->pastikanPost();

        $id = filter_input(
            INPUT_POST,
            'nomorProgram',
            FILTER_VALIDATE_INT
        );

        if (!$id) {
            exit('Nomor program tidak valid.');
        }

        $this->model->hapusProgramKerja($id);

        $this->kembaliKeIndex();
    }

    private function pastikanBolehMengelola(): void {
        if (!$this->pengguna->bolehMengelolaProgram()) {
            http_response_code(403);

            exit('Akses ditolak. Menteri hanya dapat melihat program kerja.');
        }
    }

    private function pastikanPost(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Metode permintaan tidak diperbolehkan.');
        }
    }

    private function kembaliKeIndex(): void {
        header('Location: /Laprak_7/mvc/index.php');
        exit;
    }
}