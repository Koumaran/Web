/** 
 * Creating server using express.js
 * Connected to Mysql Database
 * http://localhost:8000/api/users
*/

var express = require('express');
var bodyParser = require('body-parser');
var crypto = require('crypto');
var routes = require('./routes/routes');

// creating server instance
var app = express();

// For posting nested object if we have set extended true
app.use(bodyParser.urlencoded({ extended: true }));
// parsing JSON
app.use(bodyParser.json());

// set application route with server instance
routes.configure(app);

// listening application on port 8000
var server = app.listen(8000, () => {
    console.log('Server Listening on port '+ server.address().port);
});