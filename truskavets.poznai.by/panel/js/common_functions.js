class CommonFunctions{
	constructor(){
		this.modal = new Modal;
		this.formElements = new FormElements;
		this.http = new XMLHttpRequest();
	}

	cleareText(item,className){
		let div = document.createElement('div');
		div.innerHTML = item;
		let res = '';
		for(let i = 0; i < div.childNodes.length; i++){
			if(div.childNodes[i].textContent){
				res += '<div class="'+className+'">'+div.childNodes[i].textContent+'</div>';
			}
		}
		return res;
	}

	addLoader(){
		let loader = document.querySelector('.loader');
		if(!loader){
			document.body.appendChild(this.createLoader());
		}
	}
	toggleLoader(){
		setTimeout(()=>{
			let loader = document.querySelector('.loader');
			if(loader){
				loader.parentNode.removeChild(loader);
			}
		},500);
	}
	createLoader(){
		let div = document.createElement('div');
		div.className = 'loader';
		let img = new Image();
		img.src = this.path+'img/loader.gif';
		div.appendChild(img);
		return div;
	}
	saveAlert(){
		let modal = this.modal.alert('Данные сохранены');
		$(modal).modal();
	}
	writeJsonRequest(fun){
		let scroll = window.scrollY;
		this.sendRequest({
			'method':'POST',
			'url':this.set.request_file+'?action=write_json&path='+encodeURIComponent(this.set.json),
			'dates':'file='+JSON.stringify(this.json)
		}).then((()=>{
			if(fun) fun();
			this.writeDates('rewrite');
			this.toggleLoader();
		}).bind(this));
	}
	sendRequest(set){
		let url = set.url;
		let method = set.method;
		let dates = set.method === 'POST' || set.method === 'post' ? set.dates : false;
		this.http.open(method,url);
		this.http.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		if(dates){
			this.http.send(dates);
		} else {
			this.http.send();
		}
		return new Promise(this.requestPromise.bind(this));
	}
	requestPromise(resolve,reject){
		this.http.onreadystatechange = ()=>{
			if(this.http.readyState === 4 && this.http.status === 200){
				resolve(this.http.responseText);
			}
		}
	}
}
