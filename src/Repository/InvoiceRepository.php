<?php

namespace App\Repository;

use App\Model\Invoice;
use PDO;

class InvoiceRepository extends Repository {

    /**
     * @var InvoiceItemRepository
     */
    private InvoiceItemRepository $invoiceItemRepository;

    /**
     * InvoiceRepository constructor.
     * @param PDO $pdo
     * @param InvoiceItemRepository $invoiceItemRepository
     */
    public function __construct(
        PDO $pdo,
        InvoiceItemRepository $invoiceItemRepository
    ) {
        parent::__construct($pdo);
        $this->invoiceItemRepository = $invoiceItemRepository;
    }

    /**
     * @param Invoice $invoice
     * @return int
     */
    public function save(Invoice $invoice): int
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO invoices (number, status, date, discount)
            VALUES (:number, :status, :date, :discount)
        ");

        $number = $invoice->getNumber();
        $status = $invoice->getStatus();
        $date = $invoice->getDate()->format('Y-m-d');
        $discount = $invoice->getDiscount();

        $stmt->bindParam(':number', $number);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':discount', $discount);

        $stmt->execute();

        $invoiceId = $this->pdo->lastInsertId();

        foreach ($invoice->getItems() as $item) {
            $this->invoiceItemRepository->save($item, $invoiceId);
        }

        return $invoiceId;

    }

    /**
     * @param int $invoiceId
     */
    public function deleteInvoice(int $invoiceId): void {
        $stmt = $this->pdo->prepare("DELETE FROM invoices WHERE id = :id");
        $stmt->bindParam(':id', $invoiceId, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function getInvoiceById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM invoices WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $invoice = $stmt->fetch(PDO::FETCH_ASSOC);

        return $invoice === false ? null : $invoice;
    }

    /**
     * @param string $status
     * @param string $date
     * @return array
     */
    public function getInvoicesByDateAndStatus(string $status, string $date): array {
        $stmt = $this->pdo->prepare("SELECT * FROM invoices WHERE status = :status AND date > :date");

        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function getInvoiceWithTotalById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("
            SELECT 
                i.id AS invoice_id,
                i.number,
                i.status,
                i.date,
                i.discount,
                SUM(ii.amount * ii.quantity) AS total_amount,
                SUM(ii.amount * ii.quantity) * (1 - i.discount) AS paid_amount
            FROM invoices i
            LEFT JOIN invoice_items ii ON i.id = ii.invoice_id
            WHERE i.id = :id
            GROUP BY i.id
        ");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $invoice = $stmt->fetch(PDO::FETCH_ASSOC);

        return $invoice === false ? null : $invoice;
    }
}
