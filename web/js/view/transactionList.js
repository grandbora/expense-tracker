define(['view/transaction', 'view/addForm', 'text!template/transactionList.html'], function(TransactionView, AddForm, transactionListTemplate){

  var TransactionList = Backbone.View.extend({

    className : 'transactionTable'

   ,events: {
      'click .button span':'showAddFrom'
    }

   ,initialize: function() {
      this.collection.on("reset", this.resetView, this)
    }

   ,showAddFrom: function() {
      var addForm = new AddForm({
        collection: this.collection
      });
      this.$el.find('.form').append(addForm.render().$el)
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
