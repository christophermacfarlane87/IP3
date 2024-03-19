const DB = require('./DB');

const productsDB = new DB();
productsDB.importFromURL();

// Find all documents (after the import is complete)
productsDB.findAll((err, docs) => {
    if (err) {
        console.error('Error finding documents:', err);
    } 
    else {
        console.log('All documents:', docs);
    }
});