define(['model/user', 'model/transactionList', 'view/login', 'view/transactionListView'], function(User, TransactionList, LoginView, TransactionListView){
  App = function(){
    this.init()
  }

  App.prototype.init = function(){
    this.user = new User()
    this.loginView = new LoginView({
      model:this.user
    })

    if(undefined === $.cookie('authToken')){
      this.user.on("sync", this.switchToExpense, this)
      this.showLogin()
      return
    }

    this.showExpense()
  }

  App.prototype.showLogin = function(){
    $('body').append(this.loginView.render().$el)
  }

  App.prototype.switchToExpense = function(){
    this.loginView.remove()
    this.showExpense()
  }


  App.prototype.showExpense = function(){
    this.transactionList = new TransactionList([], {
      authToken : $.cookie('authToken')
    })

    this.transactionListView = new TransactionListView({
      collection : this.transactionList
    })

    $('body').append(this.transactionListView.render().$el)

    this.transactionList.fetch()
  }

  return App
})
