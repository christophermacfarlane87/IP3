class CustOrder {
    constructor(items, table) {
        this.items = items;
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

    convertImported(menuItems) {
        const convertedMenuItems = new Map();

        for (const [menuItemName, quantity] of Object.entries(this.items)) {
            const item = menuItems.find(menu => menu.name === menuItemName);
            if (item) {
                convertedMenuItems.set(item, quantity);
            } 
            else {
                console.warn(`Product "${menuItemName}" not found in the menu items list.`);
                convertedMenuItems.set(menuItemName, quantity);
            }
        }

        this.items = convertedMenuItems;
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

module.exports = CustOrder;