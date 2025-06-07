<?php

namespace App\Repository;

use App\Model\InvoiceItem;
use PDO;

class InvoiceItemRepository extends Repository {

    /**
     * InvoiceRepository constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo) {
        parent::__construct($pdo);
    }

    /**
     * @param InvoiceItem $invoiceItem
     * @param $invoiceId
     * @return int
     */
    public function save(InvoiceItem $invoiceItem, $invoiceId): int
    {
        $itemStmt = $this->pdo->prepare("
            INSERT INTO invoice_items (invoice_id, name, amount, quantity)
            VALUES (:invoice_id, :name, :amount, :quantity)
        ");

        $name = $invoiceItem->getName();
        $amount = $invoiceItem->getAmount();
        $quantity = $invoiceItem->getQuantity();

        $itemStmt->bindParam(':invoice_id', $invoiceId, \PDO::PARAM_INT);
        $itemStmt->bindParam(':name', $name);
        $itemStmt->bindParam(':amount', $amount);
        $itemStmt->bindParam(':quantity', $quantity, \PDO::PARAM_INT);

        $itemStmt->execute();

        return $this->pdo->lastInsertId();
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function getInvoiceItemById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM invoice_items WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $invoiceItem = $stmt->fetch(PDO::FETCH_ASSOC);

        return $invoiceItem === false ? null : $invoiceItem;
    }

    /**
     * @param int $invoiceItemId
     */
    public function deleteInvoiceItem(int $invoiceItemId): void {
        $stmt = $this->pdo->prepare("DELETE FROM invoice_items WHERE id = :id");
        $stmt->bindParam(':id', $invoiceItemId, PDO::PARAM_INT);
        $stmt->execute();
    }
}
