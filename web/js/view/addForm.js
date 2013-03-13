define(['model/transaction', 'text!template/addForm.html'], function(Transaction, AddFormTemplate){

  var TransactionList = Backbone.View.extend({

    className : 'addForm'

   ,events: {
      'click .add':'createNewTransaction'
    }

   ,createNewTransaction: function() {
      var date = this.$el.find('.date').val()
      var merchant = this.$el.find('.merchant').val()
      var amount = this.$el.find('.amount').val()

      var transaction = new Transaction({'date':date, 'merchant':merchant, 'amount':amount})

      transaction.save([],{
        success : this.updateView,
        error : this.showAddError
      })
    }

   ,updateView: function() {
      console.log(this)
      //remove
      //reset collection
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
