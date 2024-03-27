possibleStatus = ["pending", "ordered", "delivered", "confirmed"];

class Basket {
    //declaring variables for the basket
    constructor() {
        this.productsInBasket = new Map([[null, 0.0]]); // Null is of type product, amount of product
        this.basketTotal = 0.0;
        this.itemOrderValue = 0.0;
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
  
    getItemOrderValue() {
        return this.itemOrderValue
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
  
    setItemOrderValue(value) {
        this.itemOrderValue = value; 
    }
  
    //this function will set the status of the basket Via a form and add the basket items to the stock   
    setBasketStatus(status) {
        this.basketStatus = status;
    }
}

module.exports = Basket;

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