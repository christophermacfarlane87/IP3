const express = require('express');
const app = express();

const path = require('path');
const public = path.join(__dirname,'public');
app.set('views', path.join(__dirname, 'public', 'views'));
app.use(express.static(public));

app.use('/css', express.static(__dirname +'/css/styles.css'));

const mustacheExpress = require('mustache-express');
app.engine('mustache', mustacheExpress());
app.set('view engine', 'mustache');

const router = require('./routes/freshStartroutes');
app.use('/', router);

const bodyParser = require('body-parser'); 
app.use(bodyParser.urlencoded({ extended: true }));


const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
	console.log(`Server is running on port http://localhost:${PORT}`);
});