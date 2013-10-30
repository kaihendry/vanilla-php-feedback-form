function feedback(feedbackform) {

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

	xhr.onloadend = function () { // TODO: How to check XHR is actually successful?
		if (xhr.status == 200) {
		feedbackform.innerHTML = "<h1 style='background-color: green; padding: 1em; border-radius: 5px; color: white;'>Sent!</h1>";
		} else {
		feedbackform.innerHTML = "<h1 style='background-color: red; padding: 1em; border-radius: 5px; color: white;'>Failed to send</h1>";
		}
	};

	return false;
}
