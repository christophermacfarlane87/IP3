const DB = require('./src/DB');
const Product = require('./src/Product');
const MenuItem = require('./src/MenuItem');
const CustOrder = require('./src/CustOrder');

const express = require('express');
const mustacheExpress = require('mustache-express');
const path = require('path');
const bodyParser = require('body-parser'); 

const app = express();

// Setting object arrays
let productsDB = new DB();
let products; // Array of Product objects

let menuDB = new DB();
let menuItems;

let custOrdersDB = new DB();
let custOrders;

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
	// Checks URL and sets productType (e.g. localhost:3000/bakery -> productType = bakery)
	const productType = req.params.productType;
	displayProductPage(productType, req, res);
});

function displayProductPage(productType, req, res) {
	const filteredProducts = products.filter(product => product.productType === productType);

	if (filteredProducts.length === 0) {
		console.error(`Error retrieving products: ${productType}`);
		res.status(500).send(`An error occurred while retrieving: ${productType}`);
	} 
	else {
		console.log(`${productType}:`, filteredProducts);
		res.render('product', { products: filteredProducts });
	}
}

// Import ingredients from a remote URL
productsDB.downloadCSV("https://raw.githubusercontent.com/christophermacfarlane87/IP3/main/examples/DBs/products.csv", Object.keys(new Product()))
	.then(() => {
		// Turn the NeDB of ingredients into instances of the product class
		productsDB.classify(Product).then(instances => {
			products = instances;
			
			// Import Menu after products have been imported
			menuDB.downloadCSV("https://raw.githubusercontent.com/christophermacfarlane87/IP3/main/examples/DBs/menu.csv", Object.keys(new MenuItem()))
				.then(() => {
					menuDB.classify(MenuItem).then(instances => {
						menuItems = instances.map((instance) => {
							instance.convertImported(products);
							return instance;
						  });
					});

					// Import Cust orders after menu has been imported
					custOrdersDB.downloadCSV("https://raw.githubusercontent.com/christophermacfarlane87/IP3/main/examples/DBs/orders.csv", Object.keys(new CustOrder()))
					.then(() => {
						custOrdersDB.classify(CustOrder).then(instances => {
							custOrders = instances.map((instance) => {
								instance.convertImported(menuItems);
								return instance;
							  });
						});
					})
					.catch((err) => {
						console.error('Error importing or finding documents:', err);
					})

				})
				.catch((err) => {
					console.error('Error importing or finding documents:', err);
				})
		});
	})
	.catch((err) => {
		console.error('Error importing or finding documents:', err);
	})

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
	console.log(`Server is running on port http://localhost:${PORT}`);
});
