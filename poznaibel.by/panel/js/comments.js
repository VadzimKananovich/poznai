class Comments {
	constructor(){
		this.http = new XMLHttpRequest();
		this.getElements();
		this.init();
	}
	getElements(){
		this.container = document.querySelector('#commentsContainer');
		this.header = this.container.querySelector('.comments-header');
		this.body = this.container.querySelector('.comments-body');
		this.sendBtn = document.querySelector('#sendChanges');
	}
	init(){
		this.sendRequest()
		.then(this.insertDates.bind(this));
	}
	sendRequest(){
		this.http.open('GET', 'includes/request.php?action=get_comments');
		this.http.send();
		return new Promise(this.getJson.bind(this));
	}
	getJson(resolve, reject){
		this.http.onreadystatechange = ()=>{
			if(this.http.readyState === 4 && this.http.status === 200){
				resolve(JSON.parse(this.http.responseText));
			}
		}
	}
	insertDates(res){
		this.comments = res;
		this.rowRes = [];
		this.changes = [];
		this.createHeader();
		this.createBody();
		this.initSendBtn();
	}
	createHeader(){
		let tr = document.createElement('tr');
		tr.appendChild(this.createCol('#',true));
		for(let key in this.comments[0]){
			tr.appendChild(this.createCol(key,true));
		}
		tr.appendChild(this.createCol('#',true));
		this.header.appendChild(tr);
	}
	createBody(){
		for(let i = 0; i < this.comments.length; i++){
			let tr = document.createElement('tr');
			tr.appendChild(this.createCol(Number(i+1),true));
			this.rowRes[i] = tr;
			tr.setAttribute('style', 'background-color:'+this.setRowColor(this.comments[i].state)+';');
			for(let key in this.comments[i]){
				if(key === 'state'){
					tr.appendChild(this.createSelectState(this.comments[i][key],i));
				} else {
					tr.appendChild(this.createCol(this.comments[i][key]));
				}
			}
			tr.appendChild(this.createDelBtn(i));
			this.body.appendChild(tr);
		}
	}
	createCol(item,head){
		let row = head ? document.createElement('th') : document.createElement('td');
		let name = item;
		if(head && name !== '#' && typeof name !== 'number'){
			row.scope = 'col';
			name = this.translate(item);
		}
		row.appendChild(document.createTextNode(name));
		return row;
	}
	createSelectState(item,index){
		let name = this.translate(item);
		let select = document.createElement('select');
		select.className = 'form-control';
		select.dataset.index = index;
		select.appendChild(this.createOptionState('confirm'));
		select.appendChild(this.createOptionState('pending'));
		select.appendChild(this.createOptionState('reject'));
		select.value = item;

		this.initSelect(select);
		return select;
	}
	createOptionState(item){
		let option = document.createElement('option');
		option.appendChild(document.createTextNode(this.translate(item)));
		option.value = item;
		return option;
	}
	createDelBtn(index){
		let td = document.createElement('td');
		let div = document.createElement('div');
		div.className = 'del-btn-wrap';
		let btn = document.createElement('button');
		btn.className = 'btn btn-danger';
		btn.appendChild(document.createTextNode('X'));
		btn.dataset.index = index;
		this.initDelBtn(btn);
		div.appendChild(btn);
		td.appendChild(div);
		return td;
	}

	initSelect(select){
		select.addEventListener('change',()=>{
			let i = Number(select.dataset.index);
			this.rowRes[i].setAttribute('style','background-color:'+this.setRowColor(select.value)+';');
			this.setChanges(i,'state',select.value);
		});
	}
	initDelBtn(btn){
		btn.addEventListener('click',()=>{
			let i = Number(btn.dataset.index);
			this.rowRes[i].parentNode.removeChild(this.rowRes[i]);
			this.setChanges(i,'delete','delete');
		});
	}
	initSendBtn(){
		this.sendBtn.addEventListener('click',()=>{
			if(this.changes.length){
				this.checkChanges()
				.then((res)=>{
					window.location = window.location.href;
				});
			} else {
				// console.log('no changes');
			}
		});
	}

	checkChanges(){
		this.http.open('POST','includes/request.php?action=change_comments');
		this.http.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		let param = `settings=${JSON.stringify(this.changes)}`;
		this.http.send(param);
		return new Promise(this.sendChanges.bind(this));
	}
	sendChanges(resolve,reject){
		this.http.onreadystatechange = ()=>{
			if(this.http.readyState === 4 && this.http.status === 200){
				resolve(this.http.responseText);
			}
		}
	}
	setChanges(index,type,value){
		if(!this.changes[index]){
			this.changes[index] = {};
		}
		this.changes[index][type] = value;
	}

	setRowColor(item){
		switch(item){
			case 'confirm':
			return '#bbf0a5';
			break;
			case 'pending':
			return '#ffeb81';
			break;
			case 'reject':
			return '#ffa7a7';
			break;
		}
	}
	translate(item){
		switch(item){
			case 'name':
			return 'Имя';
			break;
			case 'email':
			return 'Email';
			break;
			case 'comment':
			return 'Отзыв';
			break;
			case 'img':
			return 'Логотип';
			break;
			case 'date':
			return 'Дата';
			break;
			case 'state':
			return 'Состояние';
			break;

			case 'confirm':
			return 'подтвержденный';
			break;
			case 'pending':
			return 'В ожидании';
			break;
			case 'reject':
			return 'Отклонен';
			break;
		}
	}
}
