define(['model/transaction'], function(Transaction){

  var TransactionList = Backbone.Collection.extend({

    model: Transaction

   ,url : function(){
      return '/transaction/?authToken=' + this.authToken
    }

    ,initialize: function(models, options) {
      this.authToken = options.authToken
    }

  })

  return TransactionList
})
