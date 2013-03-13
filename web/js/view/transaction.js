define(['text!template/transaction.html'], function(template){

  var Transaction = Backbone.View.extend({
    template: _.template(template),
    
    render: function() {
      debugger
      var template = _.template(template)
      this.$el.html(template(this.model.attributes))
      return this
    }

  })

  return Transaction
})