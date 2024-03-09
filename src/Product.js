class Product {
    constructor(name, type, ppPack, ppKg, size, desc, holdVal, amount) {
        this.productName = name;
        this.productType = type;
        this.pricePerPack = ppPack;
        this.packSize = size;
        this.pricePerKg = ppKg;
        this.productDescription = desc;
        this.holdingValue = holdVal;
        this.amountInStock = amount;
    }

    // Getters
    getProductName() {
        return this.productName;
    }

    getProductType() {
        return this.productType;
    }

    getPricePerPack() {
        return this.pricePerPack;
    }

    getPackSize() {
        return this.packSize;
    }

    getPricePerKg() {
        return this.pricePerKg;
    }

    getProductDescription() {
        return this.productDescription;
    }

    getHoldingValue() {
        return this.holdingValue;
    }

    getAmountInStock() {
        return this.amountInStock;
    }

    // Setters
    setProductName(newName) {
        this.productName = newName;
    }

    setProductType(newType) {
        this.productType= newType;
    }

    setPricePerPack(newPrice) {
        this.pricePerPack = newPrice;
    }

    setPackSize(newSize) {
        this.packSize = newSize;
    }

    setPricePerKg(newMass) {
        this.pricePerKg = newMass;
    }

    setProductDescription(newDes) {
        this.productDescription = newDes;
    }

    setHoldingValue(newVal) {
        this.holdingValue = newVal;
    }

    setAmountInStock(newStock) {
        // Var is an array, possibly have setter insert into a single element
        this.amountInStock = newStock;
    }
}

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