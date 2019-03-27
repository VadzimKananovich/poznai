class ValidateForm{
	constructor(form,validate){
		this.form = form;
		this.validate = validate;
		this.init();
	}
	init(){
		this.result = {};
		for(let key in this.validate){
			let input = this.getInput(key);
			switch(this.validate[key]){
				case 'empty':
				this.result[key] = this.checkEmpty(input);
				break;
			}
		}
	}
	getInput(id){
		return this.form.querySelector(`#${id}`);
	}
	checkEmpty(input){
		if(input.value === ''){
			return 'required';
		} else {
			return false;
		}
	}
}



class MailMessages {
	constructor(){
		this.initConfirmMesg();
		this.initErrorMesg();
	}
	initConfirmMesg(){
		this.confirmMsg = {
			'request':'Ваша заявка успешно отправлена, в ближайшее время с вами свяжется наш специалист.',
			'comment':'Благодарим Вас за отзыв.',
			'email':'Ваше сообщение успешно отправлено.'
		}
	}
	initErrorMesg(){
		this.errorMsg = {
			'required':'Это поле обязательно',
			'different':'Поля не совпадают'
		}
	}
	printError(input,msg){
		let div = document.createElement('div');
		div.className = 'alert alert-danger input-error';
		div.innerHTML = this.errorMsg[msg];
		if(input.nextSibling){
			if(input.nextSibling.tagName){
				if(!input.nextSibling.classList.contains('input-error')){
					input.parentNode.insertBefore(div,input.nextSibling);
				}
			} else {
				input.parentNode.insertBefore(div,input.nextSibling);
			}
		} else {
			input.parentNode.appendChild(div);
		}

		if(!input.classList.contains('error')){
			input.classList.add('error');
		}
		this.initHideError(input);
	}
	initHideError(input){
		input.addEventListener('click',(e)=>{
			if(input.classList.contains('error')){
				input.classList.remove('error');
			}
			let msg = e.currentTarget.nextSibling;
			if(msg && msg.tagName){
				if(msg.classList.contains('input-error')){
					msg.parentElement.removeChild(msg);
				}
			}
		})
	}
	confirmSend(msg,input){
		let message = this.confirmSendElement(msg);
		if(!input.parentNode.querySelector('.confirm-send')){
			input.parentNode.appendChild(message);
		}
	}
	confirmSendElement(msg){
		let div = document.createElement('div');
		div.className = 'alert alert-success confirm-send text-center';
		div.setAttribute('style','position: relative;');
		let closeButton = document.createElement('i');
		closeButton.className = 'fas fa-times close-alert';
		div.innerHTML = this.confirmMsg[msg];
		div.appendChild(closeButton);
		this.initCloseButton(closeButton,div);
		return div;
	}
	initCloseButton(btn,div){
		btn.addEventListener('click',(e)=>{
			e.preventDefault();
			e.currentTarget.parentElement.parentElement.removeChild(div);
		})
	}
}




class SendMail{
	constructor(formId,validate,action=false,callback){
		this.form = document.querySelector(`#${formId}`);
		this.action = action ? this.form.action : false;
		this.type = this.form.dataset.type;
		this.message = new MailMessages;
		this.callback = callback ? callback : false;
		this.init(validate);
	}
	init(validate){
		this.getSubmitButton();
		this.submitButton.addEventListener('click',(e)=>{
			e.preventDefault();
			this.getValues();
			this.createDataObject();
			if(validate){
				this.sendValidate(validate);
			} else {
				this.sendRequest();
			}
		})
	}
	getSubmitButton(){
		let buttons = this.form.querySelectorAll('button');
		for(let i = 0; i < buttons.length; i++){
			if(buttons[i].type === 'submit'){
				this.submitButton = buttons[i];
			}
		}
	}
	getValues(){
		this.values = [];
		let inputs = this.form.querySelectorAll('input');
		let textAreas = this.form.querySelectorAll('textarea');
		for(let i = 0; i < inputs.length; i++){
			this.values.push([inputs[i].id,inputs[i].value]);
		}
		for(let i = 0; i < textAreas.length; i++){
			this.values.push([textAreas[i].id,textAreas[i].value]);
		}
	}
	createDataObject(){
		this.dataObject = {};
		for(let i = 0; i < this.values.length; i++){
			this.dataObject[this.values[i][0]] = this.values[i][1];
		}
	}
	sendValidate(validate){
		this.validate = new ValidateForm(this.form,validate);
		let validateObject = this.validate.result;
		let checkError = true;
		for(let key in validateObject){
			let input = this.form.querySelector(`#${key}`);
			if(validateObject[key]){
				this.message.printError(input,validateObject[key]);
				checkError = false;
			}
		}
		if(checkError){
			this.sendRequest();
		}
	}
	sendRequest(){
		if(this.action){
			$.ajax({
				cache: false,
				type: "POST",
				url: this.action,
				processData: true,
				data: this.dataObject,
				success: this.successSend.bind(this)
			});
		} else {
			this.message.confirmSend(this.type,this.submitButton);
			this.callback();
		}
	}
	successSend(res){
		if(res){
			this.message.confirmSend(this.type,this.submitButton);
		}
	}

}
