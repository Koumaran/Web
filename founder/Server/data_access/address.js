var connection = require('../connection/MySQLConnect');

function Address() {
    this.getAllAddress = (res) => {
        connection.init();
        connection.acquire((err, con) => {
            con.query('SELECT * FROM address', (err, result) => {
                con.release();
                console.log(result);
                res.send(result);
            });
        });
    };
}

module.exports = new Address();