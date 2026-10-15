<?php

require_once __DIR__ . '/pengurusBEM.php';

class menteri extends pengurusBEM
{
    public function __construct(string $username)
    {
        parent::__construct($username, 'Menteri');
    }

    public function bolehMengelolaProgram(): bool
    {
        return false;
    }
}