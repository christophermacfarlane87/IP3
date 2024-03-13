possibleStatus = ["pending", "ordered", "delivered", "confirmed"];

class Basket {
    //declaring variables for the basket
    constructor() {
        //this array will hold the product objects in the basket 
        this.productsInBasket = [];
        // this is an array working alongside the array of products as a struck to hold the amount
        this.amountInBasket = 0.0;
        this.itemOrderValue = 0.0;
        this.basketStatus = "pending";
    }

    // Getters
        // this function retrieves the products of the basket
    getProductsInBasket() {
        return this.productsInBasket;
    }
    // this function retrieves the amount of products ordered
    getAmountInBasket() {
        return this.amountInBasket;
    }
    // this function retrieves the cost of the amount of products in the basket
    getItemOrderValue() {
        return this.itemOrderValue;
    }
    // this function retrieves the status of the basket as a string 
    // this is the delivery status
    getBasketStatus() {
        return this.basketStatus;
    }

    // Setters
    // im not sure this function should be in basket 
    setProductId(id) {
        this.productID = id;
    }
    //this function will set the amount of products required Via a form from an add product or update product 
    setAmountInBasket(amount) {
        this.amountInBasket = amount;
    }
    //this function will set the value of products required Via a form from an add product or update product 
    setItemOrderValue(value) {
        this.itemOrderValue = value;
    }
    //this function will set the status of the basket Via a form and add the basket items to the stock   
    setBasketStatus(status) {
        this.basketStatus = status;
    }
    //calum to confirm this method
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