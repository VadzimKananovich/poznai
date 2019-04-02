class Header{
	constructor(id){
		this.container = document.querySelector(`#${id}`);
		this.addBtn = document.querySelector('#addBtnHeader');
		this.addModal = document.querySelector('#addHeader');
		this.rmModal = document.querySelector('#delHeader');
		this.http = new XMLHttpRequest();
		this.url = 'includes/request.php?action=get_info&section=header';
		this.modal = document.querySelector('#editHeader');
		this.init();
	}
	init(){
		this.sendRequest()
		.then(this.insertDates.bind(this));
	}
	sendRequest(){
		this.http.open('GET',this.url);
		this.http.send();
		return new Promise(this.getInfo.bind(this));
	}
	getInfo(resolve,reject){
		this.http.onreadystatechange = ()=>{
			if(this.http.readyState === 4 && this.http.status === 200){
				let result = JSON.parse(this.http.responseText);
				resolve(result);
			}
		}
	}
	insertDates(result){
		this.result = result;
		this.countRow = 1;
		for(let key in this.result){
			let row = document.createElement('tr');
			let th = document.createElement('th');
			th.setAttribute('scope','row');
			th.appendChild(document.createTextNode(this.countRow));
			row.appendChild(th);
			row.appendChild(this.createTd(key,this.result[key]));
			this.container.appendChild(row);
			this.countRow++;
		}
		this.initAddBtn();
	}
	createTd(name,object){
		let tdWrap = document.createDocumentFragment();
		tdWrap.appendChild(this.insertDatesTd(name,object.name));
		tdWrap.appendChild(this.insertDatesTd(name,object.desc));
		tdWrap.appendChild(this.insertImg(name,object.img));
		tdWrap.appendChild(this.createSetBtn(name,object.img));
		tdWrap.appendChild(this.createRmBtn(name));
		return tdWrap;
	}
	insertDatesTd(name,dates){
		let td = document.createElement('td');
		td.appendChild(document.createTextNode(dates));
		return td;
	}
	insertImg(name,img){
		let td = document.createElement('td');
		let image = new Image();
		image.src = img;
		image.setAttribute('style','width:200px; height:140px');
		td.appendChild(image);
		return td;
	}
	createSetBtn(name,dates){
		let td = document.createElement('td');
		let btn = document.createElement('button');
		btn.setAttribute('type','button');
		btn.className = 'btn btn-primary';
		btn.dataset.toggle = 'modal';
		btn.innerHTML = 'Изменить';
		this.initBtn(btn,name);
		td.appendChild(btn);
		return td;
	}
	initBtn(btn,name){
		btn.addEventListener('click',(e)=>{
			this.initModal(name);
			$(this.modal).modal('show');
		})
	}
	createRmBtn(name){
		let td = document.createElement('td');
		let btn = document.createElement('button');
		btn.setAttribute('type','button');
		btn.className = 'btn btn-danger';
		btn.dataset.toggle = 'modal';
		btn.innerHTML = 'Удалить';
		this.initRmBtn(btn,name);
		td.appendChild(btn);
		return td;
	}
	initRmBtn(btn,name){
		btn.addEventListener('click',(e)=>{
			this.initRmModal(name);
			$(this.rmModal).modal('show');
		});
	}
	initRmModal(name){
		let inputItem = this.rmModal.querySelector('#inputItem');
		inputItem.value = name;
	}
	initAddBtn(){
		this.addBtn.addEventListener('click',(e)=>{
			$(this.addModal).modal('show');
		});
	}
	initModal(name){
		let inputItem = this.modal.querySelector('#inputItem');
		let inputName = this.modal.querySelector('#inputName');
		let inputDesc = this.modal.querySelector('#inputDesc');
		let image = this.modal.querySelector('#image');
		image.value = '';
		inputItem.value = name;
		inputName.value = this.result[name].name;
		inputDesc.value = this.result[name].desc;
	}
}
