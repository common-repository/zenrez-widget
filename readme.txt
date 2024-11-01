=== Zenrez widget ===
Contributors: denniszenrez
Tags: zenrez, fitness, studio, subscription, mindbody, mailing, mails, contact

Requires at least: 3.6.0
Tested up to: 5.3.2
Stable tag: trunk
License: GPLv2 or later

Zenrez plugin is a customizable widget which displays a form on your website.

== Description ==

Zenrez plugin helps new customers to subscribe to the mailing list.

Major features in Zenrez include:

* Automatically checks if a user is already subscribed.
* Subscribes a new user to the mailing list
* Customize text size and color.
* Customize title and description.

PS: You'll be asked to get Zenrez credentials to use it, once activated.

== Installation ==

Upload the Zenrez plugin to your blog, activate it, and then enter your Zenrez credentials.

You can either use it as a widget or shortcode. In order to insert the shortcode you just
need to add [zenrez_form].

To add it directly to your php code just add these lines:

if(function_exists('zenrez_contact_form')){
    echo zenrez_contact_form();
}

You're done!

== Changelog ==

