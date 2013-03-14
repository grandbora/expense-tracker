[![Build Status](https://travis-ci.org/grandbora/expense-tracker.png)](https://travis-ci.org/grandbora/expense-tracker)


#Expense Tracker
====================

##TLDR  
An attempt to test [expensify](https://www.expensify.com/) api in real life.  

Below lies the blow-by-blow development history. true === interested ?  Keep on reading : [have fun](https://github.com/documentcloud/backbone/issues);  


##The story  

First of all, expensify api does not support jsonp. Therefore I needed a backend to proxy the api calls. This app has only one page (aka [single page app](http://en.wikipedia.org/wiki/Single-page_application)) and it does not make many api calls, it is a just hack after all. So I didn't want to use a full stack framework, I could even roll my own structure but I already did that mistake [very recently](https://github.com/grandbora/currency-converter), no thanks not this time.  

[Silex](http://silex.sensiolabs.org/) comes to rescue. Decided to use silex for its minimalistic approach, just adding buzz and twig suited all my needs.  

First sig of trouble; I really like [Heroku](http://www.heroku.com/). Well, who doesn't like a free server. Anyway I wanted to host the application on Heroku, but that turned out to be a painful experiment. Even though their documentation (almost) doesn't say anything about php, I know they support php. I even have couple of live applications running on Heroku but I have no idea how I set them up.

After a good 1-2 hours, and trying many solutions that I found on the internet, and failing on each of them, I decided to move on. Btw. the core of the problem is that I could not get Heroku to download the dependencies the application needs. A simple php script works, but telling heroku to download the dependencies via composer (similar to what it does for ruby gems) was not possible. Yes, I tried various php buildpacks for heroku and I tried committing the dependencies to the repository. None worked.  

Lets move on to amazon; until now Amazon's documentation has always managed to hide the whatever information I am looking for. just one example, I am a [half baked developer](http://cdn.memegenerator.net/images/300x/4266187.jpg) but I did many api integrations but still although I tried a lot, I am not able to extract an enpoint from an amazon api frodocumentations. 

inform

amazon
decipher


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
