
// change the seed for nbr of user.
var seed = 500;

var fake = {
    gender: ['garçon', 'fille'],

    first_names: ['Abel', 'Achille', 'Adam', 'Adel', 'Adrien', 'Agathe',
    'Ahmed', 'Alain', 'Albert', 'Alexandre', 'Alexia', 'Alexis', 'Alice',
    'Alicia', 'Alix', 'Alphonse', 'Amandine', 'Amaury', 'Ambre',
    'Ambroise', 'Amine', 'Anaelle', 'Anais', 'Anatole', 'Anaïs', 'André',
    'Ange', 'Angélique', 'Anna', 'Anne', 'Anouk', 'Anthony', 'Antoine',
    'Antonin', 'Apolline', 'Armand', 'Arnaud', 'Arthur', 'Aubin',
    'Auguste', 'Augustin', 'Aurélien', 'Axel', 'Axelle', 'Aymeric',
    'Baptiste', 'Basile', 'Bastien', 'Benjamin', 'Bernard', 'Bilal',
    'Brian', 'Camille', 'Candice', 'Capucine', 'Caroline', 'Celia',
    'Charles', 'Charlie', 'Charline', 'Charlotte', 'Chloé', 'Christian',
    'Clara', 'Clarisse', 'Claude', 'Clémence', 'Clément', 'Colin',
    'Coline', 'Come', 'Constance', 'Corentin', 'Cyprien', 'Cyril',
    'Célia', 'Damien', 'Daniel', 'David', 'Denis', 'Dimitri', 'Dorian',
    'Dylan', 'Eden', 'Edgar', 'Edouard', 'Eliane', 'Elie', 'Elisa',
    'Elise', 'Eloise', 'Elsa', 'Emile', 'Emilie', 'Emilien', 'Emma',
    'Emmanuel', 'Enola', 'Enora', 'Enzo', 'Erwann', 'Esteban', 'Ethan',
    'Etienne', 'Eva', 'Fabien', 'Fabrice', 'Fanny', 'Faustine', 'Felix',
    'Florence', 'Florent', 'Florian', 'François', 'François-Xavier',
    'Félix', 'Gabriel', 'Gabrielle', 'Garance', 'Gaspard', 'Gauthier',
    'Gaël', 'Gaëtan', 'Georges', 'Gregory', 'Grégoire', 'Guilhem',
    'Guillaume', 'Hector', 'Henri', 'Henriette', 'Hippolyte', 'Hortense',
    'Hugo', 'Hugues', 'Héloïse', 'Hélène', 'Ibrahim', 'Ines', 'Iris',
    'Ismaël', 'Jade', 'Jean', 'Jean-Baptiste', 'Jean-Philippe', 'Jean-Yves',
    'Jeanine', 'Jeanne', 'Jeremy', 'Joachim', 'Joan', 'Johan',
    'Jonathan', 'Jordan', 'Joris', 'Joseph', 'Joshua', 'Jules', 'Julia',
    'Julie', 'Julien', 'Juliette', 'Justin', 'Justine', 'Jérémie',
    'Karim', 'Kenza', 'Kevin', 'Lana', 'Laura', 'Laurent', 'Leon',
    'Leonie', 'Liam', 'Lili', 'Lilia', 'Lilian', 'Lily', 'Lise', 'Lison',
    'Loic', 'Lola', 'Lou', 'Louis', 'Louise', 'Luc', 'Lucas', 'Lucie',
    'Lucien', 'Lucile', 'Luna', 'Lylou', 'Léa', 'Léandre', 'Léane', 'Léo',
    'Léon', 'Léonard', 'Léonie', 'Léopold', 'Mae', 'Mael', 'Maelle',
    'Maeva', 'Mahé', 'Manon', 'Marc', 'Margaux', 'Margot', 'Marianne',
    'Marie', 'Marie-Caroline', 'Marie-Hélène', 'Marine', 'Marion',
    'Marius', 'Martin', 'Mathias', 'Mathieu', 'Mathilde', 'Matthieu',
    'Max', 'Maxence', 'Maxime', 'Maya', 'Maël', 'Maëlys', 'Mehdi',
    'Meline', 'Mickael', 'Miguel', 'Mireille', 'Mohammed', 'Morgan',
    'Morgane', 'Muriel', 'Myriam', 'Mélissa', 'Nathan', 'Nicolas',
    'Nicole', 'Nina', 'Ninon', 'Noemie', 'Noémie', 'Oceane', 'Océane',
    'Olivia', 'Olivier', 'Omar', 'Oscar', 'Paul', 'Paulette', 'Pauline',
    'Phillipe', 'Pierre', 'Pierre-Olivier', 'Pierre-Yves', 'Quentin',
    'Rachel', 'Raphaël', 'Raymond', 'Renaud', 'René', 'Richard', 'Robert',
    'Robin', 'Romain', 'Romane', 'Roméo', 'Rose', 'Roxane', 'Rémi',
    'Salomé', 'Samuel', 'Sandra', 'Sarah', 'Sasha', 'Selma', 'Shana',
    'Simon', 'Stella', 'Thibaud', 'Thomas', 'Théo', 'Théodore',
    'Théophile', 'Timothée', 'Tristan', 'Ursule', 'Valentin', 'Valentine',
    'Victoire', 'Victor', 'Victoria', 'Vincent', 'Violette', 'Xavier',
    'Yanis', 'Yann', 'Yasmine', 'Yoann', 'Yves', 'Zoé', 'Élodie',
    'Éléonore', 'Émilie'],

    last_names: ['Abbott', 'Abernathy', 'Abshire', 'Adams', 'Altenwerth',
    'Anderson', 'Ankunding', 'Armstrong', 'Auer', 'Aufderhar', 'Bahringer',
    'Bailey', 'Balistreri', 'Barrows', 'Bartell', 'Bartoletti', 'Barton',
    'Bashirian', 'Batz', 'Bauch', 'Baumbach', 'Bayer', 'Beahan', 'Beatty',
    'Bechtelar', 'Becker', 'Bednar', 'Beer', 'Beier', 'Berge', 'Bergnaum',
    'Bergstrom', 'Bernhard', 'Bernier', 'Bins', 'Blanda', 'Blick', 'Block',
    'Bode', 'Boehm', 'Bogan', 'Bogisich', 'Borer', 'Bosco', 'Botsford', 'Boyer',
    'Boyle', 'Bradtke', 'Brakus', 'Braun', 'Breitenberg', 'Brekke', 'Brown', 'Bruen',
    'Buckridge', 'Carroll', 'Carter', 'Cartwright', 'Casper', 'Cassin', 'Champlin',
    'Christiansen', 'Cole', 'Collier', 'Collins', 'Conn', 'Connelly', 'Conroy', 'Considine',
    'Corkery', 'Cormier', 'Corwin', 'Cremin', 'Crist', 'Crona', 'Cronin', 'Crooks',
    'Cruickshank', 'Cummerata', 'Cummings', 'Dach', 'Daniel', 'Dare', 'Daugherty',
    'Davis', 'Deckow', 'Denesik', 'Dibbert', 'Dickens', 'Dicki', 'Dickinson',
    'Dietrich', 'Donnelly', 'Dooley', 'Douglas', 'Doyle', 'DuBuque', 'Durgan',
    'Ebert', 'Effertz', 'Eichmann', 'Emard', 'Emmerich', 'Erdman', 'Ernser',
    'Fadel', 'Fahey', 'Farrell', 'Fay', 'Feeney', 'Feest', 'Feil', 'Ferry',
    'Fisher', 'Flatley', 'Frami', 'Franecki', 'Friesen', 'Fritsch', 'Funk',
    'Gaylord', 'Gerhold', 'Gerlach', 'Gibson', 'Gislason', 'Gleason', 
    'Gleichner', 'Glover', 'Goldner', 'Goodwin', 'Gorczany', 'Gottlieb', 
    'Goyette', 'Grady', 'Graham', 'Grant', 'Green', 'Greenfelder', 
    'Greenholt', 'Grimes', 'Gulgowski', 'Gusikowski', 'Gutkowski', 
    'Gutmann', 'Haag', 'Hackett', 'Hagenes', 'Hahn', 'Haley', 'Halvorson', 
    'Hamill', 'Hammes', 'Hand', 'Hane', 'Hansen', 'Harber', 'Harris', 
    'Hartmann', 'Harvey', 'Hauck', 'Hayes', 'Heaney', 'Heathcote', 'Hegmann', 
    'Heidenreich', 'Heller', 'Herman', 'Hermann', 'Hermiston', 'Herzog', 
    'Hessel', 'Hettinger', 'Hickle', 'Hilll', 'Hills', 'Hilpert', 'Hintz', 
    'Hirthe', 'Hodkiewicz', 'Hoeger', 'Homenick', 'Hoppe', 'Howe', 'Howell', 
    'Hudson', 'Huel', 'Huels', 'Hyatt', 'Jacobi', 'Jacobs', 'Jacobson', 
    'Jakubowski', 'Jaskolski', 'Jast', 'Jenkins', 'Jerde', 'Jewess', 'Johns', 
    'Johnson', 'Johnston', 'Jones', 'Kassulke', 'Kautzer', 'Keebler', 'Keeling', 
    'Kemmer', 'Kerluke', 'Kertzmann', 'Kessler', 'Kiehn', 'Kihn', 'Kilback', 
    'King', 'Kirlin', 'Klein', 'Kling', 'Klocko', 'Koch', 'Koelpin', 'Koepp', 
    'Kohler', 'Konopelski', 'Koss', 'Kovacek', 'Kozey', 'Krajcik', 'Kreiger',
    'Adam', 'Albert', 'Alexandre', 'Allain', 'Allard',
    'Alves', 'Andre', 'Antoine', 'Arnaud', 'Aubert', 'Aubry', 'Auger',
    'Bailly', 'Barbe', 'Barbier', 'Baron', 'Barre', 'Barthelemy',
    'Bataille', 'Baudry', 'Bayle', 'Bazin', 'Benard', 'Benoit', 'Berger',
    'Bernard', 'Berthelot', 'Berthier', 'Bertin', 'Bertrand', 'Besnard',
    'Besse', 'Besson', 'Bigot', 'Blanc', 'Blanchard', 'Blanchet', 'Blin',
    'Blondel', 'Blot', 'Bodin', 'Bonhomme', 'Bonneau', 'Bonnet',
    'Bouchard', 'Boucher', 'Bouchet', 'Boulanger', 'Boulay', 'Bouquet',
    'Bourdon', 'Bourgeois', 'Bousquet', 'Boutin', 'Bouvet', 'Bouvier',
    'Boyer', 'Brault', 'Breton', 'Briand', 'Brun', 'Bruneau', 'Brunel',
    'Brunet', 'Buisson', 'Camus', 'Cardinal', 'Carlier', 'Caron',
    'Carpentier', 'Carre', 'Chapuis', 'Charbonnier', 'Charles',
    'Charpentier', 'Charrier', 'Chartier', 'Chauveau', 'Chauvet',
    'Chauvin', 'Chevalier', 'Chevallier', 'Chretien', 'Claude', 'Clement',
    'Clerc', 'Cohen', 'Colas', 'Colin', 'Collet', 'Collin', 'Cordier',
    'Cornu', 'Costa', 'Coste', 'Coulon', 'Courtois', 'Cousin',
    'Couturier', 'Da Costa', 'Da Silva', 'Daniel', 'David', 'Delage',
    'Delahaye', 'Delannoy', 'Delattre', 'Delaunay', 'Delhors', 'Delmas',
    'Delorme', 'Denis', 'Descamps', 'Deschamps', 'Devaux', 'Didier',
    'Dos Santos', 'Doucet', 'Dubois', 'Dubreuil', 'Duchêne', 'Dufour',
    'Duhamel', 'Dumas', 'Dumont', 'Dupond', 'Dupont', 'Dupré', 'Dupuis',
    'Dupuy', 'Durand', 'Durant', 'Duval', 'Etienne', 'Evrard', 'Fabre',
    'Faivre', 'Faure', 'Favre', 'Fernandes', 'Fernandez', 'Ferrand',
    'Ferreira', 'Ferry', 'Fischer', 'Flament', 'Fleury', 'Florent',
    'Fontaine', 'Foucher', 'Fouquet', 'Fournier', 'Francois', 'François',
    'Gaillard', 'Gallet', 'Garcia', 'Garnier', 'Gaudin', 'Gauthier',
    'Gautier', 'Gay', 'Geoffroy', 'Georges', 'Gerard', 'Germain',
    'Gervais', 'Gilbert', 'Gilles', 'Gillet', 'Girard', 'Giraud',
    'Girault', 'Godard', 'Gomes', 'Gomez', 'Gonzalez', 'Gonçalves',
    'Grandjean', 'Gras', 'Gregoire', 'Grenier', 'Gros', 'Gueguen',
    'Guerin', 'Guibert', 'Guichard', 'Guilbert', 'Guillaume', 'Guillet',
    'Guillon', 'Guillot', 'Guillou', 'Guyon', 'Guyot', 'Guéant', 'Hamel',
    'Hamon', 'Hardy', 'Hebert', 'Henry', 'Hernandez', 'Herve', 'Hubert',
    'Huet', 'Humbert', 'Imbert', 'Jacob', 'Jacques', 'Jacquet', 'Jacquot',
    'Jean', 'Joly', 'Joubert', 'Jourdan', 'Julien', 'Klein', 'Labbe',
    'Laborde', 'Lacombe', 'Lacoste', 'Lacroix', 'Lagarde', 'Laine',
    'Lambert', 'Lamy', 'Langlois', 'Laporte', 'Laroche', 'Launay',
    'Leblanc', 'Leblond', 'Lebreton', 'Lebrun', 'Leclerc', 'Leclercq',
    'Lecomte', 'Leconte', 'Lecoq', 'Leduc', 'Lefebvre', 'Lefevre',
    'Lefort', 'Legendre', 'Léger', 'Legrand', 'Legros', 'Lejeune',
    'Lelievre', 'Lelong', 'Lemaire', 'Lemaitre', 'Lemoine', 'Lemonnier',
    'Lenoir', 'Leonard', 'Leroux', 'Leroy', 'Lesage', 'Leveque', 'Levy',
    'Loiseau', 'Lombard', 'Lopes', 'Lopez', 'Louis', 'Lucas', 'Mace',
    'Mahe', 'Maillard', 'Maillet', 'Mallet', 'Marc', 'Marchal',
    'Marchand', 'Marechal', 'Marie', 'Marin', 'Marion', 'Marques',
    'Martel', 'Martin', 'Martineau', 'Martinez', 'Martins', 'Marty',
    'Mary', 'Mas', 'Masse', 'Masson', 'Mathieu', 'Maurice', 'Maurin',
    'Maury', 'Menard', 'Mercier', 'Merle', 'Merlin', 'Meunier', 'Meyer',
    'Michaud', 'Michel', 'Millet', 'Monnier', 'Moreau', 'Morel', 'Morin',
    'Morvan', 'Moulin', 'Mouton', 'Müller', 'Navarro', 'Nguyen',
    'Nicolas', 'Noel', 'Normand', 'Olivier', 'Ollivier', 'Pages',
    'Parent', 'Paris', 'Parmentier', 'Pascal', 'Pasquier', 'Paul',
    'Pelletier', 'Peltier', 'Pereira', 'Perez', 'Peron', 'Perret',
    'Perrier', 'Perrin', 'Perrot', 'Petit', 'Petitjean', 'Philippe',
    'Picard', 'Pichon', 'Picot', 'Pierre', 'Pineau', 'Poirier', 'Poisson',
    'Pons', 'Potier', 'Pottier', 'Poulain', 'Prevost', 'Prevot',
    'Prigent', 'Pruvost', 'Pujol', 'Raymond', 'Raynaud', 'Regnier',
    'Remy', 'Renard', 'Renaud', 'Renault', 'Rey', 'Reynaud', 'Ribeiro',
    'Richard', 'Riou', 'Riviere', 'Robert', 'Robin', 'Roche', 'Rodrigues',
    'Rodriguez', 'Roger', 'Rolland', 'Rossi', 'Rossignol', 'Rousseau',
    'Roussel', 'Roux', 'Roy', 'Royer', 'Ruiz', 'Salaun', 'Salmon',
    'Sanchez', 'Sauvage', 'Schmitt', 'Schneider', 'Seguin', 'Serre',
    'Simon', 'Tanguy', 'Tessier', 'Texier', 'Thibault', 'Thierry',
    'Thiery', 'Thomas', 'Torres', 'Tournier', 'Toussaint', 'Tran',
    'Vaillant', 'Valentin', 'Valette', 'Vallee', 'Vallet', 'Vasseur',
    'Verdier', 'Vial', 'Vidal', 'Villard', 'Vincent', 'Voisin', 'Wagner',
    'Weber'],

    email: ['@hotmail.fr', '@gmail.com', '@wanadoo.fr', '@yahoo.fr', '@outlook.fr'],

    sexual_orientation: ["homme", "femme", "bi"],
    
    ft_get_date: () => {
        const now = new Date();
        const start = now.getFullYear() - 30;
        const end = now.getFullYear() - 18;
        let birthDay = new Date(start + Math.floor(Math.random() * (end - start)),1 + Math.floor(Math.random() * 12), Math.floor(Math.random() * 31));
        let dd =  birthDay.getDate();
        let mm = birthDay.getMonth();
        dd = (dd < 10) ? '0'+dd : dd;
        mm = (mm < 10) ? '0'+mm : mm;
        birthDay = dd+'/'+mm+'/'+birthDay.getFullYear();
        return birthDay;       
    },

    ft_password: () => {
        let str = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN.;:/!§&(-_@)]=}~#{[";
        let result = '';
        const length = str.length;
        for (let i = 0; i < 15; i++) {
            let index = Math.floor(Math.random() * length);
            result = result + str[index];
        }
        return result;
    },

    ft_random_value: (tab) => {
        return tab[Math.floor(Math.random()*tab.length)];
    }


}

