class AboutBelarus{
	constructor(select,table){
		this.container = document.querySelector(`#${table}`);
		this.menuContainer = document.querySelector(`#${select}`);
		this.rnBtn = document.querySelector('#renameBtn');
		this.addBtn = document.querySelector('#addBtn');

		this.modal = document.querySelector('#editAbout');
		this.addModal = document.querySelector('#addAbout');
		this.delModal = document.querySelector('#delAbout');

		this.http = new XMLHttpRequest();
		this.url = 'includes/request.php?action=get_info&section=about_belarus';
		this.modal = document.querySelector('#editAbout');
		this.init();
	}
	init(){
		this.http.open('GET',this.url);
		this.sendRequest()
		.then(this.insertDates.bind(this));
	}
	sendRequest(){
		this.http.send();
		return new Promise(this.getResult.bind(this));
	}
	getResult(resolve,reject){
		this.http.onreadystatechange = ()=>{
			if(this.http.readyState === 4 && this.http.status === 200){
				let result = JSON.parse(this.http.responseText);
				resolve(result);
			}
		}
	}
	insertDates(res){
		this.result = res;
		this.createMenu();
		this.initOption();
		this.initRnBtn();
		this.initAddBtn();
		this.insertInTable(window.localStorage.getItem('aboutNav'));
	}
	createMenu(){
		for(let key in this.result){
			this.menuContainer.appendChild(this.createOption(this.result[key].tabs_name,key));
		}
		if(!window.localStorage.getItem('aboutNav')){
			window.localStorage.setItem('aboutNav',this.menuContainer.value);
		}
		this.menuContainer.value = window.localStorage.getItem('aboutNav');
	}
	createOption(name,key){
		let option = document.createElement('option');
		option.appendChild(document.createTextNode(name));
		option.value = key;
		return option;
	}
	initOption(){
		this.menuContainer.addEventListener('click',(e)=>{
			this.insertInTable(e.currentTarget.value);
			window.localStorage.setItem('aboutNav',this.menuContainer.value);
		});
	}
	initRnBtn(){
		this.rnBtn.addEventListener('click',()=>{
		});
	}
	initAddBtn(){
		this.addBtn.addEventListener('click',()=>{
			let inputItem = this.addModal.querySelector('#inputItem');
			inputItem.value = this.menuContainer.value;
			$(this.addModal).modal('show');
		});
	}
	insertInTable(key){
		let object = this.result[key].img;
		let countRow = 1;
		this.container.innerHTML = '';
		for(let i = 0; i < object.length; i++){
			let row = document.createElement('tr');
			let th = document.createElement('th');
			th.setAttribute('scope','row');
			th.appendChild(document.createTextNode(countRow));
			row.appendChild(th);
			row.appendChild(this.createName(object[i].title));
			row.appendChild(this.createDesc(object[i].desc));
			row.appendChild(this.createImg(key,object[i].src));
			row.appendChild(this.createSetBtn(key,i));
			row.appendChild(this.createDelBtn(key,i));
			this.container.appendChild(row);
			countRow++;
		}
	}
	createName(name){
		let td = document.createElement('td');
		td.appendChild(document.createTextNode(name));
		return td;
	}
	createDesc(desc){
		let td = document.createElement('td');
		td.appendChild(document.createTextNode(desc));
		return td;
	}
	createImg(key,src){
		let td = document.createElement('td');
		let img = new Image();
		img.src = '../img/about_belarus/'+key+'/'+src;
		img.setAttribute('style','width:200px; height:140px');
		td.appendChild(img)
		return td;
	}
	createSetBtn(folder,img){
		let td = document.createElement('td');
		let btn = document.createElement('button');
		btn.setAttribute('type','button');
		btn.className = 'btn btn-primary';
		btn.dataset.toggle = 'modal';
		btn.innerHTML = 'Изменить';
		this.initBtn(btn,folder,img);
		td.appendChild(btn);
		return td;
	}
	createDelBtn(folder,img){
		let td = document.createElement('td');
		let btn = document.createElement('button');
		btn.setAttribute('type','button');
		btn.className = 'btn btn-danger';
		btn.dataset.toggle = 'modal';
		btn.innerHTML = 'Удалить';
		this.initDelBtn(btn,folder,img);
		td.appendChild(btn);
		return td;
	}
	initBtn(btn,folder,img){
		btn.addEventListener('click',(e)=>{
			this.initModal(folder,img);
			$(this.modal).modal('show');
		});
	}
	initDelBtn(btn,folder,img){
		btn.addEventListener('click',(e)=>{
			this.initDelModal(folder,img);
			$(this.delModal).modal('show');
		});
	}
	initModal(folder,img){
		let title = this.modal.querySelector('#modalTitle');
		let inputItem = this.modal.querySelector('#inputItem');
		let inputName = this.modal.querySelector('#inputName');
		let inputDesc = this.modal.querySelector('#inputDesc');
		let image = this.modal.querySelector('#image');
		image.value = '';
		title.innerHTML = this.result[folder].tabs_name;
		inputItem.value = folder+'%'+img;
		inputName.value = this.result[folder].img[img].title;
		inputDesc.value = this.result[folder].img[img].desc;
	}
	initDelModal(folder,img){
		let inputItem = this.delModal.querySelector('#inputItem');
		inputItem.value = folder+'%'+img;
	}
}
