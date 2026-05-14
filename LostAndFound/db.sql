CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nim_nip VARCHAR(20) UNIQUE,
    username VARCHAR(50),
    password VARCHAR(255),
    nama VARCHAR(100),
    email VARCHAR(100),
    kontak VARCHAR(20),
    foto VARCHAR(255)
);

CREATE TABLE laporan (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    tipe ENUM('lost', 'found'),
    judul VARCHAR(100),
    kategori VARCHAR(50),
    deskripsi TEXT,
    foto VARCHAR(255),
    lokasi VARCHAR(100),
    tanggal DATE,
    status ENUM('aktif', 'ditemukan', 'diambil', 'ditutup') DEFAULT 'aktif',
    FOREIGN KEY (user_id) REFERENCES users(id)
);