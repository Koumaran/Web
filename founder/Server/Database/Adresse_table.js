var jsonFile = require('./adresse_paris.json');

var paris = {
    get_address: (start) => {
        let values = [];
        let i = start;
        jsonFile.forEach((element) => {
            if (i < start + 1000) {
                const coordonner = element.fields.geom_x_y;
                let zipcode = element.fields.c_ar;
                if (zipcode) zipcode = parseInt(zipcode) + 75000;
                let ligne = [
                    element.fields.l_adr,
                    element.fields.l_nvoie,
                    zipcode,
                    "paris",
                    coordonner[0],
                    coordonner[1]
                ];
                values.push(ligne);
            }
            i++;
        });
        return values;
    }
}

var address = {
    name: 'Address Table',

    sql_create: `CREATE TABLE address (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name TEXT NOT NULL,
        number INT,
        zipcode INT,
        city VARCHAR(255),
        latitude DECIMAL(10, 8) NOT NULL,
        longitude DECIMAL(11, 8) NOT NULL
    )`,

    sql_insert: 'INSERT INTO address (name, number, zipcode, city, latitude, longitude) VALUES ?',

    insert_values: (start) => {
        return paris.get_address(start);
    }
}

module.exports = address;