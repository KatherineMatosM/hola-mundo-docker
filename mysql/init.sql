-- init.sql
-- Script de inicializacion automatica de la base de datos

CREATE DATABASE IF NOT EXISTS hellodb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE hellodb;

CREATE TABLE IF NOT EXISTS visits (
    id         INT          AUTO_INCREMENT PRIMARY KEY,
    visited_at DATETIME     NOT NULL DEFAULT NOW(),
    ip         VARCHAR(45)  DEFAULT NULL
) ENGINE=InnoDB;