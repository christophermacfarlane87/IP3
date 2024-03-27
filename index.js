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


app.get('/bakery', (req, res) => {

  db.find({ product_type: 'bakery' }, (err, products) => {
    if (err) {
      console.error('Error retrieving products:', err);
      res.status(500).send('An error occurred while retrieving products.');
    } else {
      console.log('Products:', products); 

      res.render('product', { products: products }); 
    }
  });
});

app.get('/drystore', (req, res) => {

  db.find({ product_type: 'drystore' }, (err, products) => {
    if (err) {
      console.error('Error retrieving products:', err);
      res.status(500).send('An error occurred while retrieving products.');
    } else {
      console.log('Products:', products); 

      res.render('product', { products: products }); 
    }
  });
});

app.get('/fruitVeg', (req, res) => {

  db.find({ product_type: 'fruitVeg' }, (err, products) => {
    if (err) {
      console.error('Error retrieving products:', err);
      res.status(500).send('An error occurred while retrieving products.');
    } else {
      console.log('Products:', products); 

      res.render('product', { products: products }); 
    }
  });
});
app.get('/desserts', (req, res) => {

  db.find({ product_type: 'desserts' }, (err, products) => {
    if (err) {
      console.error('Error retrieving products:', err);
      res.status(500).send('An error occurred while retrieving products.');
    } else {
      console.log('Products:', products); 

      res.render('product', { products: products }); 
    }
  });
});
app.get('/dairy', (req, res) => {

  db.find({ product_type: 'dairy' }, (err, products) => {
    if (err) {
      console.error('Error retrieving products:', err);
      res.status(500).send('An error occurred while retrieving products.');
    } else {
      console.log('Products:', products); 

      res.render('product', { products: products }); 
    }
  });
});
app.get('/frozen', (req, res) => {

  db.find({ product_type: 'frozen' }, (err, products) => {
    if (err) {
      console.error('Error retrieving products:', err);
      res.status(500).send('An error occurred while retrieving products.');
    } else {
      console.log('Products:', products); 

      res.render('product', { products: products }); 
    }
  });
});

app.get('/fish', (req, res) => {

  db.find({ product_type: 'fish' }, (err, products) => {
    if (err) {
      console.error('Error retrieving products:', err);
      res.status(500).send('An error occurred while retrieving products.');
    } else {
      console.log('Products:', products); 

      res.render('product', { products: products }); 
    }
  });
});

app.get('/freshMeat', (req, res) => {

  db.find({ product_type: 'freshMeat' }, (err, products) => {
    if (err) {
      console.error('Error retrieving products:', err);
      res.status(500).send('An error occurred while retrieving products.');
    } else {
      console.log('Products:', products); 

      res.render('product', { products: products }); 
    }
  });
});
app.route('/product')
  .get((req, res) => {
    res.render('product', { pageTitle: 'product' }); 
  })
  .post((req, res) => {

    const product_name = req.body.product_name;
    const product_type = req.body.product_type;
    const price_per_pack = req.body.price_per_pack;
    const price_per_kg = req.body.price_per_kg;
    const product_description = req.body.product_description;
    const supplier = req.body.supplier;


    const newProduct = {
      product_name: product_name,
      product_type: product_type,
      price_per_pack: price_per_pack,
      price_per_kg: price_per_kg,
      product_description: product_description,
      supplier: supplier,
    };


    db.insert(newProduct, (err, insertedProduct) => {
      if (err) {
        console.error('Error adding product:', err);
        res.status(500).send('An error occurred while adding the product.');
      } else {
        console.log('New product added:', insertedProduct);
      
        res.render('product', { pageTitle: 'product', product: insertedProduct });
      }
    });
  });

// // INSERT
// db.insert({ name: 'Fish1', price: '22' }, function(err, newDoc) {
//   if (err) {
//       console.log('Error inserting data:', err);
//   } else {
//       console.log('Data successfully inserted:', newDoc);
//   }
// // });

// VIEW
app.post("/view", function (req, res) {
  db.find({ name: req.body.productName }, function (err, docs) {
      if (err) {
          console.log("Error:", err);
      } else {
          console.log("Retrieved documents:", docs);
          res.render('product', {
              'product': docs
          }); 
      }
  });
});

// Show all
app.post("/showall", function (req, res) {
  db.find({}, function (err, docs) {
    if (err) {
      console.log("error");
    } else {
      console.log("documents retrieved: ", docs);

      res.render("product", {
        products: docs, 
      });
    }
  });
});

// UPDATE
db.update({ name: '' }, { $set: { price: ''  } }, {}, function (err, numAffected, affectedDocuments, upsert) {
  if (err) {
      console.error('Error updating data:', err);
  } else {
      console.log('Number of documents updated:', numAffected);
  }
});

// DELETE
db.remove({ name: '' }, { multi: true }, function (err, numRemoved) {
  if (err) {
      console.error('Error deleting data:', err);
  } else {
      console.log('Number of documents removed:', numRemoved);
  }
});


app.post("/product", function (req, res) {
  const product_name = req.body.productName;
  const product_type = req.body.product_type;
  const price_per_kg = req.body.price_per_kg;
  const product_description = req.body.product_description;
  const pack_size = req.body.pack_size;
  const price_per_pack = req.body.price_per_pack;
  const supplier = req.body.supplier;

  const newProduct = {
    product_name: product_name,
    product_type: product_type,
    pack_size: pack_size,
    price_per_pack: price_per_pack,
    price_per_kg: price_per_kg,
    product_description: product_description,
    supplier: supplier,
  };

  db.insert(newProduct, (err, insertedProduct) => {
    if (err) {
      console.error('Error adding product:', err);
      res.status(500).send('An error occurred while adding the product.');
    } else {
      console.log('New product added:', insertedProduct);
      res.render('product', { pageTitle: 'product', product: insertedProduct });
    }
  });
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
