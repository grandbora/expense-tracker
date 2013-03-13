define(['model/user', 'view/login'], function(User, LoginView){
  App = function(){}

  App.prototype.start = function(){



    $.cookie('authToken', {path:'/'})


    var user = new User()
    var loginView = new LoginView({
      model:user
    })

    $('body').append(loginView.render().$el)

  }

  return App
})