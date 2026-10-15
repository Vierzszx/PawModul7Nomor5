<?php

class m_programKerja {
    private mysqli $database;

    public function __construct(mysqli $database) {
        $this->database = $database;
    }

    public function semuaProgramKerja(): array {
        $query = $this->database->query(
            'SELECT nomorProgram, namaProgram, suratKeterangan
             FROM proker
             ORDER BY nomorProgram ASC'
        );

        return $query->fetch_all(MYSQLI_ASSOC);
    }

    public function programBerdasarkanId(int $id): ?array {
        $stmt = $this->database->prepare(
            'SELECT nomorProgram, namaProgram, suratKeterangan
             FROM proker
             WHERE nomorProgram = ?'
        );

        $stmt->bind_param('i', $id);
        $stmt->execute();

        $data = $stmt->get_result()->fetch_assoc();

        return $data ?: null;
    }

    public function tambahProgramKerja(
        string $namaProgram,
        string $suratKeterangan
    ): void {
        $stmt = $this->database->prepare(
            'INSERT INTO proker (namaProgram, suratKeterangan)
             VALUES (?, ?)'
        );

        $stmt->bind_param(
            'ss',
            $namaProgram,
            $suratKeterangan
        );

        $stmt->execute();
    }

    public function ubahProgramKerja(
        int $id,
        string $namaProgram,
        string $suratKeterangan
    ): void {
        $stmt = $this->database->prepare(
            'UPDATE proker
             SET namaProgram = ?, suratKeterangan = ?
             WHERE nomorProgram = ?'
        );

        $stmt->bind_param(
            'ssi',
            $namaProgram,
            $suratKeterangan,
            $id
        );

        $stmt->execute();
    }

    public function hapusProgramKerja(int $id): void {
        $stmt = $this->database->prepare(
            'DELETE FROM proker WHERE nomorProgram = ?'
        );

        $stmt->bind_param('i', $id);
        $stmt->execute();
    }
}