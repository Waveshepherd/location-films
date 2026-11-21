DROP DATABASE IF EXISTS film_rental;
CREATE DATABASE film_rental CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE film_rental;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    director VARCHAR(100) NOT NULL,
    actors TEXT,
    price DECIMAL(5, 2) NOT NULL,
    image_url VARCHAR(255)
);

CREATE TABLE cart_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    movie_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (movie_id) REFERENCES movies(id)
);

CREATE TABLE purchases (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    movie_id INT,
    purchase_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (movie_id) REFERENCES movies(id)
);

INSERT INTO movies (title, director, actors, price, image_url) VALUES
('Inception', 'Christopher Nolan', 'Leonardo DiCaprio, Joseph Gordon-Levitt, Elliot Page', 3.99, '/images/inception.jpg'),
('Interstellar', 'Christopher Nolan', 'Matthew McConaughey, Anne Hathaway, Jessica Chastain', 4.99, '/images/interstellar.jpg'),
('The Dark Knight : Le Chevalier Noir', 'Christopher Nolan', 'Christian Bale, Heath Ledger, Aaron Eckhart', 3.99, '/images/dark_knight.jpg'),
('Pulp Fiction', 'Quentin Tarantino', 'John Travolta, Uma Thurman, Samuel L. Jackson', 2.99, '/images/pulp_fiction.jpg'),
('Matrix', 'Lana Wachowski, Lilly Wachowski', 'Keanu Reeves, Laurence Fishburne, Carrie-Anne Moss', 2.99, '/images/matrix.jpg'),
('Le Seigneur des Anneaux : La Communauté de l''Anneau', 'Peter Jackson', 'Elijah Wood, Ian McKellen, Viggo Mortensen', 3.99, '/images/lotr.jpg'),
('Gladiator', 'Ridley Scott', 'Russell Crowe, Joaquin Phoenix, Connie Nielsen', 3.49, '/images/gladiator.jpg'),
('Forrest Gump', 'Robert Zemeckis', 'Tom Hanks, Robin Wright, Gary Sinise', 2.99, '/images/forrest_gump.jpg'),
('Parasite', 'Bong Joon-ho', 'Song Kang-ho, Lee Sun-kyun, Cho Yeo-jeong', 4.49, '/images/parasite.jpg'),
('Dune : Deuxième Partie', 'Denis Villeneuve', 'Timothée Chalamet, Zendaya, Rebecca Ferguson', 4.99, '/images/dune2.jpg');
