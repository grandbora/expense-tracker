define(function(){

  var User = Backbone.Model.extend({

    authenticate: function(){

      $.ajax({
        dataType: 'json'
       ,url: '/authenticate'
       ,data:{
          partnerUserID : this.get('userName')
         ,partnerUserSecret : this.get('password')
       }
      }).done(function(data, textStatus, jqXHR) {
        debugger
      });
    }  

  })

  return User
})