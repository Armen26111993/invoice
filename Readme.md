# Invoice Management System

A simple and structured PHP project for managing invoices and invoice_items

**How to run the prject**

1) RUN -> `php migration.php`
2) OPEN urls -> you can find them in index.php

_Route examples_

| Action                  | URL Example                                                                 |
|-------------------------|------------------------------------------------------------------------------------|
| Create Invoice          | http://localhost/invoice/index.php?action=createInvoice                         |
| Get Invoice Total       | http://localhost/invoice/index.php?action=getInvoiceTotal&id=6 

##  Folder Structure

```
migrations/          # SQL migration files
src/Enum/            # Enum definitions
src/Model/           # Entity classes
src/Repository/      # Database queries
src/Service/         # Business logic
```


## Answer For the OPTIMISATION Question
```
1)Использовать индексы для полей фильтрации и сортировки (например, status, date)
2)Внедрить пагинацию, чтобы избежать загрузки всех записей сразу
3)Применять Elasticsearch для быстрого поиска и аналитики
4)Использовать кеширование (Redis или Memcached) для хранения результатов повторяющихся запросов и снижения нагрузки на базу данных
```


