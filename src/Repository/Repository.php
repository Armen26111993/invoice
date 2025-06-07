<?php

namespace App\Repository;

use PDO;

class Repository {

    /**
     * @var PDO
     */
    protected PDO $pdo;

    /**
     * InvoiceRepository constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
}
