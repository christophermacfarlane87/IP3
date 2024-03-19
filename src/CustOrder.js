class CustOrder {
    constructor(table) {
        this.items = new Map([[null, 0]]); // Menu item, Amount of that item
        this.table = table;
    }

    totalCost() {
        var orderTotal = 0;

        this.items.forEach (function(amount, item) {
            orderTotal += amount;
        })

        return orderTotal;
    }

    placeOrder() {
        // Stockcount.instance.orderPlaced(this.CustOrder);
        // Or something like that
    }

    // Getters
    getItems() {
        return this.items;
    }

    getAmount(item) {
        return this.items.get(item); 
    }

    getTable() {
        return this.table;
    }

    // Setters
    setItems(items) {
        this.items = items;
    }

    setAmount(item, amount) {
        this.items.set(item, amount); 
    }

    setTable(table) {
        this.table = table;
    }
}