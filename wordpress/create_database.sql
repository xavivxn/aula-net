-- Script para crear la base de datos de WordPress para Aula.Net
-- Ejecutar en phpMyAdmin o línea de comandos MySQL

CREATE DATABASE IF NOT EXISTS aula_net_wp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE aula_net_wp;

-- Dar permisos al usuario root
GRANT ALL PRIVILEGES ON aula_net_wp.* TO 'root'@'localhost';
FLUSH PRIVILEGES;
