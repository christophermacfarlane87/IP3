possibleStatus = ["pending", "ordered", "delivered", "confirmed"];

class Basket {
    constructor() {
        this.productsInBasket = [];
        this.amountInBasket = 0.0;
        this.itemOrderValue = 0.0;
        this.basketStatus = "pending";
    }

    // Getters
    getProductsInBasket() {
        return this.productsInBasket;
    }

    getAmountInBasket() {
        return this.amountInBasket;
    }

    getItemOrderValue() {
        return this.itemOrderValue;
    }

    getBasketStatus() {
        return this.basketStatus;
    }

    // Setters
    setProductId(id) {
        this.productID = id;
    }

    setAmountInBasket(amount) {
        this.amountInBasket = amount;
    }

    setItemOrderValue(value) {
        this.itemOrderValue = value;
    }

    setBasketStatus(status) {
        this.basketStatus = status;
    }

    advanceStatus() {
        // Don't run if the current basketStatus is the last stage
        if (this.basketStatus != possibleStatus[possibleStatus.length - 1]) {
            // Sets the current basket status to the next stage
            this.basketStatus = possibleStatus[possibleStatus.indexOf(this.basketStatus) + 1];
        }
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