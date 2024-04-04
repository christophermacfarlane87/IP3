const DB = require('../src/DB');
const Product = require('../src/Product');
const MenuItem = require('../src/MenuItem');
const CustOrder = require('../src/CustOrder');
const StockCount = require('../src/StockCount');

// Setting object arrays
let productsDB = new DB();
let products; // Array of Product objects

let menuDB = new DB();
let menuItems; // Array of Menu objects

let custOrdersDB = new DB();
let custOrders; // Array of Order objects

let stockCountDB = new DB();
let stockCount; // Array of Order objects

// Import ingredients from a remote URL
productsDB.localCSV("https://raw.githubusercontent.com/christophermacfarlane87/IP3/main/examples/DBs/products.csv").then(() => {
	// Turn the NeDB of ingredients into instances of the product class
	productsDB.classify(Product).then(instances => {
		products = instances;
	});

	// Import Menu after products have been imported
	menuDB.localCSV("https://raw.githubusercontent.com/christophermacfarlane87/IP3/main/examples/DBs/menu.csv").then(() => {
		menuDB.classify(MenuItem).then(instances => {
			menuItems = instances.map((item) => {
				item.convertImported(products);
				return item;
			});
		});

		// Import Cust orders after menu has been imported
		custOrdersDB.localCSV("https://raw.githubusercontent.com/christophermacfarlane87/IP3/main/examples/DBs/orders.csv").then(() => {
			custOrdersDB.classify(CustOrder).then(instances => {
				custOrders = instances.map((order) => {
					order.convertImported(menuItems);
					return order;
				});
			});

			// Import latest Stock count after cust orders have been imported
			stockCountDB.localCSV("https://raw.githubusercontent.com/christophermacfarlane87/IP3/main/examples/DBs/stock.csv").then(() => {
				// Find the largest DB key (date) to set the most recent stock count
				let largestKey = null;

				// Gets a single row to get the keys
				stockCountDB.findOne((err, doc) => {
					Object.keys(doc).forEach(key => {
						if (key.toString().length === 8) {
							if (largestKey === null || key > largestKey) {
								// For all the keys, if it's 8 digits (e.g. 20010911) and larger that the last match
								largestKey = key;
							}
						}
					});

					// Use findQuery to get documents with the largest key (latest date)
					stockCountDB.findQuery({[largestKey]: { $exists: true }}, (err, docs) => {
						stockCount = docs.map(doc => {
							return new StockCount(products.find(p => p.productName === doc.product), doc[largestKey], doc[largestKey]);
						});
					});
				});
			}).catch((err) => { console.error('Error importing or finding stock counts:', err); })
		}).catch((err) => { console.error('Error importing or finding customer orders:', err); })
	}).catch((err) => { console.error('Error importing or finding menu items:', err); })
}).catch((err) => { console.error('Error importing or finding products:', err); })

exports.landingPage = function (req, res) {
    res.render("index");
}

 exports.stock = function (req, res) {
    res.render("stock");
}

exports.sales = function (req, res) {
    res.render("sales");
}

exports.menu = function (req, res) {
    res.render("menu");
}

exports.show_login = function (req, res) {
    res.render("login");
}

exports.orders = function (req, res) {
    res.render("orders");
}

exports.productType = function (req, res){
  // Checks URL and sets productType (e.g. localhost:3000/bakery -> productType = bakery)
  const productType = req.params.productType;

  console.log(productType);
	displayProductPage(productType, req, res);
}

exports.logout = function (req, res) {
    res.render("user/login");
}

exports.register = function (req, res) {
    res.render("user/login");
}

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

setTimeout(waitPrint, 1000);

function waitPrint() {
	console.log(stockCount)

	// for (const [menuItem, quantity] of custOrders[0].items.entries()) {
	// 	console.log(menuItem.ingredients);
	// }
}