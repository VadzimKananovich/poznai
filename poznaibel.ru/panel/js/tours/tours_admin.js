class ToursAdmin{
	constructor(type){
		this.type = type;
		this.getElements();
		this.table = new Table(type);
		this.init();
	}
	getElements(){
		this.container = document.querySelector('#belarusTorus');
		this.select = document.querySelector('#belarusMenu');
		this.addModal = document.querySelector('#addBelarusTour');
		this.setImgModal = document.querySelector('#belarusSetImgModal');
		this.setModal = document.querySelector('#editBelarusTour');
		this.rmModal = document.querySelector('#delBelarusTour');
		this.rnModal = document.querySelector('#renameSectionModal');
		this.addBtn = document.querySelector('#addBelarusTourBtn');
		this.rnBtn = document.querySelector('#renameBtn');
	}
	init(){
		switch(this.type){
			case 'belarus': this.navKey = 'toursBelarusNav';
			break;
			case 'belarus_pref': this.navKey = 'toursBelarusPrefNav';
			break;
			case 'foreigners': this.navKey = 'toursForeignersNav';
			break;
			case 'foreigners_pref': this.navKey = 'toursForeignersPrefNav';
			break;
		}
		this.container.appendChild(this.table.head);
		this.container.appendChild(this.table.body);
		this.sendRequest()
		.then(this.insertDates.bind(this));
	}
	sendRequest(){
		this.http = new XMLHttpRequest();
		switch(this.type){
			case 'belarus':this.url = 'includes/request_tours.php?action=get_info&type=belarus';
			break;
			case 'belarus_pref':this.url = 'includes/request_tours.php?action=get_info&type=belarus_pref';
			break;
			case 'foreigners':this.url = 'includes/request_tours.php?action=get_info&type=foreigners';
			break;
			case 'foreigners_pref':this.url = 'includes/request_tours.php?action=get_info&type=foreigners_pref';
			break;
		}
		this.http.open('GET', this.url);
		this.http.send();
		return new Promise(this.getDates.bind(this));
	}
	getDates(resolve,reject){
		this.http.onreadystatechange = ()=>{
			if(this.http.readyState === 4 && this.http.status === 200){
				let res = JSON.parse(this.http.responseText);
				resolve(res);
			}
		}
	}
	insertDates(res){
		this.result = res;
		this.createObject();
		this.createMenu();
		this.insertBodyElements();
	}
	createMenu(){
		for(let key in this.result){
			this.select.appendChild(this.creteOption(this.result[key][0],key));
		}
		if(!window.localStorage.getItem(this.navKey)){
			window.localStorage.setItem(this.navKey,this.select.value);
		}
		this.select.value = window.localStorage.getItem(this.navKey);
		this.initMenu();
	}
	creteOption(txt,key){
		let option = document.createElement('option');
		option.value = key;
		option.appendChild(document.createTextNode(txt));
		return option;
	}
	initMenu(){
		this.select.addEventListener('click',(e)=>{
			window.localStorage.setItem(this.navKey,this.select.value);
			this.insertBodyElements();
		});
	}
	createObject(){
		for(let key in this.result){
			for(let i = 1; i < this.result[key].length;i++){
				for(let j = 0; j < this.result[key][i].img.length; j++){
					let imgPatch = this.result[key][i].img[j];
					let img = new Image();
					img.src = '../'+imgPatch;
					this.result[key][i].img[j] = img;
				}
			}
		}
	}
	insertBodyElements(select){
		this.table.body.innerHTML = '';
		let type = window.localStorage.getItem(this.navKey);
		let tours = this.result[type];
		for(let i = 1; i < tours.length; i++){
			let tr = document.createElement('tr');
			tr.appendChild(this.createNum(i));
			if(this.type === 'belarus_pref' || this.type === 'foreigners_pref'){
				let date = tours[i].date ? tours[i].date : 'no dates';
				tr.appendChild(this.createTextCol(date,'auto','center'));
			}
			tr.appendChild(this.createTextCol(tours[i].name,'auto','center'));
			// tr.appendChild(this.createTextCol(tours[i].desc,300,'left'));
			// tr.appendChild(this.createTextCol(tours[i].price,100,'center'));
			// tr.appendChild(this.createTextCol(tours[i].currency,100,'center'));
			// tr.appendChild(this.createTextCol(tours[i].route,200,'center'));
			// let duration = tours[i].hasOwnProperty('duration') ? tours[i].duration : 'НЕТ ДАННЫХ';
			// tr.appendChild(this.createTextCol(duration,100,'center'));
			// tr.appendChild(this.createTextCol(tours[i].program,300,'center'));
			// let place = tours[i].hasOwnProperty('place') ? tours[i].place : '';
			// tr.appendChild(this.createTextCol(place,220,'center'));
			tr.appendChild(this.createSlider(tours[i].img,type,i));
			tr.appendChild(this.createSetBtn(type,i));
			tr.appendChild(this.createRmBtn(type,i));
			this.table.body.appendChild(tr);
		}
		this.initRnBtn();
		this.initAddBtn();
		this.initCarousel();
		this.initEditableArea();
		this.initTableResize();
	}
	createNum(i){
		let th = document.createElement('th');
		th.scope = 'row';
		th.appendChild(document.createTextNode(i));
		return th;
	}
	createTextCol(txt,width,align){
		let td = document.createElement('td');
		let div = document.createElement('div');
		let currWidth = width ? width : 'auto';
		div.setAttribute('style','width: '+currWidth);
		div.className = 'content-table-cell';
		td.appendChild(div);
		div.innerHTML = txt;
		return td;
	}
	createSlider(array,type,tourIndex){
		let td = document.createElement('td');
		let wrap = document.createElement('div');
		wrap.className = 'td-wrap';
		let container = document.createElement('div');
		container.className = 'belarus-carousel';
		container.setAttribute('style','width: 250px; height: 175px;');
		for(let i = 0; i < array.length; i++){
			array[i].setAttribute('style','width: 250px; height: 175px;');
			container.appendChild(array[i]);
		}
		wrap.appendChild(container);
		td.appendChild(wrap);
		td.appendChild(this.createImgBtn(array,type,tourIndex));
		return td;
	}
	createImgBtn(array,type,tourIndex){
		let btn = document.createElement('button');
		let div = document.createElement('div');
		div.className = 'button-slider-cell';
		btn.type = 'button';
		btn.dataset.toggle = 'modal';
		btn.appendChild(document.createTextNode('Открыть слайдер'));
		btn.className = 'btn btn-primary mr-around-1';
		this.initImgBtn(btn,array,type,tourIndex);
		div.appendChild(btn);
		return div;
	}
	initImgBtn(btn,array,type,tourIndex){
		btn.addEventListener('click',(e)=>{
			this.initImgModal(array,type,tourIndex);
			$(this.setImgModal).modal('show');
		});
	}
	initImgModal(array,type,tourIndex){
		let container = this.setImgModal.querySelector('#imgBelarusContainer');
		let inputItem = this.setImgModal.querySelector('#inputItem');
		inputItem.value = `${type}%${tourIndex}`;
		container.innerHTML = '';
		for(let i = 0; i < array.length; i++){
			container.appendChild(this.createModalImgRow(array[i],type,tourIndex,i));
		}
	}
	createModalImgRow(img,type,tourIndex,imgIndex){
		let div = document.createElement('div');
		div.className = 'row mrb-1';
		div.appendChild(this.createImgCol(img));
		div.appendChild(this.createImgBtnCol(type,tourIndex,img));
		return div;
	}
	createImgCol(img){
		let div = document.createElement('div');
		div.className = 'col-md-5';
		let modalImg = img.cloneNode(true);
		modalImg.setAttribute('style','width:250px;height:175px;');
		div.appendChild(modalImg);
		return div;
	}
	createImgBtnCol(type,tourIndex,img){
		let imgSplit = img.src.split('/');
		let imgName = imgSplit[imgSplit.length-1];
		let div = document.createElement('div');
		div.className = 'col-md-7';

		let form = document.createElement('form');
		switch(this.type){
			case 'belarus' : form.action = 'includes/request_tours.php?action=edit_info&type=belarus_del_img';
			break;
			case 'belarus_pref' : form.action = 'includes/request_tours.php?action=edit_info&type=belarus_pref_del_img';
			break;
			case 'foreigners' : form.action = 'includes/request_tours.php?action=edit_info&type=foreigners_del_img';
			break;
			case 'foreigners_pref' : form.action = 'includes/request_tours.php?action=edit_info&type=foreigners_pref_del_img';
			break;
		}
		form.method = 'post';

		let input = document.createElement('input');
		input.type = 'hidden';
		input.id = 'imgToDel';
		input.name = 'imgToDel';
		input.value = `${type}%${tourIndex}%${imgName}`;

		let btn = document.createElement('button');
		btn.className = 'btn btn-danger';
		btn.dataset.toggle = 'modal';
		btn.type = 'submit';
		btn.appendChild(document.createTextNode('УДАЛИТЬ'));

		form.appendChild(input);
		form.appendChild(btn);
		div.appendChild(form);
		return div;
	}
	createSetBtn(type,tourIndex){
		let td = document.createElement('td');
		let btn = document.createElement('button');
		let div = document.createElement('div');
		div.className = 'content-table-cell';
		btn.className = 'btn btn-primary';
		btn.type = 'button';
		btn.dataset.toggle='modal';
		btn.appendChild(document.createTextNode('Изменить'));
		this.initSetBtn(btn,type,tourIndex);
		div.appendChild(btn);
		td.appendChild(div);
		return td;
	}
	initSetBtn(btn,type,tourIndex){
		btn.addEventListener('click',(e)=>{
			this.initSetModal(type,tourIndex);
			$(this.setModal).modal('show');
		})
	}
	initSetModal(type,tourIndex){
		let titleModal = this.setModal.querySelector('#modalTitle');
		titleModal.innerHTML = this.result[type][0] + ' / ' + this.result[type][parseInt(tourIndex)].name;
		let inputItem = this.setModal.querySelector('#inputItem');
		inputItem.value = `${type}%${tourIndex}`;
		if(this.type === 'belarus_pref' || this.type === 'foreigners_pref'){
			let date = this.setModal.querySelector('#inputDate');
			date.value = this.result[type][parseInt(tourIndex)].date;
		}
		let title = this.setModal.querySelector('#inputName');
		title.value = this.result[type][parseInt(tourIndex)].name;

		let desc = this.setModal.querySelector('#inputDesc');
		let editableDesc = desc.previousSibling.querySelector('.nicEdit-main');
		editableDesc.innerHTML = this.result[type][parseInt(tourIndex)].desc;

		let price = this.setModal.querySelector('#inputPrice');
		price.value = this.result[type][parseInt(tourIndex)].price;
		let currency = this.setModal.querySelector('#inputCurrency');
		currency.value = this.result[type][parseInt(tourIndex)].currency;

		let route = this.setModal.querySelector('#inputRoute');
		let editableRoute = route.previousSibling.querySelector('.nicEdit-main');
		editableRoute.innerHTML = this.result[type][parseInt(tourIndex)].route;

		let duration = this.setModal.querySelector('#inputDuration');
		let durationValue = this.result[type][parseInt(tourIndex)].hasOwnProperty('duration') ?
		this.result[type][parseInt(tourIndex)].duration : 'НЕТ ДАННЫХ';
		duration.value = durationValue;

		let program = this.setModal.querySelector('#inputProgram');
		let editableProgram = program.previousSibling.querySelector('.nicEdit-main');
		editableProgram.innerHTML = this.result[type][parseInt(tourIndex)].program;

		let place = this.setModal.querySelector('#inputPlace');
		let placeText = this.result[type][parseInt(tourIndex)].hasOwnProperty('place') ? this.result[type][parseInt(tourIndex)].place : '';
		place.value = placeText;

		let submit = this.setModal.querySelector('#sendModal');
		submit.addEventListener('click',(e)=>{
			this.fromDivToText(editableDesc,desc);
			this.fromDivToText(editableRoute,route);
			this.fromDivToText(editableProgram,program);
		});
	}
	createRmBtn(type,tourIndex){
		let td = document.createElement('td');
		let btn = document.createElement('button');
		let div = document.createElement('div');
		div.className = 'content-table-cell';
		btn.className = 'btn btn-danger';
		btn.type = 'button';
		btn.dataset.target = 'modal';
		btn.appendChild(document.createTextNode('Удалить'));
		this.initRmBtn(btn,type,tourIndex);
		div.appendChild(btn);
		td.appendChild(div);
		return td;
	}
	initRmBtn(btn,type,tourIndex){
		btn.addEventListener('click',(e)=>{
			this.initRmModal(type,tourIndex);
			$(this.rmModal).modal('show');
		});
	}
	initRmModal(type,tourIndex){
		let inputItem = this.rmModal.querySelector('#inputItem');
		inputItem.value = `${type}%${tourIndex}`;
	}
	initAddBtn(){
		this.addBtn.addEventListener('click',(e)=>{
			this.initAddModal();
			$(this.addModal).modal('show');
		});
	}
	initAddModal(){
		let inputItem = this.addModal.querySelector('#inputItem');
		inputItem.value = this.select.value;

		let desc = this.addModal.querySelector('#inputDescAdd');
		let editableDesc = desc.previousSibling.querySelector('.nicEdit-main');

		let route = this.addModal.querySelector('#inputRouteAdd');
		let editableRoute = route.previousSibling.querySelector('.nicEdit-main');

		let program = this.addModal.querySelector('#inputProgramAdd');
		let editableProgram = program.previousSibling.querySelector('.nicEdit-main');

		let submit = this.addModal.querySelector('#sendModal');
		submit.addEventListener('click',(e)=>{
			this.fromDivToText(editableDesc,desc);
			this.fromDivToText(editableRoute,route);
			this.fromDivToText(editableProgram,program);
		});
	}
	initCarousel(){
		$(".belarus-carousel").owlCarousel({
			slideSpeed: 300,
			autoPlay: false,
			navigation: false,
			// navigationText: ["&#xf007","&#xf006"],
			pagination: false,
			singleItem: true
		});
	}
	initEditableArea(){
		let editable = document.querySelectorAll('.nicEdit-main');
		for(let i = 0; i < editable.length; i++){
			editable[i].parentNode.style.width="100%";
			editable[i].parentNode.previousSibling.style.width="100%";
		}
	}
	fromDivToText(div,textarea){
		let wrap = document.createDocumentFragment();
		let content = div.childNodes;
		textarea.innerHTML = '';
		for(let i = 0; i < content.length; i++){
			wrap.appendChild(content[i].cloneNode(true));
		}
		textarea.appendChild(wrap);
	}
	initTableResize(){
		$(this.container).colResizable({
			resizeMode:'fit'
		});
	}
	initRnBtn(){
		this.rnBtn.addEventListener('click',(e)=>{
			this.initRnModal();
			$(this.rnModal).modal('show');
		});
	}
	initRnModal(){
		let inputName = this.rnModal.querySelector('#inputName');
		let inputItem = this.rnModal.querySelector('#inputItem');
		let key = this.select.value;
		let name = this.result[key][0];
		inputItem.value = key;
		inputName.value = name;
	}
}
