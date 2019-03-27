class Contact{
	constructor(set){
		this.initSet(set);
		this.http = new XMLHttpRequest();
		this.init();
	}
	initSet(set){
		this.url = set.url;
		this.container = document.querySelector(set.container);
		this.input = [];
		set.input.forEach(item => this.input.push(this.container.querySelector('#'+item)));
		this.sendBtn = this.container.querySelector(set.submit);
	}
	init(){
		this.sendBtn.addEventListener('click',(e)=>{
			if(this.checkInput()){
				this.confirmSendMsg();
				this.sendRequest();
			}
		});
	}
	checkInput(){
		let checkError = true;
		this.input.forEach(item=>{
			if(item.value === '') {
				this.errorMsg(item);
				checkError = false;
			}
		});
		return checkError;
	}


	errorMsg(item){
		item.classList.add('error-msg');
		$(item).popover({
			'animation':true,
			'title':'Ошибка',
			'content':'Заполните это поле',
			'template':'<div class="popover error" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
		});
		$(item).popover('show');
		this.removeError(item);
	}

	removeError(item){
		item.addEventListener('keydown',(e)=>{
			if(item.classList.contains('error-msg')){
				item.classList.remove('error-msg');
			}
			$(item).popover('dispose');
		});
	}

	confirmSendMsg(){
		this.container.classList.add('form-confirm');
		$(this.container).popover({
			'animation':true,
			'title':'Ваше сообщение отправлено',
			'content':'В ближайшее время с вами свяжется наш специалист',
			'placement' : 'bottom',
			'template':'<div class="popover confirm-send" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
		});
		$(this.container).popover('show');
		setTimeout(()=>{
			$(this.container).popover('dispose');
			this.container.classList.remove('form-confirm');
		},5000);
	}
	sendRequest(){
		let values = {};
		this.input.forEach(item=>values[item.id] = item.value);
		let url = 'includes/request.php?action=send_mail';
		let dates = 'dates='+JSON.stringify(values);
		this.http.open("POST",url);
		this.http.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		this.http.send(dates);
	}
}
