CREATE DATABASE IF NOT EXISTS `excelsior` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `excelsior`;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  phone VARCHAR(50) DEFAULT "",
  address TEXT DEFAULT "",
  created_at DATETIME NOT NULL
);

CREATE TABLE IF NOT EXISTS password_resets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  token VARCHAR(128) NOT NULL UNIQUE,
  expires_at DATETIME NOT NULL,
  created_at DATETIME NOT NULL
);

CREATE TABLE IF NOT EXISTS settings (
  `key` VARCHAR(64) PRIMARY KEY,
  `value` TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS calculations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NULL,
  name VARCHAR(255) NOT NULL,
  weight_g DOUBLE NOT NULL,
  print_time_h DOUBLE NOT NULL,
  labor_time_h DOUBLE NOT NULL,
  energy_kwh DOUBLE NOT NULL,
  material_cost DOUBLE NOT NULL,
  energy_cost DOUBLE NOT NULL,
  machine_cost DOUBLE NOT NULL,
  labor_cost DOUBLE NOT NULL,
  other_costs DOUBLE NOT NULL,
  overhead_percent DOUBLE NOT NULL,
  margin_percent DOUBLE NOT NULL,
  subtotal DOUBLE NOT NULL,
  overhead DOUBLE NOT NULL,
  cost DOUBLE NOT NULL,
  price DOUBLE NOT NULL,
  display_cost DOUBLE NOT NULL,
  display_price DOUBLE NOT NULL,
  base_currency VARCHAR(3) NOT NULL,
  display_currency VARCHAR(3) NOT NULL,
  created_at DATETIME NOT NULL
);
