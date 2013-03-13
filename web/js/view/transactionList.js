define(['view/transaction', 'text!template/transactionList.html'], function(TransactionView, transactionListTemplate){

  var TransactionList = Backbone.View.extend({

    className : 'transactionTable'

   ,initialize: function() {
      this.collection.on("reset", this.resetView, this);
    }

   ,resetView: function() {
      _.each(this.collection.models, this.addTransaction, this)
    }

   ,addTransaction: function(transaction, index) {
      transaction.set({'index' : index})
      transactionView = new TransactionView({
        model : transaction
      });

      this.$el.find('.transactionList').append(transactionView.render().$el)
    }

   ,render: function() {
      this.$el.html(transactionListTemplate)
      return this
    }

  })

  return TransactionList
})
