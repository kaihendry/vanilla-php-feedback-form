function feedback(feedbackform) {

	const formData = new FormData();

	for (let input of feedbackform) {
		if (input.name && input.value) {
			formData.append(input.name, input.value);
		}
	}

	feedbackform.send.value = "Sending...";
	feedbackform.send.disabled = true;

	fetch(feedbackform.action, { method: "POST", body: formData }).then(function(res){
		if (res.ok) {
			console.log(res);
			feedbackform.send.value = "Sent!";
		} else {
			console.log("error", res);
			feedbackform.send.value = "Error, try again";
			feedbackform.send.disabled = false;
		}
	});

	return false;
}
