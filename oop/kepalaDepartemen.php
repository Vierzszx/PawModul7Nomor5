<?php

require_once __DIR__ . '/pengurusBEM.php';

class kepalaDepartemen extends pengurusBEM {
    public function __construct(string $username) {
        parent::__construct($username, 'Kepala Departemen');
    }

    public function bolehMengelolaProgram(): bool {
        return true;
    }
}