define(['model/transaction', 'text!template/addForm.html'], function(Transaction, AddFormTemplate){

  var TransactionList = Backbone.View.extend({

    className : 'addForm'

   ,events: {
      'click .add':'createNewTransaction'
    }

   ,createNewTransaction: function() {
      var created = this.$el.find('.date').val()
      var amount = this.$el.find('.amount').val()
      var merchant = this.$el.find('.merchant').val()

      var transaction = new Transaction({
        'created':created, 
        'amount':amount,
        'merchant':merchant
      })

      transaction.on("sync", this.updateView, this)

      transaction.save([],{
        error : this.showAddError
      })
    }

   ,updateView: function() {
      this.collection.fetch()
      this.remove()
    }

   ,showAddError: function() {
      alert('Transaction could not be added.')
    }

   ,render: function() {
      this.$el.html(AddFormTemplate)
      return this
    }

  })

  return TransactionList
})
