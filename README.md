# Simple sane VANILLA PHP feedback form

DEPRECATED in favour of [AWS Lambda & API Gateway](https://www.youtube.com/watch?v=Wy7g-xPhnYQ)

Designed to be used on the **latest browsers**

* Minimal
* Can work without Javascript !
* No Jquery

# Docker

Be sure to change the FROM address to a sender address that is verified in your Amazon SES
account:

	AWS_ACCESS_KEY_ID=
	AWS_SECRET_ACCESS_KEY=
	REGION=us-west-2
	TO=
	FROM=

And save as `env.list`, then:

	docker run --rm --env-file env.list -it -p 2015:2015 hendry/feedback

# Caddy integration

	feedback.dabase.com {
		tls foo@example.com
		proxy / feedback:2015
	}

