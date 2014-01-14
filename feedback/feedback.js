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

	xhr.onloadend = function () {
		if (xhr.status == 200) {
			feedbackform.send.value = "Sent!";
			feedbackform.send.disabled = true;
			feedbackform.from.disabled = true;
			feedbackform.msg.disabled = true;
			feedbackform.send.style.backgroundColor = "green";
			feedbackform.send.style.color = "white";
		} else {
			feedbackform.send.value = "Failed to send";
			feedbackform.send.style.backgroundColor = "red";
			feedbackform.send.style.color = "white";
		}
	};

	return false;
}
