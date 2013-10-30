## Simple sane VANILLA PHP feedback form

Designed to be used on the **latest browsers**

* Minimal
* No legacy support (Microsoft IE)
* No Jquery

### How to setup a Postfix MTA for a feedback form

You `/etc/postfix/main.cf` should look like:

	inet_protocols = ipv4
	alias_maps = hash:/etc/postfix/aliases
	alias_database = hash:/etc/postfix/aliases
	mynetworks = 127.0.0.0/8
	smtpd_recipient_restrictions = permit_mynetworks, reject_unauth_destination

You might want to setup `myhostname = to.your.fqdn`, since [postfix seems unable to get use gethostname()](http://bugs.debian.org/cgi-bin/bugreport.cgi?bug=214741).

Now make sure mail gets set to you@example.com:

	$ grep ^root /etc/postfix/aliases
	root:           you@example.com

Now lets start this bloatware up!

	# newaliases
	# systemctl enable postfix
	# systemctl start postfix

Do a test, like so: `echo testing 123 | mail -s Testing root`

### Including the feedback form

Via PHP: include("form.html");

Or via a [Makefile](http://dabase.com/blog/Makefile_based_static_site_generator/) `m4 -PEIinc`: `m4_include(form.html)`

The feedback form should fit nicely inside the containing parent. [Bootstrap feedback form demo](http://feedback.dabase.com/eg/)
