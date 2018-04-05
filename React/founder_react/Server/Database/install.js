var mysql = require('mysql');

var usersTable = require('./User_table');
var addressTable = require('./Adresse_table');
var tables = [addressTable, usersTable];

var dataBaseName = 'FounderDB';

// id of connection to mysql DB
var connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
});

function errorHandle(err) {
    console.log(err);
    process.exit();
}


function create_users() {
    let sql = usersTable.sql_create;
    connection.query(sql, (err, users) => {
        if (err) errorHandle('ERROR: Create '+usersTable.name+' => '+ err.code);
        console.log(usersTable.name+' created');
        let sql = usersTable.sql_insert;
        let values = usersTable.insert_values();
        connection.query(sql, [values], (err, result) => {
            if (err) errorHandle('ERROR: Insert '+usersTable.name+' => '+ err.code);
            errorHandle('Work done.');
        });
    });
}

function create_address(limite) {
    if (limite === 0) {
        let sql = addressTable.sql_create;
        connection.query(sql, (err, users) => {
            if (err) errorHandle('ERROR: Create '+addressTable.name+' => '+ err.code);
            console.log(addressTable.name+' created');
            let sql = addressTable.sql_insert;
            let values = addressTable.insert_values(limite);
            connection.query(sql, [values], (err, result) => {
                if (err) errorHandle('ERROR: Insert '+addressTable.name+' => '+ err.code);
                create_address(limite + 1000);
            });
        });
    } else {
        let sql = addressTable.sql_insert;
        let values = addressTable.insert_values(limite);
        if (values) {
            connection.query(sql, [values], (err, result) => {
                if (err) errorHandle('ERROR: Insert '+addressTable.name+' => '+ err.code);
                if (limite < 1000)
                    create_address(limite + 1000);
                else 
                    create_users();
            });
        } else {
            create_users();
        }
    }
}

function create_dataBase() {
    connection.query("CREATE DATABASE " + dataBaseName, function (err, result) {
        if (err) errorHandle('Error: Can\' t create DataBase');
        console.log('FounderDB created.');
        connection.query("USE " + dataBaseName, (err) => {
            if (err) errorHandle('Error: USE '+ dataBaseName+' failed.');
            create_address(0);
        });
    });        
}

connection.connect((err) => {
    if (err) errorHandle('Error: Connection failed!');
    console.log('Conected to mysql');
    connection.query("USE " + dataBaseName, (error, result) => {
        if (error) {
            create_dataBase();
        } else {
            connection.query('DROP DATABASE FounderDB', (err, result) => {
                if (err) ErrorHandle('ERROR: Can\' t drop database');
                console.log('DataBase Dropped');
                create_dataBase();
            });
        }
    });
});
