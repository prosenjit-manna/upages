=== wp-stattraq ===
Contributors: tmcookies, strings28
Tags: statistics, administration
Requires at least: 2.6
Tested up to: 2.8.3
Stable tag: 1.3

A powerful statistics plugin that that keeps the data on your server - not on Google's.

== Description ==

This plugin will allow you to keep track of every hit on your public Wordpress site (note that it does not track admin activity).

The following views are available:

* Summary View - an overview of blog activity
* Hit Counter - a drill-down report of hits for various periods of time
* User Counter - Track the number of individual computers who came to the site
* Page Views - track the number of total views your WordPress installation served
* Browser - Find out what browsers visited your site
* Referrer - What other sites brought traffic to your own site
* Search Terms - What search terms did search engined link to your site
* SE Saturation - what percent of pages on your site have been crawled by the GoogleBot or the BingBot
* IP addresses - What individual IP addresses requested data from your site

More information might be found under 

http://www.randypeterman.com/StatTraq/

== Installation ==

To install first copy the files in the appropiate directory. It should look somewhat like this:

/wp-content/
    plugins/
	wp-stattraq/
	    <files>
	stattraq.php

Then after activating the plugin in the wordpress administration panel, point your browser to 

/wp-content/plugins/wp-stattraq/stattraq-install.php

and follow the instructions to create or update the stattraq-tables. To view your statistics go to the admin panel and select "Stat Traq".

== Frequently Asked Questions ==

 = Q. Where's my data? =
A. Until someone who is not signed into the administrative panel (wp-admin) hits 
   your WordPress installation StatTraq cannot help you see statistics.

= Q. My ISP says my database is getting HUGE.  What can I do? =
A. (WARNING!!! THIS IS PERMANENT!!! use SQL commands at your own risk!!!!)
   Open up a session with your MySQL server [we recommend phpMyAdmin] and type 
   in a query such as 
	DELETE FROM %wp-prefix%_stattraq WHERE access_time < '2009-01-01 00:00:00';

= Q. Will you be giving me a way in the options section of the interface to delete older records? =
A. Probably.  We'll also be giving you a high five if we meet you at a WordCamp.

== Screenshots ==

1. Summary view of stattraq. To the left is the navigation, to the right is a summary of users/hits over the day and in the middle there is a view of the most viewed posts this day.

2. Hits over the day.

== Changelog ==

New Features in 1.3: 
* Added a widget to the admin homepage which displays the traffic bar chart 
  and when its clicked on takes you to the StatTraq summary view.

Fixes in 1.3:

* Fixed feeds to track correctly
* Fixed URLs to work on installations that are not in the root directory for your domain
* Fixed various sorting issues in the different views
* Moved the external IP address information into the ip_address view