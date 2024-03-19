class StockCount {
    constructor() {
        this.products = [[null, 0.0, 0.0]]; // Null is of type Product, Verified amount in stock, theoretical amount in stock
    }

    addProduct(product) {
        products.push([product, 0.0, 0.0]);
    }

    removeProduct(product) {
        this.products = this.products.filter(products => products[0] !== product);
    }

    restartCount() {
        products = [];
    }

    // Getter
    getProducts() {
        return this.products;
    }

    // Setter
    setProducts(newProd) {
        this.products = newProd;
    }
}

/* // Example Usage
const stockCount = new StockCount;
stockCount.setProducts(new Product, new Product, new Product);

console.log("Products in Stock Count: ", stockCount.getProducts()); */