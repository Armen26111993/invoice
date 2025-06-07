<?php

namespace App\Service;

use App\Repository\InvoiceRepository;
use App\Model\Invoice;

class InvoiceService {

    /**
     * @var InvoiceRepository
     */
    private InvoiceRepository $repository;

    /**
     * InvoiceService constructor.
     * @param InvoiceRepository $repository
     */
    public function __construct(InvoiceRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param Invoice $invoice
     * @return int
     */
    public function createInvoice(Invoice $invoice): int {
        return $this->repository->save($invoice);
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function getInvoiceById(int $id): ?array {
        return $this->repository->getInvoiceById($id);
    }

    /**
     * @param int $id
     */
    public function deleteInvoice(int $id): void {
        $this->repository->deleteInvoice($id);
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function getInvoiceWithTotalById(int $id):? array {
        return $this->repository->getInvoiceWithTotalById($id);
    }

    /**
     * @param string $status
     * @param string $date
     * @return array
     */
    public function getInvoicesByDateAndStatus(string $status, string $date): array {
        return $this->repository->getInvoicesByDateAndStatus($status, $date);
    }
}
