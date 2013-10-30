function feedback() {

	// How can I avoid name="feedbackform" to anonymous this?

	// collect the feedbackform data while iterating over the inputs
	var data = {};
	for (var i = 0, ii = feedbackform.length; i < ii; ++i) {
		var input = feedbackform[i];
		if (input.name) {
			data[input.name] = input.value;
		}
	}

	// construct an HTTP request
	var xhr = new XMLHttpRequest();
	xhr.open(feedbackform.method, feedbackform.action, true);
	xhr.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');

	// send the collected data as JSON
	xhr.send(JSON.stringify(data));

	xhr.onloadend = function () {
		// TODO: Howto check for 200 response? https://twitter.com/Espen_Antonsen/status/394832041491308544
		// Change form to say SENT!
	};

	return false;
}
