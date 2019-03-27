let vad = new JSONconnect('vadzim','arrogaminca');



vad.connect()
.then (vad.newbd.bind(vad,'vadzim'))
.then (()=>{
	console.log(vad);
})
