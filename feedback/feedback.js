function feedback(feedbackform) {

	// collect the feedbackform data while iterating over the inputs
	var data = {};
	for (var i = 0; i < feedbackform.length; i++) {
		var input = feedbackform[i];
		if (input.name && input.value) {
			data[input.name] = input.value;
		}
	}

	// construct an HTTP request
	var xhr = new XMLHttpRequest();
	xhr.open(feedbackform.method, feedbackform.action);
	xhr.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
	// send the collected data as JSON
	xhr.send(JSON.stringify(data));

	xhr.onloadend = function () {
		if (xhr.status == 200) {
			feedbackform.send.value = "Sent!";
			feedbackform.send.disabled = true;
			feedbackform.from.disabled = true;
			feedbackform.msg.disabled = true;
			feedbackform.send.className = "success";
		} else {
			feedbackform.send.value = "Failed to send";
			feedbackform.send.className = "fail";
		}
	};

	return false;
}
