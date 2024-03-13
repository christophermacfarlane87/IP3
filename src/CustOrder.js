class CustOrder {
    //declaring variables for the basket
    constructor() {
        //this array will hold the product objects in the basket 
        this.items = [];
        this.amount =[];
        this.bill= 0.0;
        // this is an array working alongside the array of products as a struck to hold the amount
        this.table = 0.0;
        this.orderID = 0.0;
        
    }
//retrieves items in the order
getItemsInOrder() {
    return this.items;
}
//retrieves the amount of items in the order
getAmount() {
    return this.amount;
}
//retrieves the table number
getTableNumber() {
    return this.table;
}
//retrieves the order ID
getOrderID() {
    return this.orderID;
}
//retrieves the bill for the table
getBill(){
    return this.bill
}
//sets items in the order
setItemsInOrder(items) {
    return this.items= items;//does this need to be declared as an array 
}
//sets the amount of items in the order
setAmount(amount) {
    this.amount= amount;
}
//sets the table number
setTableNumber(table) {
    this.tableNumber= table;
}
//auto generates a unique order ID 
setOrderID(orderID) {
    this.orderID= orderID;
}
//Calculates the bill
bill(items,amount){
    //this code isnt right this will need a for each loop passing through the array 
    this.bill = items * amount; 
}
// this method sends the order to the kitchen and removes the required product amounts from the stock. 
placeOrder(){

}

}