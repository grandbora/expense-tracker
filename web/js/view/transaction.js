define(['text!template/transaction.html'], function(transactionTemplate){

  var Transaction = Backbone.View.extend({

    className : 'transactionRow'

   ,render: function() {
      var template = _.template(transactionTemplate, this.model.attributes);
      this.$el.html(template)
      return this
    }
  })

  return Transaction
})