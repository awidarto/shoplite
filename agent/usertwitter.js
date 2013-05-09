var Stream = require('user-stream');
var stream = new Stream({
    consumer_key: 'WYYOGrEUaivAP6egCWWHgA',
    consumer_secret: '1IpGruMiRnPWznsZx52Btbd5nmZlS5MRyIZQCk8DzUs',
    access_token_key: '46893111-B8ZutxnBKoSFIwM9ne2VC0Hap4xrfz7Xf20Ds7guZ',
    access_token_secret: 'pAMRzzvUJvxop31yMizkwRsfbVXAHaqFO4HP6Hk'
});

//create stream
stream.stream();

//listen stream data
stream.on('data', function(json) {
	if(json.user !== undefined){
		console.log(json.user);
	}
	  console.log(json.text);
	  console.log('======================\r\n');
});