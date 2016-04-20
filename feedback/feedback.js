function feedback(feedbackform) {

	const data = {};

	for (let input of feedbackform) {
		if (input.name !== "" && input.value !== "") {
			data[input.name] = input.value
		}
	}

	console.log(data);

	fetch(feedbackform.action, { method: "POST", body: JSON.Stringify(data) }).then(function(res){
		if (res.ok) {
			console.log(res);
		} else {
			console.log("error", res);
		}
	});

	return false;
}