var users = {
    name: 'User table',
    
    // ajouter photo
    // birthDate en TEXT voir comment on fait pour le mettre en DATA.
    // what is INUQUE INDEX ?? ASC??
    sql_create: `CREATE TABLE users(
        id INT PRIMARY KEY AUTO_INCREMENT,
        gender VARCHAR(10),
        firstName VARCHAR(100),
        lastName VARCHAR(100),
        userName VARCHAR(100) NOT NULL,
        email VARCHAR(255) NOT NULL,
        passWord VARCHAR(255) NOT NULL,
        birthDate TEXT,
        idAddress INT,
        sexualOrientation VARCHAR(10) DEFAULT 'bi',
        valid BOOLEAN NOT NULL DEFAULT FALSE,
        notification BOOLEAN NOT NULL DEFAULT TRUE
    )`,

    sql_insert: `INSERT INTO users (
        gender, 
        firstName, 
        lastName, 
        userName, 
        passWord, 
        email, 
        birthDate, 
        idAddress, 
        sexualOrientation
    ) VALUES ?`,
    
    insert_values: () => {
        let values = [];
        for (let i = 0; i < seed; i++) {
            const firstName = fake.ft_random_value(fake.first_names).toLowerCase();
            const lastName = fake.ft_random_value(fake.last_names).toLowerCase();
            const userName = firstName[0] + lastName;
            const email = userName + fake.ft_random_value(fake.email);
            const birthDate = fake.ft_get_date();
            const idAddress = Math.floor(Math.random() * 1000);
            const passWord = fake.ft_password();
            const sexualOrientation = fake.ft_random_value(fake.sexual_orientation);


            values.push([fake.ft_random_value(fake.gender), firstName, lastName, userName, passWord, email, birthDate, idAddress, sexualOrientation]);        
        }
        return values;
    }
}

module.exports = users;