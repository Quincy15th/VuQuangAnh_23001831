-- =========================================
-- BÀI 1: QUẢN LÝ GIỎ HÀNG
-- =========================================

-- Khởi tạo database và sử dụng
CREATE DATABASE IF NOT EXISTS shopping_cart;
USE shopping_cart;

-- 1. Tạo bảng cart_items
CREATE TABLE cart_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL
);

-- 2.1. Thêm ít nhất 5 sản phẩm vào bảng
INSERT INTO cart_items (name, price, quantity) VALUES 
('Áo thun nam', 150000.00, 10),
('Quần jean', 250000.00, 4),
('Bít tất', 20000.00, 20),
('Giày thể thao', 500000.00, 2),
('Mũ lưỡi trai', 80000.00, 6);

-- 2.2. Hiển thị toàn bộ sản phẩm
SELECT * FROM cart_items;

-- 2.3. Hiển thị sản phẩm có giá lớn hơn 100000
SELECT * FROM cart_items WHERE price > 100000;

-- 2.4. Hiển thị sản phẩm có số lượng lớn hơn 5
SELECT * FROM cart_items WHERE quantity > 5;

-- 2.5. Sắp xếp sản phẩm theo giá giảm dần
SELECT * FROM cart_items ORDER BY price DESC;

-- 2.6. Cập nhật giá của một sản phẩm (VD: cập nhật giá sản phẩm id = 1)
UPDATE cart_items SET price = 160000.00 WHERE id = 1;

-- 2.7. Cập nhật số lượng của một sản phẩm (VD: cập nhật số lượng sản phẩm id = 2)
UPDATE cart_items SET quantity = 10 WHERE id = 2;

-- 2.8. Xóa một sản phẩm (VD: xóa sản phẩm id = 3)
DELETE FROM cart_items WHERE id = 3;

-- 2.9. Hiển thị tên sản phẩm, giá, số lượng và thành tiền (price x quantity)
SELECT name, price, quantity, (price * quantity) AS total_price 
FROM cart_items;

-- 2.10. Tính tổng tiền của toàn bộ giỏ hàng
SELECT SUM(price * quantity) AS cart_total 
FROM cart_items;


-- =========================================
-- BÀI 2: QUẢN LÝ VÉ XEM PHIM
-- =========================================

-- 1. Tạo bảng movies
CREATE TABLE movies (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    total_seats INT NOT NULL,
    available_seats INT NOT NULL
);

-- 2.1. Thêm ít nhất 5 bộ phim
INSERT INTO movies (title, price, total_seats, available_seats) VALUES 
('Avenger: Endgame', 120000.00, 200, 50),
('Dune 2', 150000.00, 150, 20),
('Mai', 90000.00, 250, 100),
('Kung Fu Panda 4', 110000.00, 180, 60),
('Godzilla x Kong', 130000.00, 220, 10);

-- 2.2. Hiển thị toàn bộ danh sách phim
SELECT * FROM movies;

-- 2.3. Hiển thị phim có giá vé lớn hơn 100000
SELECT * FROM movies WHERE price > 100000;

-- 2.4. Hiển thị phim còn nhiều hơn 50 ghế
SELECT * FROM movies WHERE available_seats > 50;

-- 2.5. Sắp xếp phim theo giá vé giảm dần
SELECT * FROM movies ORDER BY price DESC;

-- 2.6. Cập nhật số ghế còn lại của một phim (VD: phim id = 1 có người mua thêm 10 vé)
UPDATE movies SET available_seats = 40 WHERE id = 1;

-- 2.7. Xóa một phim (VD: xóa phim id = 5)
DELETE FROM movies WHERE id = 5;

-- 2.8. Hiển thị số vé đã bán của từng phim
SELECT title, (total_seats - available_seats) AS sold_tickets 
FROM movies;

-- 2.9. Tính doanh thu của từng phim
SELECT title, ((total_seats - available_seats) * price) AS revenue 
FROM movies;

-- 2.10. Tính tổng doanh thu của tất cả các phim
SELECT SUM((total_seats - available_seats) * price) AS total_revenue 
FROM movies;

-- 2.11. Tìm phim có số vé bán ra nhiều nhất
-- 
SELECT title, (total_seats - available_seats) AS sold_tickets
FROM movies
ORDER BY sold_tickets DESC
LIMIT 1;

