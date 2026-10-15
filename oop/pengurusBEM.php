<?php

abstract class pengurusBEM
{
    protected string $username;
    protected string $jabatan;

    public function __construct(string $username, string $jabatan)
    {
        $this->username = $username;
        $this->jabatan = $jabatan;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getJabatan(): string
    {
        return $this->jabatan;
    }

    abstract public function bolehMengelolaProgram(): bool;
}