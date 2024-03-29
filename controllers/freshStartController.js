
/*const DBDAO = require("../models/DB");
const basketDao = require("../src/Basket.js");
const CustOrderDao = require("../src/CustOrder.js");
const itemDao = require("../src/item.js");
const MenuItemDao = require("../src/MenuItem.js");
const PredictionDao = require("../src/Prediction.js");
const ProductDao = require("../src/Basket.js");
const basketDao = require("../src/StockCount.js");

const db = new DBDAO();
*/

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
exports.order = function (req, res) {
    res.render("order");
  };
exports.productType = function (req, res){
    // Checks URL and sets productType (e.g. localhost:3000/bakery -> productType = bakery)
	const productType = req.params.productType;
	displayProductPage(productType, req, res);
  }
exports.freshMeat = function (req, res) {
    res.render("");
  };
exports.fish = function (req, res) {
    res.render("user/login");
  };
exports.frozen = function (req, res) {
    res.render("user/login");
  };
exports.dairy = function (req, res) {
    res.render("user/login");
  };
exports.fruitVeg = function (req, res) {
    res.render("user/login");
  };
exports.dryStore = function (req, res) {
    res.render("user/login");
  };
exports.desserts = function (req, res) {
    res.render("user/login");
  };
exports.bakery = function (req, res) {
    res.render("user/login");
  };
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