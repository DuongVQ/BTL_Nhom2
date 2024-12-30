-- Tạo bảng CSDL người dùng
CREATE TABLE IF NOT EXISTS manager_user.user (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20),
    password VARCHAR(200) NOT NULL,
    role ENUM('admin', 'customer') DEFAULT 'customer',
    create_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    update_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tạo bảng CSDL danh mục sản phẩm
CREATE TABLE IF NOT EXISTS manager_user.categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    image VARCHAR(255),
    description TEXT,
    create_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    update_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tạo bảng CSDL sản phẩm
CREATE TABLE IF NOT EXISTS manager_user.products (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(255) NOT NULL, 
    code VARCHAR(100) NOT NULL UNIQUE, 
    category INT NOT NULL, 
    price DECIMAL(10, 2) NOT NULL, 
    old_price DECIMAL(10, 2), 
    discount INT DEFAULT 0, 
    status ENUM('Còn hàng', 'Hết hàng') DEFAULT 'Còn hàng', 
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category) REFERENCES categories(id)
);

-- Tạo bảng CSDL hình ảnh
CREATE TABLE IF NOT EXISTS manager_user.product_images (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    product_id INT NOT NULL,
    image_url VARCHAR(255) NOT NULL, 
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP, 
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Tạo bảng CSDL màu sắc
CREATE TABLE IF NOT EXISTS manager_user.product_colors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL, 
    color_name VARCHAR(100) NOT NULL, -
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Tạo bảng CSDL kích thước
CREATE TABLE IF NOT EXISTS manager_user.product_sizes (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    product_id INT NOT NULL, 
    size_name VARCHAR(50) NOT NULL, 
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,  
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Tạo bảng CSDL giỏ hàng
CREATE TABLE IF NOT EXISTS manager_user.cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    old_price DECIMAL(10,2) NOT NULL,
    image_url VARCHAR(255),
    color VARCHAR(100),
    size_product VARCHAR(100),
    quantity INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Tạo bảng CSDL đơn hàng
CREATE TABLE IF NOT EXISTS manager_user.orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    status ENUM('Đang xử lý', 'Đang giao', 'Đã giao', 'Đã hủy') DEFAULT 'Đang xử lý',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id)
);

-- Tạo bảng CSDL chi tiết đơn hàng
CREATE TABLE IF NOT EXISTS manager_user.order_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    price_product DECIMAL(10,2) NOT NULL,
    quantity INT DEFAULT 1,
    total DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (order_id) REFERENCES orders(id)
);

-- Tạo bảng CSDL vận chuyển
CREATE TABLE IF NOT EXISTS manager_user.shipment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    fullname VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    country VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL,
    district VARCHAR(100) NOT NULL,
    address TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (order_id) REFERENCES orders(id)
);