[![Build Status](https://travis-ci.org/grandbora/expense-tracker.png)](https://travis-ci.org/grandbora/expense-tracker)


#Expense Tracker
====================

##TLDR  
An attempt to test [expensify](https://www.expensify.com/) api in real life.  

Below lies the blow-by-blow development history. true === interested ?  Keep on reading : [have fun](https://github.com/documentcloud/backbone/issues);  


##The story  

First of all, expensify api does not support jsonp. Therefore I needed a backend to proxy the api calls. This app has only one page (aka [single page app](http://en.wikipedia.org/wiki/Single-page_application)) and it does not make many api calls, it is a just hack after all. So I didn't want to use a full stack framework, I could even roll my own structure but I already did that mistake [very recently](https://github.com/grandbora/currency-converter), no thanks not this time.  

[Silex](http://silex.sensiolabs.org/) comes to rescue. Decided to use silex for its minimalistic approach, just adding buzz and twig suited all my needs.  

First sig of trouble; I really like [Heroku](http://www.heroku.com/). Well, who doesn't like a free server. Anyway I wanted to host the application on Heroku, but that turned out to be a painful experiment. Even though their documentation (almost) doesn't say anything about php, I know they support php. I even have couple of live applications running on Heroku.


decided to go with silex, minimalistic approach needs  
amazon/ Heroku troubles  
--vendors committed  


finally amazon ec2 ubuntu  http://54.244.236.133/  


backbone, user sync

backend user api model

js models created even if not used

common before handlers

usage of models

issuccess should go to own class

hardcoded partner name etc

calling remove individually

testing 
templating


get token from query


client side validations


check docblock,
semi colons
etc.

duplicate transaction and list


update transaction table

loader

implementation completed



add travis

amazon upload

add other links too
