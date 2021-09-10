<?php

namespace App\AbstractFactory;

interface DBFactory {

    public function DBConnection(array $config = []);
    public function DBRecord(string $table);
    public function DBQueryBuilder(string $query);
}
