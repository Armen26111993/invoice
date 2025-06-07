CREATE TABLE IF NOT EXISTS invoices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    number VARCHAR(50) NOT NULL,
    status ENUM('PAID', 'NOT_PAID', 'PENDING') NOT NULL,
    date DATE NOT NULL,
    discount FLOAT DEFAULT 0
);

CREATE TABLE IF NOT EXISTS invoice_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    invoice_id INT NOT NULL,
    name VARCHAR(100),
    amount FLOAT,
    quantity INT,
    FOREIGN KEY (invoice_id) REFERENCES invoices(id) ON DELETE CASCADE
);
