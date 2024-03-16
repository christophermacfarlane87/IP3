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

// Routing 
app.get('/Login', (req, res) => {
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