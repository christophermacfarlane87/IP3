const DB = require('./DB');
const Product = require('./Product');

const productsDB = new DB();
let products;

productsDB.importFromURL("https://raw.githubusercontent.com/christophermacfarlane87/IP3/calums-backend-stuff/examples/DBs/products.csv", Object.keys(new Product()))
	.then(() => {
		productsDB.classify(Product).then(instances => {
			products = instances;
			console.log(products);
		});
	})
	.catch((err) => {
		console.error('Error importing or finding documents:', err);
	})