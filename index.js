const express = require('express');
const mustacheExpress = require('mustache-express');
const path = require('path');

const app = express();

// Configuration for Mustache templates
app.engine('mustache', mustacheExpress());
app.set('view engine', 'mustache');
app.set('views', path.join(__dirname, 'public', 'views'));

// Serving static files
app.use(express.static(path.join(__dirname, 'public')));

// Routing
app.get('/', (req, res) => {
  res.render('index', {  }); 
});
app.get('/freshMeat', (req, res) => {
  res.render('freshMeat', {  }); 
});
app.get('/fish', (req, res) => {
  res.render('fish', {  }); 
});
app.get('/frozen', (req, res) => {
  res.render('frozen', {  }); 
});
app.get('/dairy', (req, res) => {
  res.render('dairy', {  }); 
});
app.get('/fruit', (req, res) => {
  res.render('fruitVeg', {  }); 
});
app.get('/veg', (req, res) => {
  res.render('fruitVeg', {  }); 
});
app.get('/drystore', (req, res) => {
  res.render('drystore', {  }); 
});
app.get('/desserts', (req, res) => {
  res.render('desserts', {  }); 
});
app.get('/bakery', (req, res) => {
  res.render('bakery', {  }); 
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

// Endpoint to provide navigation data
app.get('/navigation-data', (req, res) => {
  const navigationData = {
    title: "Your Navigation Title",
    links: [
      { url: "/page1", label: "Page 1" },
      { url: "/page2", label: "Page 2" },
    ]
  };


  res.json(navigationData);
});

// Start the server
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
