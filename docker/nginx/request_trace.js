function request_trace(r) {
	var uuid = r.headersIn['X-Request-Uuid-Trace'];

	return IsUuidv4(uuid) ?
		uuid :
		uuidv4();
}

function uuidv4() {
	return 'xxxxxxxx-xxxx-4xxx-xxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
		var r = Math.random() * 16 | 0,
			v = c == 'x' ? r : (r & 0x3 | 0x8);

		return v.toString(16);
	});
}

function IsUuidv4(uuidv) {
	var uuidV4Regex = /^[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}$/i;

	return uuidV4Regex.test(uuidv);
}