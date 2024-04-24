class Item {
    constructor(title, quantity, measure) {
        this.title = title;
        this.quantity = quantity;
        this.measure = measure;
    }

    // Getters
    getTitle() {
        return this.title;
    }

    getQuantity() {
        return this.quantity;
    }

    getMeasure() {
        return this.measure;
    }
    addProductForm(formIndex){
        
        this.formIndex =formIndex;
        array.forEach(formIndex => {

            document.write("<li class='list-group-item'>Ingredient<br><input type='text' id='ingredients' name='ingredients' placeholder= Spaghetti></input>")

        });
    
    }
    // Setters
    setTitle(title) {
        this.title = title;
    }

    setQuantity(quantity) {
        this.quantity = quantity;
    }

    setMeasure(measure) {
        this.measure = measure;
    }
}

module.exports = Item;