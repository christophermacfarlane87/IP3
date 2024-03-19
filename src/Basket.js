possibleStatus = ["pending", "ordered", "delivered", "confirmed"];

class Basket {
    constructor() {
        this.productsInBasket = [null];
        this.basketTotal = 0.0;
        this.basketStatus = "pending";
    }

    addProductToBasket(product) {
        // Should add check to see if requested product is valid
        this.productsInBasket = this.productsInBasket.push(product);
    }
    
    removeProductFromBasket(product) {
        // Should add check to see if requested product is valid
        this.productsInBasket.splice(this.productsInBasket.indexOf(product), 1);
    }

    displayBasket() {
        return `Basket Total: ${this.basketTotal}\nBasket Status: ${this.basketStatus}\nProducts in Basket:\n${this.productsInBasket}\n\n`
    }

    advanceStatus() {
        // Don't run if the current basketStatus is the last stage
        if (this.basketStatus != possibleStatus[possibleStatus.length - 1]) {
            // Sets the current basket status to the next stage
            this.basketStatus = possibleStatus[possibleStatus.indexOf(this.basketStatus) + 1];
        }
    }

    // Getters
    getProductsInBasket() {
        return this.productsInBasket;
    }

    getBasketTotal() {
        return this.basketTotal;
    }

    getBasketStatus() {
        return this.basketStatus;
    }

    // Setters
    setProductsInBasket(products) {
        this.productsInBasket = products;
    }

    setBasketTotal(amount) {
        this.basketTotal = amount;
    }

    setBasketStatus(status) {
        this.basketStatus = status;
    }
}

/* // Example usage:
const myBasket = new Basket();
myBasket.setProductId(123);
myBasket.setAmountInBasket(2.5);
myBasket.setItemOrderValue(45.99);
myBasket.setBasketStatus("active");

console.log("Product ID:", myBasket.getProductId());
console.log("Amount in Basket:", myBasket.getAmountInBasket());
console.log("Item Order Value:", myBasket.getItemOrderValue());
console.log("Basket Status:", myBasket.getBasketStatus()); */