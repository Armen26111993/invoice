<?php

namespace App\Service;

use App\Model\InvoiceItem;
use App\Repository\InvoiceItemRepository;

class InvoiceItemService {

    /**
     * @var InvoiceItemRepository
     */
    private InvoiceItemRepository $repository;

    /**
     * InvoiceItemService constructor.
     * @param InvoiceItemRepository $repository
     */
    public function __construct(InvoiceItemRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param InvoiceItem $invoiceItem
     * @param $invoiceId
     * @return int
     */
    public function createInvoiceItem(InvoiceItem $invoiceItem, $invoiceId): int {
        return $this->repository->save($invoiceItem, $invoiceId);
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function getInvoiceItemById(int $id): ?array {
        return $this->repository->getInvoiceItemById($id);
    }

    /**
     * @param int $id
     */
    public function deleteInvoiceItem(int $id): void {
        $this->repository->deleteInvoiceItem($id);
    }
}
