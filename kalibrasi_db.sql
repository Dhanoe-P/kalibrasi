CREATE DATABASE IF NOT EXISTS kalibrasi_db;
USE kalibrasi_db;

CREATE TABLE IF NOT EXISTS data_kalibrasi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_alat VARCHAR(100) NOT NULL,
    merk VARCHAR(50),
    model VARCHAR(50),
    nomor_seri VARCHAR(50),
    tanggal_kalibrasi DATE,
    teknisi VARCHAR(50),
    hasil VARCHAR(20),
    keterangan TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
