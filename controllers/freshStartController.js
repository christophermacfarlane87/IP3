
const DBDAO = require("../models/DB");
const basketDao = require("../src/Basket.js");
const CustOrderDao = require("../src/CustOrder.js");
const itemDao = require("../src/item.js");
const MenuItemDao = require("../src/MenuItem.js");
const PredictionDao = require("../src/Prediction.js");
const ProductDao = require("../src/Basket.js");
const basketDao = require("../src/StockCount.js");

const db = new DBDAO();


exports.landingPage = function (req, res) {
    res.render('index', {  });
  };
exports.stock = function (req, res) {
    res.render("user/login");
  };
exports.sales = function (req, res) {
    res.render("user/login");
  };
exports.menu = function (req, res) {
    res.render("user/login");
  };
exports.show_login = function (req, res) {
    res.render("user/login");
  };
exports.orders = function (req, res) {
    res.render("user/login");
  };
exports.freshMeat = function (req, res) {
    res.render("user/login");
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