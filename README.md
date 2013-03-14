[![Build Status](https://travis-ci.org/grandbora/expense-tracker.png)](https://travis-ci.org/grandbora/expense-tracker)


#Expense Tracker
====================

##TLDR  
An attempt to test [expensify](https://www.expensify.com/) api in real life.  

Below lies the blow-by-blow development history. true === interested ?  Keep on reading : [have fun](https://github.com/documentcloud/backbone/issues);  


##The story  


###ACT I - exposition

First of all, expensify api does not support jsonp. Therefore I needed a backend to proxy the api calls. This app has only one page (aka [single page app](http://en.wikipedia.org/wiki/Single-page_application)) and it does not make many api calls, it is a just hack after all. So I didn't want to use a full stack framework, I could even roll my own structure but I already did that mistake [very recently](https://github.com/grandbora/currency-converter), no thanks not this time.  

[Silex](http://silex.sensiolabs.org/) comes to rescue. Decided to use silex for its minimalistic approach, just adding buzz and twig suited all my needs.  

First sig of trouble; I really like [Heroku](http://www.heroku.com/). Well, who doesn't like a free server. Anyway I wanted to host the application on Heroku, but that turned out to be a painful experiment. Even though their documentation (almost) doesn't say anything about php, I know they support php. I even have couple of live applications running on Heroku but I have no idea how I set them up.

After a good 1-2 hours, and trying many solutions that I found on the internet, and failing on each of them, I decided to move on. Btw. the core of the problem is that I could not get Heroku to download the dependencies the application needs. A simple php script works, but telling heroku to download the dependencies via composer (similar to what it does for ruby gems) was not possible. Yes, I tried various php buildpacks for heroku and I tried committing the dependencies to the repository. None worked.  

Lets move on to amazon; until now Amazon's documentation has always managed to hide the whatever information I am looking for. just one example, I am a [half baked developer](http://cdn.memegenerator.net/images/300x/4266187.jpg) but I did many api integrations but still although I tried a lot, I am not able to extract an enpoint from an amazon api frodocumentations.   

So to get back to the story this time Amazon suprised me and it was fairly easy to setup an EC2 instance and to connect to it. It took about half an hour to install all the necessary [stuff](http://24.media.tumblr.com/tumblr_lziny3JG8X1qghjiyo1_500.png). All in all after 3-4 hours of looking around I was ready to write some code.

###ACT II - rising

Many developers who has worked with silex would know that it is for some reason obsessed with [the trailing slashes](https://www.google.com/search?q=silex+trailing+slash). I used to know that. Unlucky for me, my brain decided to put this information away and hide it under my childhood memories during one and half hours of investigation for the route not found error. To be more precise about the problem I had; I was using backbone's sync feature, which does the request to the url of the model/collection automagically. While setting the url of the backbone model, I did not think about the backend side and silex so I omitted the trailing slash. Next thing all of the ajax requests of that model was failing. It took a painful hour to recover that mistake, it was not the best moments of the development.

I think this is a good point to talk about the structure (call it architecture if you like) of the application. As said it is a client side application and it lives on one single page. All the interactions are handled vi backbone views. I did not use any routing just added and removed the few views I had, when needed. All the necessary data is fed to the view via backbone models by the backend. The backend is actually nothing more complicated than a proxy service to the expensify api. So to sum it up, application is handled by backbone views and models. Models rely on backend to get the data. Finally backend fetches all the data from expensify api and itself doesn't hold any state.

More on backend, as mentioned it runs on silex. It uses twig for templating and buzz for making requests. More on client side, mainly used libraries are backbone, underscore, query and japery UI. In addition to that client side module loading is done via require.js, for loading the templates text plugin of require.js is used. Also I used templating functionality  that is provided in underscore.js. I considered using something more advanced but later saw that the app doesn't require any advanced templating. Finally users auth token is stored on the cookie and to read it on the client side, I used a cookie plugin for jquery.

Since it is mentioned alread I would like to share a problem I had with the cookies. It is the "http only" attribute of the cookie. Silex, as the official documentation says, stands on the shoulders of the giants, which means it uses the symphony components. When you set a cookie on the header of a symfony response object, it sets the "http only" attribute to true by default. That flag as wikipedia says, prevents the cookie to be accessed from client side scripting. I used to know that too! But my brain did its thing again and I spent quite a while to prove that there is no way to access an http only cookie from javascript. After removing the flag from the cookie I was back on development.

Now it may be a good time to talk about the objects created on the backend and their relations with each other. No need mention that I followed mvc pattern. The controllers are responsible for creating the necessary models, initializing their state and calling the necessary actions on them. Afterwards they are responsible for sending the output back to the client. The models do the api calls via a common api integration object that is used by all models. All the models are inherited from an abstract model which provides the necessary functionality to interact with the api object. The models are basically responsible for validating and interpreting the api results. The ones that should return json data, have implemented the "json serializible" interface. Models have a very basic validation, and that logic is duplicated in all models. Actually this logic should live in the response class of that should be passed from api object to models. But currently api returns only StdClass objects, I did not bother to create a custom class for it. Finally the api model; it retrieves the raw json string from the api, converts it to an object then returns it to the caller. It holds only api specific logic.

Another thing to mention before closing this act is that, the models are developed in a tdd manner and it is a blessing to have a good unit test coverage.

###ACT III - resolution

After all this fun the app was serving its intended purpose. So I added travis and watch the green bar appearing on [travis](https://travis-ci.org). Then I logged in to the amazon server and pulled the latest of the repository. Currently it is located at this ip:http://54.244.236.133/ may not stay same in the future.

I would like to congratulate the readers who made it so far. If you are interested you can go on checking the other similar apps [currency converter](https://github.com/grandbora/currency-converter) and [soundlist](https://github.com/grandbora/soundlist).

