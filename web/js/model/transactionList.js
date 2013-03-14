define(['model/transaction'], function(Transaction){

  var TransactionList = Backbone.Collection.extend({

    model: Transaction

   ,url : '/transaction/'
   
  })

  return TransactionList
})
