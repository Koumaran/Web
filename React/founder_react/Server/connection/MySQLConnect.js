var mysql = require('mysql');

function MySQLConnect() {
    this.pool = null;

    // Init MySQL Connection Pool
    this.init = () => {
        this.pool = mysql.createPool({
            host: 'localhost',
            user: 'root',
            password: '',
            database: 'FounderDB'
        });
    };

    // acquire connection and execute query on callbacks
    this.acquire = (callback) => {
        this.pool.getConnection((err, connection) => {
            callback(err, connection);
        });
    };
}

module.exports = new MySQLConnect();