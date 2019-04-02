class CheckForm extends CommonFunctions{
	constructor(set){
		super();
		this.initDefaultSet();
		this.initPassedSet(set);
		this.getItems(set);
		this.init();
	}
	initDefaultSet(){
		this.set = {
			'form': 'form',
			//'submit':'id',		DEFAULT SUBMIT BTN
			//'action':url,		DEFAULT TAG
			'confirm': 'Ваше сообщение успешно отправлено',
			'formClass': 'check-form',
			'errorClass': 'error-input'
		}
	}
	initPassedSet(set){
		for(let key in set){
			this.set[key] = set[key];
		}
	}

	getItems(){
		this.form = document.querySelector(this.set.form);
		this.action = this.set.action || this.form.action;
		let input = this.form.querySelectorAll('input');
		let textarea = this.form.querySelectorAll('textarea');
		this.inputs = {};
		if(input){
			input.forEach(item=>{
				let key = item.id || item.name;
				this.inputs[key] = {'el':item,'value':''};
			});
		}
		if(textarea){
			textarea.forEach(item=>{
				let key = item.id || item.name;
				this.inputs[key] = {'el':item,'value':''};
			});
		}
		let btns = this.form.querySelector(this.set.submit) || this.form.querySelectorAll('button');
		if(btns.length){
			btns.forEach(item=>{
				if(item.type === 'submit'){
					this.submit = item;
				}
			});
		} else {
			this.submit = btns;
		}
	}

	init(){
		if(!this.form.classList.contains(this.set.formClass)){
			this.form.classList.add(this.set.formClass);
		}
		this.getCheck();
		this.initSubmit();
		this.result = {};
		for(let key in this.inputs){
			this.inputs[key].el.addEventListener('keydown',this.writeResult.bind(this,key));
		}
	}

	writeResult(key){
		let target = this.inputs[key].el;
		setTimeout(()=>{
			if(target.tagName === 'INPUT'){
				this.inputs[key].value = target.value
			}
			if(target.tagName === 'TEXTAREA'){
				this.inputs[key].value = target.textContent;
			}
		},0);
	}

	getCheck(){
		this.check = {};
		this.check.required = {};
		this.check.email = {};
		this.check.telephone = {};
		for(let key in this.inputs){
			let el = this.inputs[key].el;
			if(el.required){
				this.check.required[key] = false;
			}
			if(el.dataset.type === 'email'){
				this.check.email[key] = false;
			}
			if(el.dataset.type === 'telephone'){
				this.check.telephone[key] = false;
			}
		}
	}
	initSubmit(){
		this.submit.addEventListener('click',(e)=>{
			e.preventDefault();
			let check = this.checkInputs();
			let countCheck = 0;
			for(let key in check){
				if(check[key]){
					countCheck++
				}
			}
			if(countCheck === Object.keys(check).length){
				this.submitForm()
				.then(this.confirmSend.bind(this));
			}
		});
	}
	checkInputs(){
		let checked = {};
		for(let key in this.check){
			if(this.check[key]){
				switch(key){
					case 'required': this.checkRequired();
					break;
					case 'email': this.checkEmail();
					break;
					case 'telephone': this.checkTelephone();
					break;
				}
			}
			let checkTrue = Object.keys(this.check[key]).length;
			for(let id in this.check[key]){
				if(this.check[key][id]){
					checkTrue--;
				}
			}
			if(!checkTrue){
				checked[key] = true;
			} else {
				checked[key] = false;
			}
		}
		return checked;
	}
	checkRequired(){
		for(let key in this.check.required){
			if(this.inputs[key].value === ''){
				this.check.required[key] = false;
				this.addError(this.inputs[key].el);
			} else {
				this.check.required[key] = true;
			}
		}
	}
	checkEmail(){
		for(let key in this.check.email){
			if(this.check.required[key] || this.inputs[key].value){
				let reg = new RegExp("^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$");
				if(!reg.test(this.inputs[key].value)){
					this.check.email[key] = false;
					this.addError(this.inputs[key].el);
				} else {
					this.check.email[key] = true;
				}
			} else {
				this.check.email[key] = true;
			}
		}
	}
	checkTelephone(){

	}
	confirmSend(res){
		if(res){
			let confirmElement = this.createConfirmElement();
			this.form.appendChild(confirmElement);
			setTimeout(()=>{
				confirmElement.style.opacity = '0';
				setTimeout(()=>{
					confirmElement.parentNode.removeChild(confirmElement);
				},1000);
			},3000);
		} else {
			console.error('SERVER ERROR');
		}
	}
	addError(item){
		if(!item.classList.contains(this.set.errorClass)){
			item.classList.add(this.set.errorClass);
			item.addEventListener('click',this.removeError.bind(this,item));
		}
	}
	removeError(item){
		if(item.classList.contains(this.set.errorClass)){
			item.classList.remove(this.set.errorClass);
		}
	}
	submitForm(){
		this.http = new XMLHttpRequest;
		this.http.open('POST',this.action);
		this.http.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		let res = {};
		for(let key in this.inputs){
			res[key] = this.inputs[key].value;
		}
		let result = JSON.stringify(res);
		this.http.send('res='+result);
		return new Promise(this.getAnswer.bind(this));
	}
	getAnswer(resolve,reject){
		this.http.onreadystatechange = ()=>{
			if(this.http.readyState === 4 && this.http.status === 200){
				resolve(this.http.responseText);
			}
		}
	}


	createConfirmElement(){
		let div = this.createElement('div','confirm-send-wrap');
		let msg = this.createElement('p','confirm-send-msg');
		msg.innerHTML = this.set.confirm;
		div.appendChild(msg);
		return div;
	}
}
