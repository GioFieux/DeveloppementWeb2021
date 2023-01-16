class User {
    constructor(email, pwd) {
        this.email=email;
        this.pwd=pwd;
    }
    
    get register() {
      return this.email;
    }
}
  
let newUser = new User();
console.log( "Connected as " + newUser.register() );