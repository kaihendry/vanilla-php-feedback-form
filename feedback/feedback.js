function feedback(feedbackform) {

	const data = {};

	for (let input of feedbackform) {
		if (input.name && input.value) {
			data[input.name] = input.value
		}
	}

	feedbackform.send.value = "Sending...";
	feedbackform.send.disabled = true;

	fetch(feedbackform.action, { method: "POST", body: JSON.stringify(data) }).then(function(res){
		if (res.ok) {
			console.log(res);
			feedbackform.send.value = "Sent!";
			feedbackform.send.className = "success";
		} else {
			console.log("error", res);
			feedbackform.send.value = "Error, try again";
			feedbackform.send.disabled = false;
		}
	});

	return false;
}
