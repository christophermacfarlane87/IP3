class Product {
    //declaring variables for the Class
    constructor(name, type, ppPack, ppKg, size, desc, holdVal, amount) {
        this.productName = name;
        this.productType = type;
        this.pricePerPack = ppPack;
        this.packSize = size;
        this.pricePerKg = ppKg;
        this.productDescription = desc;
        this.holdingValue = holdVal;
        this.parLevel = amount;
    }

    // Getters
    // retrieves Product name
    getProductName() {
        return this.productName;
    }
    
    // retrieves product type
    getProductType() {
        return this.productType;
    }

    // retrieves price per pack
    getPricePerPack() {
        return this.pricePerPack;
    }

    // retrieves the pack size
    getPackSize() {
        return this.packSize;
    }

    // retrieves price per kg
    getPricePerKg() {
        return this.pricePerKg;
    }

    // retrieves description of the product
    getProductDescription() {
        return this.productDescription;
    }

    // should this be here or in the Stock Class? Calum
    getHoldingValue() {
        return this.holdingValue;
    }

    // should this be here or in the Stock Class? Calum
    getParLevel() {
        return this.parLevel;
    }

    // Setters
    //sets the product name
    setProductName(newName) {
        this.productName = newName;
    }

    //sets the type of product
    setProductType(newType) {
        this.productType= newType;
    }

    //sets the price per pack 
    setPricePerPack(newPrice) {
        this.pricePerPack = newPrice;
    }

    //sets pack size of the product
    setPackSize(newSize) {
        this.packSize = newSize;
    }

    //sets the price per kg 
    setPricePerKg(newMass) {
        this.pricePerKg = newMass;
    }

    //sets the product description
    setProductDescription(newDes) {
        this.productDescription = newDes;
    }

    // should this be here or in the Stock Class? Calum
    setHoldingValue(newVal) {
        this.holdingValue = newVal;
    }

    // should this be here or in the Stock Class? Calum
    setParLevel(newLevel) {
        // Var is an array, possibly have setter insert into a single element
        this.parLevel = newLevel;
    }
    
    // this method recieves variables from a form on the webpage and updates a product on the database
    updateProduct(){

    }

    // this method deletes a selected product from the database 
    deleteProduct(){

    }

    // this product displays the product as a card this may need to be split into different methods for different types of display 
    displayProduct(){

    }
}

module.exports = Product;

/*// Example usage:
const apple = new Product();
apple.setProductName("Apple");
apple.setProductType("Fruit");
apple.setPricePerPack(1.25);
apple.setPackSize(5);
apple.setPricePerKg(2.5);
apple.setProductDescription("This is an Apple.");
apple.setHoldingValue(0.25);
apple.setAmountInStock([5,3,7]);

console.log("Product Name: ", apple.getProductName());
console.log("Product Type: ", apple.getProductType());
console.log("Price Per Pack: ", apple.getPricePerPack());
console.log("Pack Size: ", apple.getPackSize());
console.log("Price Per KG: ", apple.getPricePerKg());
console.log("Product Description: ", apple.getProductDescription());
console.log("Holding Value: ", apple.getHoldingValue());
console.log("Amount in Stock: ", apple.getAmountInStock()); 
*/