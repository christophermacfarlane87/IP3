const DB = require('../src/DB');
const Product = require('../src/Product');
const MenuItem = require('../src/MenuItem');
const CustOrder = require('../src/CustOrder');
const StockCount = require('../src/StockCount');
const Basket = require('../src/Basket');
const User = require('../src/User');
// Setting object arrays
let productsDB = new DB();
let products; // Array of Product objects
let userDB = new DB();
let user;
let menuDB = new DB();
let menuItems; // Array of Menu objects

let custOrdersDB = new DB();
let custOrders; // Array of Order objects

let stockCountDB = new DB();
let stockCount; // Array of Stock count objects

let currentBasket = new Basket();

// Import ingredients from a remote URL
productsDB.downloadCSV("https://raw.githubusercontent.com/christophermacfarlane87/IP3/main/examples/DBs/products.csv").then(() => {
	// Turn the NeDB of ingredients into instances of the product class
	productsDB.classify(Product).then(instances => {
		products = instances;
	});

	// Import Menu after products have been imported
	menuDB.downloadCSV("https://raw.githubusercontent.com/christophermacfarlane87/IP3/main/examples/DBs/menu.csv").then(() => {
		menuDB.classify(MenuItem).then(instances => {
			menuItems = instances.map((item) => {
				item.convertImported(products);
				return item;
			});
		});

		// Import Cust orders after menu has been imported
		custOrdersDB.downloadCSV("https://raw.githubusercontent.com/christophermacfarlane87/IP3/main/examples/DBs/orders.csv").then(() => {
			custOrdersDB.classify(CustOrder).then(instances => {
				custOrders = instances.map((order) => {
					order.convertImported(menuItems);
					return order;
				});
			});

			// Import latest Stock count after cust orders have been imported
			stockCountDB.downloadCSV("https://raw.githubusercontent.com/christophermacfarlane87/IP3/main/examples/DBs/stock.csv").then(() => {
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
							// Create a new stock count object using the product name in the csv to find the product object
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
    res.render('stock', { stock: stockCount });
}

exports.stock_count = function (req, res) {
    res.render('stock_count', { stock: stockCount });
}

exports.post_stock = function (req, res) {
	products.forEach((product) => {
        const productName = product.productName;
		const productAmount = parseInt(req.body[productName]);

        if (productAmount > 0) {
			console.log("Amount of", productName, "is",  productAmount)

			stockCount.forEach((count) => {
				if (count.product == product) {
					count.amountInStock = productAmount;
					count.theoreticalInStock = productAmount;
				}
			});
        }
		else {
			//console.log("No", productName, "ordered.",  req.body[productAmount])
		}
    });

	res.redirect(req.get('referer'));
}

exports.theo_stock = function (req, res) {
    res.render('theo_stock', { stock: stockCount });
}
exports.updateMenu = function (req, res) {
	const dishName= req.body.dishName;
	const productName= req.body.productName;
	const price= req.body.price;
//ive added the same function for loading the current menu but this does not add the updated items to the map yet
	const formattedMenu = menuItems.map(menu => ({
		name: menu.name,
		ingredients: Array.from(menu.ingredients).map(([key, value]) => ({ key, value })),
		price: menu.price,
		recipe: menu.recipe
	}));

	res.render('current_menu', { items: formattedMenu });
    
}
exports.tables = function (req, res) {
	let formattedSales;

    // Convert items map to array of objects
	try {
		formattedSales = custOrders.map(order => ({
			items: Array.from(order.items).map(([key, value]) => ({ key, value })),
			table: order.table
		}));
	} 
	catch (error) {
		console.log("formattedSales Error:", error);
	}
		
	res.render('tables', { sales: formattedSales });
}

exports.sales = function (req, res) {
    res.render("sales");
}

exports.my_sales = function (req, res) {
    res.render("my_sales");
}

exports.addSales = function (req, res) {
    const predictedSales = req.body.predictedSales;
	const amount = req.body.amount;
	const name = req.body.name;
	res.render("basket");
}

exports.menu = function (req, res) {
    res.render("menu");
}

exports.current_menu = function (req, res) {
	// Convert items map to array of objects
	const formattedMenu = menuItems.map(menu => ({
		name: menu.name,
		ingredients: Array.from(menu.ingredients).map(([key, value]) => ({ key, value })),
		price: menu.price,
		recipe: menu.recipe
	}));

	res.render('current_menu', { items: formattedMenu });
}

exports.customerOrder = function (req, res) {
	// Convert items map to array of objects
	const formattedMenu = menuItems.map(menu => ({
		name: menu.name,
		price: menu.price
		
	}));

	res.render('customerOrder', { items: formattedMenu });
}

exports.postCustomerOrder = function (req, res) {
	const tableNumber = req.body.tableNumber;
	const order = new Map();

    menuItems.forEach((menuItem) => {
        const itemName = menuItem.name;
		const itemAmount = parseInt(req.body[itemName]);

        if (itemAmount > 0) {
			console.log("Amount of", itemName, "is",  itemAmount)
			order.set(menuItem, itemAmount);
        }
		else {
			console.log("No", itemName, "ordered.",  req.body[itemName])
		}
    });

	custOrders.push(new CustOrder(order, tableNumber, stockCount));

	res.redirect('/');
}

exports.update_menu = function (req, res) {
	// Convert items map to array of objects
	const formattedMenu = menuItems.map(menu => ({
		name: menu.name,
		ingredients: Array.from(menu.ingredients).map(([key, value]) => ({ key, value })),
		price: menu.price,
		recipe: menu.recipe
	}));

	res.render('update_menu', { items: formattedMenu });
}

exports.new_menu = function(req,res){
	res.render("new_menu");
}

exports.show_login = function (req, res) {
    res.render("login");
}
exports.welcomeBack = function (req, res) {
    res.render("welcome");
}
exports.orders = function (req, res) {
    res.render('orders');
}

exports.basket = function (req, res) {
    const structuredProducts = [];
    for (const [product, quantity] of currentBasket.productsInBasket.entries()) {
		stockCount.forEach(count => {
			if (product !== null && quantity !== null && count.product == product) {
				structuredProducts.push({
					productName: product.productName,
					productType: product.productType,
					pricePerPack: product.pricePerPack,
					pricePerKg: product.pricePerKg,
					packSize: product.packSize,
					quantity: quantity,
					amountInStock: count.amountInStock,
					theoreticalInStock: count.theoreticalInStock
				});
			}
		});
    }

	console.log("structuredProducts", structuredProducts);
    res.render('basket', { structuredProducts: structuredProducts });
}

exports.submitBasket = function (req, res) {
    res.render('orders');
}

exports.addToBasket = function (req, res) {
	const amountToAdd = parseInt(req.body.amount_to_order);
	const productName = req.body.productName;

	products.forEach(product => {
		if(product.productName === productName) {
			currentBasket.productsInBasket.set(product, amountToAdd)
		}
	})
	
	console.log("Amount of", productName, "to add to basket:", amountToAdd);
	res.redirect(req.get('referer'));
	console.log("basket:", currentBasket);
}

exports.search = function (req, res) {
    // Retrieve the search term from the query string
    var productType = req.query.q;
    let filteredProducts;

	if ((filteredProducts = products.filter(product => product.productName.toLowerCase().includes(productType.toLowerCase()))) === 0) {
		
	}

    res.render('product', { products: filteredProducts });
}

exports.productType = function (req, res){
	// Checks URL and sets productType (e.g. localhost:3000/bakery -> productType = bakery)
	const productType = req.params.productType;
	let filteredProducts;

	if ((filteredProducts = products.filter(product => product.productType === productType)) === 0) { 
		 
	}

	res.render('product', { products: filteredProducts });
}

exports.logout = function (req, res) {
    res.render("user/login");
}

exports.register = function (req, res) {
    res.render("user/login");
}

//setTimeout(waitPrint, 1000);

function waitPrint() {
	console.log(custOrders)

	// for (const [menuItem, quantity] of custOrders[0].items.entries()) {
	// 	console.log(menuItem.ingredients);
	// }
}