class MenuItem {
    constructor(name) {
        this.name = name;
        this.ingredients = new Map([[null, 0]]);
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

    getQuantity(ingredient) {
        return this.ingredients.get(ingredient);
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
        // Add check to ensure valid map
        this.ingredients = ingredients;
    }

    setQuantity(ingredient, quantity) {
        this.ingredients.set(ingredient, quantity);
    }

    setPrice(price) {
        this.price = price;
    }

    setRecipe(recipe) {
        this.recipe = recipe;
    }
}