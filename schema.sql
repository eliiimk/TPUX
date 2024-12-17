CREATE DATABASE IF NOT EXISTS testdb;
USE testdb;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image_url VARCHAR(255)
);


INSERT INTO products (name, description, price, image_url)
VALUES
('tshirt ', 'Un t-shirt confortable en coton, idéal pour les journées décontractées ou comme sous-vêtement.', 19.99, 'images/tshirt.png'),
('pantalon ', 'Pantalon classique en toile, parfait pour un look casual ou plus habillé, avec une coupe moderne.', 29.99, 'images/pantalon.png'),
('jogging ', 'Un jogging doux et élastique, parfait pour vos séances de sport ou des moments de détente à la maison.', 39.99, 'images/jogging.png'),
('sweat ', 'Sweatshirt en coton, avec une coupe ample et confortable, idéal pour l’automne et l’hiver.', 49.99, 'images/sweat.png'),
('chaussures ', 'Chaussures tendance en cuir, avec un design moderne et une semelle confortable pour une utilisation quotidienne.', 59.99, 'images/chaussures.png');
