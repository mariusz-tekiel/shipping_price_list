CREATE DATABASE shipping_app;

USE shipping_app;

CREATE TABLE shipping_data(
    id INT AUTO_INCREMENT PRIMARY KEY,
    postcode VARCHAR(5) NOT NULL,
    total_order_amount DECIMAL(10,2) NOT NULL,
    long_product BOOLEAN NOT NULL,
    shipping_zone VARCHAR(2) NOT NULL,
    shipping_price DECIMAL(10,2) NOT NULL,
    discounted_price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE shipping_zones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    zone VARCHAR(2) NOT NULL,
    shipping_price DECIMAL(10, 2) NOT NULL
);