class StockCount {
    constructor() {
        this.products = [];
    }

    addProduct(product) {
        products.push(product);
    }

    removeProduct(product) {
        products = this.products.filter(a => a !== product);
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