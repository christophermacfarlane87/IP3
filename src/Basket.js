class Basket {
    constructor() {
        // Initialize the variables
        this.productID = 0;
        this.amountInBasket = 0.0;
        this.itemOrderValue = 0.0;
        this.basketStatus = "";
    }

    // Getters
    getProductId() {
        return this.productID;
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
}

// Example usage:
const myBasket = new Basket();
myBasket.setProductId(123);
myBasket.setAmountInBasket(2.5);
myBasket.setItemOrderValue(45.99);
myBasket.setBasketStatus("active");

console.log("Product ID:", myBasket.getProductId());
console.log("Amount in Basket:", myBasket.getAmountInBasket());
console.log("Item Order Value:", myBasket.getItemOrderValue());
console.log("Basket Status:", myBasket.getBasketStatus());