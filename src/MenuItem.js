class MenuItem {
    constructor(name) {
        this.name = name;
        this.ingredients = [];
        this.quantity = [];
        this.price = 0.0;
        this.recipe = "";
    }
    
    // Getters
    getName() {
        return this.name;
    }

    getIngredients() {
        return this.ingredients;
    }

    getQuantity() {
        return this.quantity;
    }

    getPrice() {
        return this.price;
    }

    getRecipe() {
        return this.recipe;
    }

    // Setters
    setName(name) {
        this.name = name;
    }

    setIngredients(ingredients) {
        this.ingredients = ingredients;
    }

    setQuantity(quantity) {
        this.quantity = quantity;
    }

    setPrice(price) {
        this.price = price;
    }

    setRecipe(recipe) {
        this.recipe = recipe;
    }
}