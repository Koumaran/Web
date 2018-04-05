var connection = require('../connection/MySQLConnect');

function Users() {
    // get all Users data
    this.getAllUsers = (res) => {
        // initialize database connection
        connection.init();
        // calling acquire methods and passing callback method that will be execute query  
        // return response to server
        connection.acquire((err, con) => {
            con.query('SELECT DISTINCT * FROM users', (err, result) => {
                con.release();
                console.log(result);
                res.send(result);
            });
        });
    };

    this.getUserById = (id, res) => {
        // initialize databse connection
        connection.init();
        // get id as parameter to passing into query and return filter data
        connection.acquire((err, con) => {
            var query = 'SELECT * FROM users where id=?';
            con.query(query, id, (err, result) => {
                con.release();
                console.log(result);
                res.send(result);
            });
        });
    }

}

module.exports = new Users();
