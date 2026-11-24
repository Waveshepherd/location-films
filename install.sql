DROP DATABASE IF EXISTS film_rental;
CREATE DATABASE film_rental CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE film_rental;

CREATE TABLE user (
    Id_user INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE categorie (
    Id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE movie (
    Id_movie INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    director VARCHAR(100) NOT NULL,
    actors TEXT NOT NULL,
    shortplot TEXT NOT NULL,
    plot TEXT,
    price DECIMAL(5, 2) NOT NULL,
    image_url VARCHAR(255) NOT NULL
);

CREATE TABLE purchase (
    Id_purchase INT AUTO_INCREMENT PRIMARY KEY,
    purchase_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    Id_user INT NOT NULL,
    Id_movie INT NOT NULL,
    FOREIGN KEY (Id_user) REFERENCES user(Id_user) ON DELETE CASCADE,
    FOREIGN KEY (Id_movie) REFERENCES movie(Id_movie) ON DELETE CASCADE
);

CREATE TABLE movie_categorie (
    Id_categorie INT,
    Id_movie INT,
    PRIMARY KEY (Id_categorie, Id_movie),
    FOREIGN KEY (Id_categorie) REFERENCES categorie(Id_categorie) ON DELETE CASCADE,
    FOREIGN KEY (Id_movie) REFERENCES movie(Id_movie) ON DELETE CASCADE
);

CREATE TABLE cart_item (
    Id_user INT,
    Id_movie INT,
    PRIMARY KEY (Id_user, Id_movie),
    FOREIGN KEY (Id_user) REFERENCES user(Id_user) ON DELETE CASCADE,
    FOREIGN KEY (Id_movie) REFERENCES movie(Id_movie) ON DELETE CASCADE
);

INSERT INTO categorie (Id_categorie, name) VALUES
(1, 'Action'),
(2, 'Drame'),
(3, 'Science-Fiction');

INSERT INTO movie (Id_movie, title, director, actors, shortplot, plot, price, image_url) VALUES
(1, 'The Dark Knight', 'Christopher Nolan', 'Christian Bale, Heath Ledger, Aaron Eckhart', 'Batman affronte le Joker à Gotham.', 'Batman s''allie au procureur Harvey Dent pour démanteler le crime organisé, mais le Joker plonge Gotham dans le chaos.', 3.99, 'https://placehold.co'),
(2, 'Gladiator', 'Ridley Scott', 'Russell Crowe, Joaquin Phoenix, Connie Nielsen', 'Un général romain devient gladiateur.', 'Trahi par le fils de l''empereur, le général Maximus lutte dans l''arène du Colisée pour venger sa famille.', 3.49, 'https://placehold.co'),
(3, 'John Wick', 'Chad Stahelski', 'Keanu Reeves, Michael Nyqvist, Alfie Allen', 'Un ancien tueur à gages reprend du service.', 'Après la mort de sa femme, un ancien tueur à gages redouté traque les gangsters qui ont détruit sa vie.', 2.99, 'https://placehold.co'),
(4, 'Top Gun : Maverick', 'Joseph Kosinski', 'Tom Cruise, Miles Teller, Jennifer Connelly', 'Maverick forme l''élite des pilotes.', 'Pete Mitchell doit former un détachement de jeunes diplômés de Top Gun pour une mission périlleuse.', 4.49, 'https://placehold.co'),
(5, 'Kill Bill : Volume 1', 'Quentin Tarantino', 'Uma Thurman, Lucy Liu, Vivica A. Fox', 'La quête de vengeance d''une ancienne tueuse.', 'Sortie d''un coma de quatre ans, la Mariée traque les membres du commando qui ont massacré ses proches.', 2.99, 'https://placehold.co'),
(6, 'Mission Impossible : Fallout', 'Christopher McQuarrie', 'Tom Cruise, Henry Cavill, Rebecca Ferguson', 'Course contre la montre nucléaire.', 'Ethan Hunt et son équipe doivent retrouver trois ogives au plutonium volées avant une catastrophe mondiale.', 3.99, 'https://placehold.co'),
(7, 'Skyfall', 'Sam Mendes', 'Daniel Craig, Javier Bardem, Judi Dench', 'James Bond protège M.', 'Lorsque le MI6 est attaqué, James Bond doit traquer un cyberterroriste lié au passé de M.', 3.49, 'https://placehold.co'),
(8, 'Die Hard : Piège de cristal', 'John McTiernan', 'Bruce Willis, Alan Rickman, Bonnie Bedelia', 'Un policier seul face à des terroristes.', 'Le soir de Noël, John McClane affronte seul un groupe armé dans un gratte-ciel de Los Angeles.', 2.99, 'https://placehold.co'),
(9, 'Casino Royale', 'Martin Campbell', 'Daniel Craig, Eva Green, Mads Mikkelsen', 'La première mission 00 de James Bond.', 'James Bond doit battre le banquier du terrorisme Le Chiffre lors d''une partie de poker au Monténégro.', 3.49, 'https://placehold.co'),
(10, 'Mad Max : Fury Road', 'George Miller', 'Tom Hardy, Charlize Theron, Nicholas Hoult', 'Course-poursuite dans un désert post-apocalyptique.', 'Max s''allie à Furiosa pour fuir un tyran à travers le désert à bord d''un camion blindé.', 3.99, 'https://placehold.co'),
(11, 'Forrest Gump', 'Robert Zemeckis', 'Tom Hanks, Robin Wright, Gary Sinise', 'Le destin hors du commun d''un homme simple.', 'Assis sur un banc, Forrest Gump raconte sa vie extraordinaire à travers l''histoire américaine.', 2.99, 'https://placehold.co'),
(12, 'Parasite', 'Bong Joon-ho', 'Song Kang-ho, Lee Sun-kyun, Cho Yeo-jeong', 'Deux familles que tout oppose.', 'La famille de Ki-taek s''immisce peu à peu dans le quotidien de la richissime famille Park.', 4.49, 'https://placehold.co'),
(13, 'Les Évadés', 'Frank Darabont', 'Tim Robbins, Morgan Freeman, Bob Gunton', 'L''espoir derrière les barreaux de Shawshank.', 'Condamné à perpétuité, le banquier Andy Dufresne noue une amitié profonde avec Red.', 3.49, 'https://placehold.co'),
(14, 'La Liste de Schindler', 'Steven Spielberg', 'Liam Neeson, Ben Kingsley, Ralph Fiennes', 'Un industriel sauve plus d''un millier de vies.', 'À Cracovie, Oskar Schindler transforme son usine en refuge pour sauver des Juifs polonais.', 3.49, 'https://placehold.co'),
(15, 'Whiplash', 'Damien Chazelle', 'Miles Teller, J.K. Simmons, Melissa Benoist', 'Le prix de l''excellence musicale.', 'Un jeune batteur de jazz est poussé au-delà de ses limites par un professeur tyrannique.', 3.99, 'https://placehold.co'),
(16, 'Joker', 'Todd Phillips', 'Joaquin Phoenix, Robert De Niro, Zazie Beetz', 'La bascule d''un homme isolé vers la folie.', 'Ignoré par la société, Arthur Fleck sombre dans la folie et devient une figure de la révolte à Gotham.', 3.99, 'https://placehold.co'),
(17, 'Oppenheimer', 'Christopher Nolan', 'Cillian Murphy, Emily Blunt, Matt Damon', 'La création de la première arme nucléaire.', 'Le portrait du physicien J. Robert Oppenheimer et son rôle dans le projet Manhattan.', 4.99, 'https://placehold.co'),
(18, 'Le Pianiste', 'Roman Polanski', 'Adrien Brody, Thomas Kretschmann, Frank Finlay', 'La survie d''un musicien dans Varsovie occupée.', 'L''histoire vraie du pianiste Władysław Szpilman survivant caché dans les ruines de Varsovie.', 2.99, 'https://placehold.co'),
(19, 'Pulp Fiction', 'Quentin Tarantino', 'John Travolta, Uma Thurman, Samuel L. Jackson', 'Histoires croisées de gangsters à Los Angeles.', 'Les destins de deux tueurs à gages, d''un boxeur et de la femme d''un caïd s''entremêlent.', 2.99, 'https://placehold.co'),
(20, 'Good Will Hunting', 'Gus Van Sant', 'Matt Damon, Robin Williams, Ben Affleck', 'Un génie rebelle face à son potentiel.', 'Will Hunting, jeune surdoué agent d''entretien au MIT, accepte de suivre une thérapie.', 3.49, 'https://placehold.co'),
(21, 'Inception', 'Christopher Nolan', 'Leonardo DiCaprio, Joseph Gordon-Levitt, Elliot Page', 'Infiltration au cœur des rêves.', 'Dom Cobb est un voleur expérimenté spécialisé dans l''extraction de secrets durant le sommeil.', 3.99, 'https://placehold.co'),
(22, 'Interstellar', 'Christopher Nolan', 'Matthew McConaughey, Anne Hathaway, Jessica Chastain', 'Voyage au-delà de notre galaxie.', 'Une équipe d''explorateurs traverse un trou de ver pour trouver une nouvelle planète habitable.', 4.99, 'https://placehold.co'),
(23, 'Matrix', 'Lana Wachowski, Lilly Wachowski', 'Keanu Reeves, Laurence Fishburne, Carrie-Anne Moss', 'Le monde réel n''est qu''une simulation.', 'Neo découvre que l''humanité est maintenue dans une réalité virtuelle par des machines.', 2.99, 'https://placehold.co'),
(24, 'Dune : Deuxième Partie', 'Denis Villeneuve', 'Timothée Chalamet, Zendaya, Rebecca Ferguson', 'L''ascension de Paul Atréides sur Arrakis.', 'Paul Atréides s''unit aux Fremen pour mener la guerre contre ceux qui ont détruit sa famille.', 4.99, 'https://placehold.co'),
(25, 'Blade Runner 2049', 'Denis Villeneuve', 'Ryan Gosling, Harrison Ford, Ana de Armas', 'Un secret enfoui menace la société.', 'L''officier K découvre un mystère qui le mène sur la trace de l''ancien blade runner Rick Deckard.', 3.99, 'https://placehold.co'),
(26, 'Arrival (Premier Contact)', 'Denis Villeneuve', 'Amy Adams, Jeremy Renner, Forest Whitaker', 'Décrypter un langage extraterrestre.', 'Une linguiste est recrutée pour établir le premier contact avec des vaisseaux extraterrestres.', 3.99, 'https://placehold.co'),
(27, 'Alien : Le Huitième Passager', 'Ridley Scott', 'Sigourney Weaver, Tom Skerritt, John Hurt', 'Dans l''espace, personne ne vous entendra crier.', 'L''équipage du Nostromo ramène à bord une créature extraterrestre mortelle.', 2.99, 'https://placehold.co'),
(28, 'Seul sur Mars', 'Ridley Scott', 'Matt Damon, Jessica Chastain, Kristen Wiig', 'Survivre seul sur la planète rouge.', 'Laissé pour mort sur Mars, l''astronaute Mark Watney doit user de son ingéniosité pour survivre.', 3.99, 'https://placehold.co'),
(29, 'Ex Machina', 'Alex Garland', 'Domhnall Gleeson, Alicia Vikander, Oscar Isaac', 'Un test de Turing qui tourne au duel.', 'Un programmeur évalue la conscience humaine d''Ava, un robot humanoïde sophistiqué.', 3.49, 'https://placehold.co'),
(30, 'Tenet', 'Christopher Nolan', 'John David Washington, Robert Pattinson, Elizabeth Debicki', 'Manipuler l''inversion du temps.', 'Un agent secret opère dans l''ombre pour empêcher une Troisième Guerre mondiale.', 4.49, 'https://placehold.co');

INSERT INTO movie_categorie (Id_categorie, Id_movie) VALUES
(1, 1), (2, 1), (1, 2), (2, 2), (1, 3), (1, 4), (2, 4), (1, 5), (1, 6), (1, 7), (1, 8), (1, 9), (1, 10), (3, 10),
(2, 11), (2, 12), (2, 13), (2, 14), (2, 15), (2, 16), (2, 17), (2, 18), (2, 19), (1, 19), (2, 20),
(3, 21), (1, 21), (2, 21), (3, 22), (2, 22), (3, 23), (1, 23), (3, 24), (1, 24), (2, 24), (3, 25), (2, 25),
(3, 26), (2, 26), (3, 27), (1, 27), (3, 28), (2, 28), (3, 29), (2, 29), (3, 30), (1, 30);