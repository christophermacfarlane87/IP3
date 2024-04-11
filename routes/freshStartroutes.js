const express = require('express');
const router = express.Router();
const controller = require('../controllers/freshStartController');
//const {login} = require('../auth/auth')
//const {verify} = require('../auth/auth')

router.get('/', controller.landingPage);
router.get('/stock', controller.stock);
router.get('/sales', controller.sales);
router.get('/menu', controller.menu);
router.get('/login', controller.show_login);
router.get('/orders', controller.orders);
router.get('/search', controller.search);
router.get('/:productType', controller.productType);

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