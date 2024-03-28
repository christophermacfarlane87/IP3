const express = require('express');
const router = express.Router();
const controller = require('../controllers/freshStartControllers.js');
//const {login} = require('../auth/auth')
//const {verify} = require('../auth/auth')

router.get('/stock', controller.stock);
router.get('/sales', controller.sales);
router.get('/menu', controller.menu);
router.get('/login', controller.show_login);
router.get('/orders', controller.orders);
router.get('/freshMeat', controller.freshMeat);
router.get('/fish', controller.fish);
router.get('/frozen', controller.frozen);
router.get('/dairy', controller.dairy);
router.get('/fruitVeg', controller.fruitVeg);
router.get('/dryStore', controller.dryStore);
router.get('/desserts', controller.desserts);
router.get('/bakery', controller.bakery);
router.get('/logout', controller.logout);
router.get('/register', controller.register);

router.use(function(req, res) {
    res.status(404);
    res.type('text/plain');
    res.send('404 Not found.');
});
router.use(function(err, req, res, next) {
    res.status(500);
    res.type('text/plain');
    res.send('Internal Server Error.');
});
module.exports = router;