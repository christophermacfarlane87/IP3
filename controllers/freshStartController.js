const DB = require('../src/DB');
const Product = require('../src/Product');
const MenuItem = require('../src/MenuItem');
const CustOrder = require('../src/CustOrder');

// Setting object arrays
let productsDB = new DB();
let products; // Array of Product objects

let menuDB = new DB();
let menuItems; // Array of Menu objects

let custOrdersDB = new DB();
let custOrders; // Array of Order objects

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

exports.landingPage = function (req, res) {
    res.render("index");
  };
 exports.stock = function (req, res) {
    res.render("stock");
  };

exports.sales = function (req, res) {
    res.render("sales");
  };
exports.menu = function (req, res) {
    res.render("menu");
  };
exports.show_login = function (req, res) {
    res.render("login");
  };
exports.orders = function (req, res) {
    res.render("orders");
  };

exports.productType = function (req, res){
  // Checks URL and sets productType (e.g. localhost:3000/bakery -> productType = bakery)
  const productType = req.params.productType;

  console.log(productType);
	displayProductPage(productType, req, res);
}

exports.logout = function (req, res) {
    res.render("user/login");
  };
exports.register = function (req, res) {
    res.render("user/login");
  };

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