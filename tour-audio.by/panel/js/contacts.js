class Contact{
	constructor(){
		this.http = new XMLHttpRequest;
		this.url = 'includes/request.php?action=';
		this.getElements();
		this.init();
	}
	getElements(){
		this.container = document.querySelector('#contactForms');
		this.formCity = this.container.querySelector('#formCity');
		this.formAddress = this.container.querySelector('#formAddress');
		this.formPostal = this.container.querySelector('#formPostal');
		this.formEmail = this.container.querySelector('#formEmail');
		this.formPhone = this.container.querySelector('#formPhone');
		this.formSocial = this.container.querySelector('#formSocial');
		this.submit = this.container.querySelector('#submitButton');
	}

	init(){
		this.icons = {
			'viber':'fab fa-viber',
			'whatsapp':'fab fa-whatsapp',
			'velcom':'mobo-velcom-24',
			'mts':'mobo-mts-24',
			'life':'mobo-life-24',
			'home':'mobo-home-24',
			'vk':'fab fa-vk'
		}
		this.sendRequest('get_contacts')
		.then((res)=>{
			this.contacts = JSON.parse(res);
			console.log(this.contacts);
			this.insertDates();
			this.initInput(this.formCity.querySelector('input'));
			this.initInput(this.formAddress.querySelector('input'));
			this.initInput(this.formPostal.querySelector('input'));
			this.initEmailInput(this.formEmail.querySelector('input'));
			this.initSubmit();
		});
	}
	insertDates(){
		this.insertString('city');
		this.insertString('address');
		this.insertString('postal');
		this.insertArray('email');
		this.insertMulty('phone');
		this.insertMulty('social');
	}
	insertString(type){
		switch(type){
			case 'city':
			let city = this.formCity.querySelector('input');
			city.value = this.contacts.city;
			break;
			case 'address':
			let address = this.formAddress.querySelector('input');
			address.value = this.contacts.address;
			case 'postal':
			let postal = this.formPostal.querySelector('input');
			postal.value = this.contacts.postal;
			break;
		}
	}
	insertArray(type){
		switch(type){
			case 'email':
			let email = this.formEmail.querySelector('input');
			email.value = this.contacts.email.join(', ');
			break;
		}
	}
	insertMulty(type){
		switch(type){
			case 'phone':
			this.insertPhone();
			this.initAddBtn('phone');
			break;
			case 'social':
			this.insertSocial();
			this.initAddBtn('social');
			break;
		}
	}

	insertPhone(oneRow){
		if(!oneRow){
			for(let i = 0; i < this.contacts.phone.length; i++){
				let item = this.contacts.phone[i];
				let tel = item.tel.trim();
				let telRes = tel.includes('+') ? tel : '+'+tel;
				let row = document.createElement('div');
				row.className = 'row mrb-1 phone-row brd-b';
				row.appendChild(this.createMultyRow('телефон',telRes,'phone-input','phone','tel',i,'4'));
				row.appendChild(this.createMultyRow('оператор',item.operator,'operator-input','phone','operator',i,'4'));
				// row.appendChild(this.createMultyRow('иконка',item.ico,'ico-input','phone','ico',i,'2'));
				row.appendChild(this.createCheckRow('messenger','messenger-input','phone','messenger',i,'3'));
				row.appendChild(this.createDelBtn(i,'phone','1'));
				this.formPhone.insertBefore(row,this.formPhone.querySelector('.submit-wrap'));
			}
		} else {
			let row = document.createElement('div');
			row.className = 'row mrb-1 phone-row brd-b';
			row.appendChild(this.createMultyRow('телефон','','phone-input','phone','tel',this.contacts.phone.length,'4'));
			row.appendChild(this.createMultyRow('оператор','','operator-input','phone','operator',this.contacts.phone.length,'4'));
			// row.appendChild(this.createMultyRow('иконка','','ico-input','phone','ico',this.contacts.phone.length,'2'));
			row.appendChild(this.createCheckRow('messenger','messenger-input','phone','messenger',this.contacts.phone.length,'3'));
			row.appendChild(this.createDelBtn(this.contacts.phone.length,'phone','1'));
			this.formPhone.insertBefore(row,this.formPhone.querySelector('.submit-wrap'));
		}
	}

	insertSocial(oneRow){
		if(!oneRow){
			for(let i = 0; i < this.contacts.social.length; i++){
				let item = this.contacts.social[i];
				let row = document.createElement('div');
				row.className = 'row mrb-1 phone-row brd-b';
				row.appendChild(this.createMultyRow('соц. сеть',item.social,'social-input','social','social',i,'5'));
				row.appendChild(this.createMultyRow('адрес',item.link,'social-link','social','link',i,'6'));
				// row.appendChild(this.createMultyRow('иконка',item.ico,'ico-input','social','ico',i,'3'));
				row.appendChild(this.createDelBtn(i,'social','1'));
				this.formSocial.insertBefore(row,this.formSocial.querySelector('.submit-wrap'));
			}
		} else {
			let row = document.createElement('div');
			row.className = 'row mrb-1 phone-row brd-b';
			row.appendChild(this.createMultyRow('соц. сеть','','social-input','social','social',this.contacts.social.length,'5'));
			row.appendChild(this.createMultyRow('адрес','','social-link','social','link',this.contacts.social.length,'6'));
			// row.appendChild(this.createMultyRow('иконка','','ico-input','social','ico',this.contacts.social.length,'3'));
			row.appendChild(this.createDelBtn(this.contacts.social.length,'social','1'));
			this.formSocial.insertBefore(row,this.formSocial.querySelector('.submit-wrap'));
		}
	}

	createMultyRow(label,value,className,type,key,id,colNum){
		let col = document.createElement('div');
		col.className = 'col-md-'+colNum;
		let row = document.createElement('div');
		row.className = 'form-group '+className;
		row.appendChild(this.createInput(label,value,type,key,id,className));
		col.appendChild(row);
		return col;
	}
	createInput(label,value,type,key,id,className){
		let wrap = document.createDocumentFragment();
		let labelDom = document.createElement('label');
		wrap.appendChild(labelDom);
		labelDom.appendChild(document.createTextNode(label));
		if(className === 'operator-input' || className === 'social-input'){
			wrap.appendChild(this.createSelect(label,value,type,key,id,className));
		} else {
			let input = document.createElement('input');
			input.value = value;
			input.type = 'text';
			input.dataset.type = type;
			input.dataset.key = key;
			input.dataset.id = id;
			input.className = 'form-control';
			wrap.appendChild(input);
			this.initInput(input);
		}
		return wrap;
	}
	createSelect(label,value,type,key,id,className){
		let select = document.createElement('select');
		select.className = 'form-control';
		if(className === 'operator-input'){
			select.appendChild(this.createOption('Velcom',value));
			select.appendChild(this.createOption('MTS',value));
			select.appendChild(this.createOption('Life',value));
			select.appendChild(this.createOption('Городской',value));
		}
		if(className === 'social-input'){
			select.appendChild(this.createOption('ВКонтакте',value));
			select.appendChild(this.createOption('Facebook',value));
			select.appendChild(this.createOption('Instagram',value));
			select.appendChild(this.createOption('Skype',value));
		}
		this.initSelect(select,type,id);
		return select;
	}
	createOption(txt,value){
		let option = document.createElement('option');
		option.value = txt;
		if(txt === value){
			option.selected = 'selected';
		}
		option.appendChild(document.createTextNode(txt));
		return option;
	}
	initSelect(select,type,id){
		select.addEventListener('change',()=>{
			let key = type === 'phone' ? 'operator' : 'social';
			this.contacts[type][id][key] = select.value;
		});
	}
	createCheckRow(label,className,type,key,id,colNum){
		let col = document.createElement('div');
		col.className = 'col-md-'+colNum;
		let labelDom = document.createElement('label');
		labelDom.appendChild(document.createTextNode(label));
		col.appendChild(labelDom);
		col.appendChild(this.createCheckBox('viber','viber',type,key,id));
		col.appendChild(this.createCheckBox('whatsapp','whatsapp',type,key,id));
		return col;
	}
	createCheckBox(label,value,type,key,id){
		let row = document.createElement('div');
		row.className = 'form-check';
		let input = document.createElement('input');
		input.className = 'form-check-input';
		input.type = 'checkbox';
		input.value = value;
		input.id = value+'%'+id;
		input.dataset.type = type;
		input.dataset.key = key;
		input.dataset.id = id;
		let exist = 0;
		if(this.contacts[type][id]){
			for(let i = 0; i < this.contacts[type][id][key].length; i++){
				if(this.contacts[type][id][key][i][0] === value){
					exist++;
				}
			}
		}
		input.checked = exist ? true : false;
		let labelDom = document.createElement('label');
		labelDom.setAttribute('for',value+'%'+id);
		labelDom.appendChild(document.createTextNode(label));
		row.appendChild(input);
		row.appendChild(labelDom);
		this.initCheckBox(input);
		return row;
	}
	createDelBtn(id,type,colNum){
		let col = document.createElement('col');
		col.className = 'col-md-'+colNum+' centered';
		let group = document.createElement('div');
		group.className = 'form-group centered';
		col.appendChild(group);
		let btn = document.createElement('button');
		btn.className = 'btn btn-danger btn-del';
		btn.type = 'button';
		btn.appendChild(document.createTextNode('X'));
		btn.dataset.id=id;
		btn.dataset.type=type;
		group.appendChild(btn);
		this.initDel(btn);
		return col;
	}
	initDel(btn){
		btn.addEventListener('click',(e)=>{
			btn.parentNode.parentNode.parentNode.parentNode.removeChild(btn.parentNode.parentNode.parentNode);
			let id =  Number(btn.dataset.id);
			delete this.contacts[btn.dataset.type][id];
		});
	}
	initAddBtn(type){
		let container;
		let fun;
		let item;
		let newObject;
		switch(type){
			case 'phone':
			container = this.formPhone;
			fun = this.insertPhone.bind(this);
			item = this.contacts.phone;
			newObject = {'tel':'','operator':'','ico':'','messenger':''};
			break;
			case 'social':
			container = this.formSocial;
			fun = this.insertSocial.bind(this);
			item = this.contacts.social;
			newObject = {'social':'','link':'','ico':''};
			break;
		}
		let btn = container.querySelector('.add-btn');
		btn.addEventListener('click',(e)=>{
			fun(true);
			item.push(newObject);
		});
	}

	initInput(input){
		input.addEventListener('keydown',(e)=>{
			if(input.dataset.hasOwnProperty('key')){
				setTimeout(()=>{
					this.contacts[input.dataset.type][Number(input.dataset.id)][input.dataset.key] = input.value;
				},0)
			} else {
				setTimeout(()=>{
					this.contacts[input.dataset.type] = input.value;
				},0)
			}
		});
	}

	initCheckBox(input){
		let res = [];
		input.addEventListener('click',(e)=>{
			let container = input.parentNode.parentNode;
			let allCheck = container.querySelectorAll('input');
			for(let i = 0; i < allCheck.length; i++){
				if(allCheck[i].checked){
					if(res.indexOf(allCheck[i].value) === -1){
						res.push(allCheck[i].value);
					}
				}
			}
			this.refreshObject(res,input.dataset.type,input.dataset.key,input.dataset.id);
			res = [];
		});
	}
	refreshObject(res,type,key,id){
		for(let  i = 0; i < res.length; i++){
			res[i] = [res[i],this.icons[res[i]]];
		}
		this.contacts[type][id][key] = res;
	}
	initEmailInput(input){
		input.addEventListener('keydown',(e)=>{
			setTimeout(()=>{
				let array = input.value.split(',');
				this.contacts.email = array.filter(item => item.trim);
			},0);
		});
	}

	initSubmit(){
		this.submit.addEventListener('click',(e)=>{
			this.sendRequest('write_contacts',true)
			.then((res)=>{
				window.location = window.location.href;
			});
		})
	}


	sendRequest(action,post) {
		let url = this.url+action;
		let type = post ? 'POST' : 'GET';
		let param = post ? 'object='+JSON.stringify(this.contacts) : '';
		this.http.open(type,url,true);
		this.http.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		this.http.send(param);
		return new Promise(((resolve,reject)=>{
			this.http.onreadystatechange = ()=>{
				if(this.http.readyState === 4 && this.http.status === 200){
					resolve(this.http.responseText);
				}
			}
		}).bind(this));
	}
}
