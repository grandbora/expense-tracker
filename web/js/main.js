require.config({
  urlArgs: 'bust=' +  (new Date()).getTime()
 ,paths: {
    underscore: 'vendor/underscore-min'
   ,backbone: 'vendor/backbone-min'
   ,jquery: '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min'
   ,jqueryUI: '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min'
   ,jqueryCookie: 'vendor/jquery.cookie'
   ,text: 'vendor/text'
  },
  shim: {
    'jqueryUI': {
      deps: ['jquery']
    }
   ,'jqueryCookie': {
      deps: ['jquery']
    }
   ,'backbone': {
      deps: ['underscore', 'jquery']
    }
   ,'app': {
      deps: ['backbone', 'jqueryUI', 'jqueryCookie', 'text']
    }
  }
})

require(['app'], function(App){
  'use strict'

  var app = new App()
  
  $(function() {
    app.start()
  })
})