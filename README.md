## Simple sane VANILLA PHP feedback form

Designed to be used on the **latest browsers**

* Minimal
* Can work without Javascript !
* No Jquery

## Docker

Be sure to change the FROM address to a sender address that is verified in your Amazon SES
account:

	AWS_ACCESS_KEY_ID=
	AWS_SECRET_ACCESS_KEY=
	REGION=us-west-2
	TO=
	FROM=

And save as `env.list`, then:

	docker run --rm --env-file env.list -it -p 2015:2015 hendry/feedback
