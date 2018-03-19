// custom route for fetching data
var Users = require('../data_access/users');
var Address = require('../data_access/address');

module.exports = {
    // set up route configuration that will be handle by express server
    configure: (app) => {

        // adding route for users, here app is express instance which provide use
        // get method for handling get request from http server.
        app.get('/api/users', (req, res) => {
            console.log('api/users :');
            Users.getAllUsers(res);
        });

        // here we gets id from request and passing to it transaction method.
        app.get('/api/users/:id/', (req, res) => {
            console.log('api/users/'+req.params.id+' :');
            Users.getUserById(req.params.id, res);
        });

        app.get('/api/address', (req, res) => {
            console.log('api/address :');
            Address.getAllAddress(res);
        })
    }
};