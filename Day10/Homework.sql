CREATE TABLE KhachHang (
	id INT PRIMARY KEY AUTO_INCREMENT,
	ten varchar(225),
  	ngay_sinh DATE,
  	gioi_tinh VARCHAR(3),
  	dia_chi TEXT,
  	sdt INT(11)
);

CREATE TABLE NhanVien (
	id INT PRIMARY KEY AUTO_INCREMENT,
	ten VARCHAR(225),
  	ngay_sinh DATE,
  	gioi_tinh VARCHAR(3),
  	chuc_vu VARCHAR(30),
  	email VARCHAR(50),
  	dia_chi TEXT,
  	sdt INT(11)
);

CREATE TABLE DanhMucSP (
	id INT PRIMARY KEY AUTO_INCREMENT,
	ten VARCHAR(225),
	mo_ta TEXT
);

CREATE TABLE SanPham (
	id INT PRIMARY KEY AUTO_INCREMENT,
	id_danhMucSP INT,
	ten VARCHAR(225),
	gia INT, 
	so_luong_ton_tai INT,
	mo_ta TEXT,
	FOREIGN KEY (id_danhMucSP) REFERENCES DanhMucSP(id)
);

CREATE TABLE DonHang (
	id INT PRIMARY KEY AUTO_INCREMENT,
	id_KhachHang INT,
	id_NhanVien INT,
	ngay_tao DATE,
	trang_thai VARCHAR(50),
	tong_tien INT,
	FOREIGN KEY (id_KhachHang) REFERENCES KhachHang(id),
	FOREIGN KEY (id_NhanVien) REFERENCES NhanVien(id)
);

CREATE TABLE ChiTietDonHang (
	id INT PRIMARY KEY AUTO_INCREMENT,
	id_DonHang INT,
	id_SanPham INT,
	so_luong_ban INT,
	gia_ban INT,
	FOREIGN KEY (id_DonHang) REFERENCES DonHang(id),
	FOREIGN KEY (id_SanPham) REFERENCES SanPham(id)
);

CREATE TABLE GioHang (
	id INT PRIMARY KEY AUTO_INCREMENT,
	id_KhachHang INT,
	id_SanPham INT,
	so_luong_sp INT,
	FOREIGN KEY (id_KhachHang) REFERENCES KhachHang(id),
	FOREIGN KEY (id_SanPham) REFERENCES SanPham(id)
);
