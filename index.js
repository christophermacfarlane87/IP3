const express = require('express');
const mustacheExpress = require('mustache-express');
const path = require('path');
const bodyParser = require('body-parser'); 
const nedb = require('nedb'); 

const db = new nedb({ filename: 'products.db', autoload: true });

const app = express();

// Configuration for Mustache templates
app.engine('mustache', mustacheExpress());
app.set('view engine', 'mustache');
app.set('views', path.join(__dirname, 'public', 'views'));

// Serving static files
app.use(express.static(path.join(__dirname, 'public')));


app.use(bodyParser.urlencoded({ extended: true }));

// Routing
app.get('/', (req, res) => {
	res.render('index', {  }); 
});

app.get('/stock', (req, res) => {
	res.render('stock', {  }); 
});
app.get('/sales', (req, res) => {
	res.render('sales', {  }); 
});
app.get('/order', (req, res) => {
	res.render('orders', {  }); 
});
app.get('/menu', (req, res) => {
	res.render('menu', {  }); 
});
app.get('/login', (req, res) => {
	res.render('Login', { pageTitle: 'Staff Login Page' }); 
});


app.get('/:productType', (req, res) => {
	const productType = req.params.productType;
	displayProductPage(productType, req, res);
});

function displayProductPage(productType, req, res) {
    db.find({ product_type: productType }, (err, products) => {
        if (err) {
			console.error('Error retrieving products:', err);
            res.status(500).send('An error occurred while retrieving products.');
        } 
        else {
            console.log(`${productType}:`, products); 
            res.render('product', { products: products }); 
        }
    });
}

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
	console.log(`Server is running on port http://localhost:${PORT}`);
});
