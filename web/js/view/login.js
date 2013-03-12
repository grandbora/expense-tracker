define(['text!template/login.html'], function(template){

  var Login = Backbone.View.extend({

    events: {
      'click .login' : 'login',
    }

   ,login: function() {
      this.model.set({
        userName : this.$el.find('.username').val()
       ,password : this.$el.find('.password').val()
      })

      this.model.authenticate()
    }

   ,render: function() {
      this.$el.html(template);
      return this;
    }

  })

  return Login
})