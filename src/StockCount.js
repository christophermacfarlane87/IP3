class StockCount {
    constructor(product, amountInStock, theoreticalInStock) {
        this.product = product;
        this.amountInStock = amountInStock;
        this.theoreticalInStock = theoreticalInStock;
    }

    // Getter
    getProduct() {
        return this.product;
    }

    getAmountInStock() {
        return this.amountInStock;
    }

    getTheoreticalInStock() {
        return this.theoreticalInStock;
    }

    // Setter
    setProduct(product) {
        this.product = product;
    }

    setAmountInStock(amount) {
        this.amountInStock = amount;
    }

    setTheoreticalInStock(amount) {
        this.theoreticalInStock = amount;
    }
}

module.exports = StockCount;

/* // Example Usage
const stockCount = new StockCount;
stockCount.setProducts(new Product, new Product, new Product);

console.log("Products in Stock Count: ", stockCount.getProducts()); */