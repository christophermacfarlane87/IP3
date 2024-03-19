const DB = require('./DB');
const Product = require('./Product');

const productsDB = new DB();
const products = [];

productsDB.importFromURL("https://raw.githubusercontent.com/christophermacfarlane87/IP3/calums-backend-stuff/examples/DBs/products.csv", Object.keys(new Product()))
  .then(() => {
    // Find all documents after the import is complete
    productsDB.findAll((err, table) => {
      if (err) {
        console.error('Error finding documents:', err);
      } 
      else {
        // Create a new Product instance for each document
        table.forEach(row => {
            const product = new Product(
                row.productName,
                row.productType,
                row.pricePerPack,
                row.pricePerKg,
                row.packSize,
                row.productDescription,
                row.holdingValue,
                row.amountInStock
            );
            products.push(product);
        });
      }
    });
  })
  .catch((err) => {
    console.error('Error importing or finding documents:', err);
  });