Facebook has depreciated its Page RSS Feed endpoint - at https://www.facebook.com/feeds/page.php and it stopped returning data from June 23, 2015. Developers must now call the Graph API's /v2.3/{page_id}/feed endpoint instead which returns JSON rather than RSS/XML.

This solution, based off the [twitter-rss-parser](https://github.com/jdelamater99/Twitter-RSS-Parser), reenables this ability.

Facebook API Setup
-------------
First, head to https://developers.facebook.com, sign in/up, and create a new app at https://developers.facebook.com/apps/

From the app, you'll need the App ID and App Secret.

PHP Setup
-------------
Rename config.php-dist to config.php. 

Next, open config.php in the text editor of your choice, and place your newly created app id/secret where appropriate, and a few lines below that, your facebook page id as a fallback incase it isn't passed in for whatever reason. Save the file and upload all the files to your webhost.

