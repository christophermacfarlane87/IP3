class MenuItem {
    constructor(name, ingredients, price, recipe,sales) {
        //declaring variables for the menu item
        this.name = name;
        this.ingredients = ingredients;
        this.price = price;
        this.recipe = recipe;
        this.sales= sales;
    }
    
    convertImported(products) {
        const convertedIngredients = new Map();

        for (const [ingredientName, quantity] of Object.entries(this.ingredients)) {
            const product = products.find(p => p.productName === ingredientName);
            if (product) {
                convertedIngredients.set(product, quantity);
            } else {
                console.warn(`Product "${ingredientName}" not found in the products list.`);
                convertedIngredients.set(ingredientName, quantity);
            }
        }

        this.ingredients = convertedIngredients;
    }

    // Getters
    // this function retrieves the name of the menu item
    getName() {
        return this.name;
    }
  
    //this function retrieves the array of different ingredients included in the menu item 
    getIngredients() {
        return this.ingredients;
    }
  
    getQuantity(ingredient) {
        return this.ingredients.get(ingredient);
    }
  
    //this function retrieves the price of the menu item as a double  
    getPrice() {
        return this.price;
    }
  
    // this function retrieves the recipe for cooking the menu item as a string
    getRecipe() {
        return this.recipe;
    }

    // Setters
    //this function sets the name of the menu item
    setName(name) {
        this.name = name;
    }
  
    // this function sets the array of different products in the menu item 
    setIngredients(ingredients) {
        // Add check to ensure valid map
        this.ingredients = ingredients;
    }

    setQuantity(ingredient, quantity) {
        this.ingredients.set(ingredient, quantity);
    }
  
    //this function sets the price for the menu item 
    setPrice(price) {
        this.price = price;
    }
  
    //this function sets the recipe of the menu item as a string of text 
    setRecipe(recipe) {
        this.recipe = recipe;
    }
  
    //this method is used to create a new menu item this function will call setters and then upload the new menu item to the database 
    saveMenuItem(){

    }
  
    // this function handles the displaying of the menu items for cards or information 
    displayMenuItem(){

    }
  
    //this function is used to remove menu items from the database 
    deleteMenuItem(){

    }
  
    // this function is used to update a menu item on the database it will search for the menu item in the data base the change the required variable 
    updateMenuItem(){

    }
    setSales(sales){
        this.sales = sales;

    }
    getSales(){
        return this.sales;
    }
}

module.exports = MenuItem;