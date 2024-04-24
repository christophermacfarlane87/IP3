class User{
    
        constructor(dbFilePath) {
            // Embedded 
            if (dbFilePath) {
                this.db = new Datastore({ filename: dbFilePath, autoload: true });
            }
            // In Memory
            else {
                this.db = new Datastore();
            }
        }
    
    setUserName(username){
        this.username = username;

    }
    getUserName(){
        return this.username;
    }
    init(){

    }
}
module.exports =User;