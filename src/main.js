const DB = require('./DB');
const Product = require('./Product');
const MenuItem = require('./MenuItem');
const CustOrder = require('./CustOrder');

let productsDB = new DB();
let products;

let menuDB = new DB();
let menuItems;

let custOrdersDB = new DB();
let custOrders;

// Import ingredients from a remote URL
productsDB.downloadCSV("https://raw.githubusercontent.com/christophermacfarlane87/IP3/calums-backend-stuff/examples/DBs/products.csv", Object.keys(new Product()))
	.then(() => {
		// Turn the NeDB of ingredients into instances of the product class
		productsDB.classify(Product).then(instances => {
			products = instances;
			
			// Import Menu after products have been imported
			menuDB.downloadCSV("https://raw.githubusercontent.com/christophermacfarlane87/IP3/calums-backend-stuff/examples/DBs/menu.csv", Object.keys(new MenuItem()))
				.then(() => {
					menuDB.classify(MenuItem).then(instances => {
						menuItems = instances.map((instance) => {
							instance.convertImported(products);
							return instance;
						  });
					});

					// Import Cust orders after menu has been imported
					custOrdersDB.downloadCSV("https://raw.githubusercontent.com/christophermacfarlane87/IP3/calums-backend-stuff/examples/DBs/orders.csv", Object.keys(new CustOrder()))
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


setTimeout(codingCourse, 1000);

function codingCourse() {
	console.log(custOrders)

	for (const [menuItem, quantity] of custOrders[0].items.entries()) {
		console.log(menuItem.ingredients);
	}
}