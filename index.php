<?php

require_once 'vendor/autoload.php';
require_once 'config.php';

use App\Enum\InvoiceStatus;
use App\Model\Invoice;
use App\Model\InvoiceItem;
use App\Repository\InvoiceItemRepository;
use App\Repository\InvoiceRepository;
use App\Service\InvoiceItemService;
use App\Service\InvoiceService;


$invoiceItemRepository = new InvoiceItemRepository($pdo);
$invoiceItemService = new InvoiceItemService($invoiceItemRepository);

$invoiceRepository = new InvoiceRepository($pdo, $invoiceItemRepository);
$invoiceService = new InvoiceService($invoiceRepository);

$action = isset($_GET['action']) ? $_GET['action'] : 'default';

switch ($action) {
    case 'createInvoice':
        $invoice = new Invoice();
        $invoice->setNumber("INVOICE-" . rand(100, 999));
        $invoice->setStatus(InvoiceStatus::PAID);
        $invoice->setDate(new DateTime());
        $invoice->setDiscount(0.5); // it means 50% discount

        $item1 = new InvoiceItem();
        $item1->setName("The First Item");
        $item1->setAmount(1000);
        $item1->setQuantity(2);
        $invoice->addItem($item1);

        $item2 = new InvoiceItem();
        $item2->setName("The Second Item");
        $item2->setAmount(1500);
        $item2->setQuantity(3);
        $invoice->addItem($item2);

        $id = $invoiceService->createInvoice($invoice);
        print_r( "Invoice Created | ID: " . $id);
        break;
    case 'getInvoice':
        if (isset($_GET['id'])) {
            $invoice = $invoiceService->getInvoiceById((int)$_GET['id']);

            echo "Invoice:";
            echo "<hr>";
            echo "<pre>";
            print_r($invoice);
            echo "</pre>";
        } else {
            print_r("Invoice Id is required.");
        }

        break;
    case 'deleteInvoice':
        if (isset($_GET['id'])) {
            $invoiceService->deleteInvoice($_GET['id']);
            echo "<pre>";
            print_r("Invoice is deleted Successfully.");
            echo "</pre>";
        } else {
            print_r("Invoice Id is required.");
        }
        break;
    case 'createInvoiceItem':
        if (isset($_GET['id'])) {
        $invoice = $invoiceService->getInvoiceById((int)$_GET['id']);
            if ($invoice) {
                $item = new InvoiceItem();
                $item->setName("Dynamic Item");
                $item->setAmount(2000);
                $item->setQuantity(4);
                $invoiceItemId = $invoiceItemService->createInvoiceItem($item, (int)$invoice['id']);
                print_r("Inovoice Item is added successfully | ID : " . $invoiceItemId);
            } else {
                print_r("Invoice not found");
            }
        } else {
            print_r("Invoice Id is required.");
        }
        break;
    case 'getInvoiceItem':
        if (isset($_GET['id'])) {
            $invoiceItem = $invoiceItemService->getInvoiceItemById((int)$_GET['id']);

            echo "Invoice Item:";
            echo "<hr>";
            echo "<pre>";
            print_r($invoiceItem);
            echo "</pre>";
        } else {
            print_r("InvoiceItem Id is required.");
        }

        break;
    case 'deleteInvoiceItem':
        if (isset($_GET['id'])) {
            $invoiceItemService->deleteInvoiceItem($_GET['id']);
            echo "<pre>";
            print_r("Invoice Item is deleted Successfully.");
            echo "</pre>";
        } else {
            print_r("Invoice Item Id is required.");
        }
        break;
    case 'getInvoiceTotal':
        if (isset($_GET['id'])) {

            $invoiceTotal = $invoiceService->getInvoiceWithTotalById((int)$_GET['id']);
            echo "Invoice Total:";
            echo "<hr>";
            echo "<pre>";
            print_r($invoiceTotal);
            echo "</pre>";
        } else {
            print_r("Invoice Id is required.");
        }
        break;
    case 'getPaidInvoices':
        $paidInvoices = $invoiceService->getInvoicesByDateAndStatus(InvoiceStatus::PAID, "2025-01-01");

        echo "Paid Invoices:\n";
        echo "<hr>";
        echo "<pre>";
        print_r($paidInvoices);
        echo "</pre>";
    default:
        echo "Route not found";
}