define(['view/transaction'], function(TransactionView){

  var TransactionList = Backbone.View.extend({

    className : 'transactionList'

   ,initialize: function() {
      this.collection.on("reset", this.resetView, this);
    }

   ,resetView: function() {
      _.each(this.collection.models, this.addTransaction, this)
    }

   ,addTransaction: function(transaction, index) {
      transaction.set({'index' : index})
      console.log(transaction.attributes) //BDNF REMOVE
      transactionView = new TransactionView({
        model : transaction
      });

      this.$el.append(transactionView.render().$el)
    }

   ,render: function() {
      return this;
    }

  })

  return TransactionList
})
