class Modal{
	constructor(btnFun){
		this.formElements = new FormElements;
		this.buttons = new Buttons;
		this.init();
	}

	alert(msg){
		return this.createModal({
			'id':'alert',
			'size': '',
			'title': '',
			'formClass': 'alert-modal',
			'text': msg,
			'confirmBtn':true
		});
	}
	confirmDel(){
		return this.createModal({
			'id':'confirmDel',
			'size': '',
			'title': 'Подтвердите действие',
			'formClass': 'set-single-img input-100',
			'text': 'Удалить запись?',
			'confirmBtn':true,
			'closeBtn': true
		});
	}
	normalModal(){
		return this.createModal({
			'id':'setSliderModal',
			'size': 'modal-xl',
			'title': 'Сменить картинку',
			'saveBtn':true,
			'closeBtn': true
		});
	}
	init(){
		this.singleImg = this.createModal({
			'id':'setSingleImg',
			'size': 'modal-lg',
			'title': 'Сменить картинку',
			'formClass': 'set-single-img input-100',
			'closeBtn':true,
			'submitBtn':true
		});

		this.confirm = this.createModal({
			'id':'confirmModal',
			'size': '',
			'title': 'Подтвердите действие',
			'text':'Удалить запись?',
			'formClass': 'set-single-img input-100',
			'closeBtn':true,
			'submitBtn':true
		});
		this.singleInput = this.createModal({
			'id': 'singleInputModal',
			'size':'',
			'title':'Введите значение',
			'formClass': 'set-single-input input-100',
			'closeBtn':true,
			'submitBtn':true
		});
	}


	// ===========================================================================
	//                                 CREATE MODAL Single Image
	// ===========================================================================
	createModal(set){
		let modal = document.createElement('div');
		modal.className = 'modal fade';
		modal.tabindex = '-1';
		modal.role = 'dialog';
		modal.id = set.id;
		modal.appendChild(this.createDialog(set));
		return modal;
	}
	createDialog(set){
		let dialog = document.createElement('div');
		dialog.className = 'modal-dialog '+set.size;
		dialog.role = 'document';
		dialog.appendChild(this.createContent(set));
		return dialog;
	}
	createContent(set){
		let content = document.createElement('div');
		content.className = 'modal-content';
		content.appendChild(this.createModalHead(set));
		if(set.id === 'setSingleImg' || set.id === 'singleInputModal' || set.id === 'confirmModal') {
			content.appendChild(this.createForm(set));
		} else {
			content.appendChild(this.createModalBody(set));
			content.appendChild(this.createModalFooter(set));
		}
		return content;
	}
	createModalHead(set){
		let head = document.createElement('div');
		head.className = 'modal-header';
		let title = document.createElement('h5');
		title.className = 'modal-title';
		title.appendChild(document.createTextNode(set.title));
		head.appendChild(title);
		head.appendChild(this.createCloseModal());
		return head;
	}
	createCloseModal(){
		let btn = document.createElement('button');
		btn.className = 'close';
		btn.type = 'button';
		btn.dataset.dismiss = 'modal';
		btn.setAttribute('aria-label','Close');
		let span = document.createElement('span');
		span.setAttribute('aria-hidden','true');
		span.innerHTML = '&times;';
		btn.appendChild(span);
		return btn;
	}
	createForm(set){
		let form = document.createElement('form');
		form.method = 'post';
		form.className = set.formClass;
		form.enctype = 'multipart/form-data';
		form.appendChild(this.createModalBody(set));
		form.appendChild(this.createModalFooter(set));
		return form;
	}
	createModalBody(set){
		let body = document.createElement('div');
		body.className = 'modal-body';
		if(set.id === 'setSingleImg'){
			body.appendChild(this.formElements.createFormGroup({
				'label':'Загрузите картинку:',
				'type':'file',
				'id':'imgFile',
				'small-text':'Максимальный размер 200kb',
				'required': true
			}));
			body.appendChild(this.formElements.createFormGroup({
				'type':'hidden',
				'id':'arrayId'
			}));
		}
		if(set.id === 'singleInputModal'){
			body.appendChild(this.formElements.createFormGroup({
				'label':'',
				'type':'text',
				'id':'singleModalInput',
				'small-text':''
			}));
			body.appendChild(this.formElements.createFormGroup({
				'type':'hidden',
				'id':'singleModalInputId'
			}));
		}
		if(set.id === 'confirmModal' || set.id === 'confirmDel' || set.id === 'alert') {
			let p = document.createElement('p');
			p.className = 'modal-content-txt';
			p.appendChild(document.createTextNode(set.text));
			body.appendChild(p);
		}
		return body;
	}
	createModalFooter(set){
		let foot = document.createElement('div');
		foot.className = 'modal-footer';
		if(set.submitBtn){
			foot.appendChild(this.buttons.submitBtn({'type':'submit'}));
		}
		if(set.delBtn){
			foot.appendChild(this.buttons.delBtn({'class':'confirm-del','onclick':set.onclick}));
		}
		if(set.saveBtn){
			foot.appendChild(this.buttons.saveBtn({'dataset':{}}));
		}
		if(set.closeBtn){
			foot.appendChild(this.buttons.closeBtn({'dataset':{'dismiss':'modal'}}));
		}
		if(set.confirmBtn){
			foot.appendChild(this.buttons.confirmBtn({'dataset':{'dismiss':'modal'}}));
		}
		return foot;
	}

}
