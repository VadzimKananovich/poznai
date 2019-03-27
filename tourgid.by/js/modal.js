class Modal {

	constructor(set){
		this.inAnimate = false;
		this.init(set);
	}

	init(set){
		this.initDefaultSet();
		this.initPassedSet(set);
		this.getElements();
		this.createObject();
	}

	initDefaultSet(){
		this.set = {
			'button':false,
			'modal':false,
			'from':'right',
			'width':'800px',
			'btnClass':'open-modal',
			'closeClass':'close-modal',
			'transition': '.3',
			'timingFunction':'ease-in-out',

			'beforeOpenEvent':false,
			'beforeCloseEvent':false,
			'beforeOpenFun': false,
			'beforeCloseFun': false,

			'afterOpenEvent':false,
			'afterCloseEvent':false,
			'afterOpenFun': false,
			'afterCloseFun': false,
		}
	}

	initPassedSet(set){
		for(let key in set){
			this.set[key] = set[key];
		}
	}

	getElements() {
		if(!this.set.button) {
			this.btn = document.querySelectorAll('.'+this.set.btnClass);
		} else {
			if(this.set.button.constructor === String) {
				this.btn = document.querySelectorAll(this.set.button);
			} else {
				this.btn = this.set.button;
			}
		}
	}

	createObject(){
		this.modals = {};
		this.btn.forEach(item=>{
			let modal;
			let modalKey;
			if(item.dataset.target && !this.set.modal){
				modalKey = item.dataset.target;
				modal = document.querySelector(modalKey);
			} else if (this.set.modal){
				if(this.set.modal.constructor === String){
					modalKey = this.set.modal;
					modal = document.querySelector(modalKey);
				} else {
					modalKey = '#'+modal.id;
					modal = this.set.modal;
				}
			}
			if(!this.modals[modalKey]){
				let body = modal.querySelector('.modal-container');
				let close = modal.querySelectorAll('.'+this.set.closeClass);
				this.modals[modalKey] = {
					'modal': modal,
					'body': body,
					'close':close
				};
			}
			if(!this.modals[modalKey].btn) {
				this.modals[modalKey].btn = [];
			}
			this.modals[modalKey].btn.push(item);
	});
	this.initModal();
}


initModal(){
	for(let key in this.modals){
		let modal = this.modals[key];
		modal.btn.forEach(item=>{
			item.addEventListener('click',this.initOpenBtn.bind(this,modal));
		});
		modal.close.forEach(item=>{
			item.addEventListener('click',this.initClose.bind(this,modal));
		});
		modal.modal.addEventListener('click',this.initClose.bind(this,modal));
	}
}

initOpenBtn(modal,e) {
	if(!this.inAnimate){
		this.inAnimate = true;
		if(this.set.beforeOpenFun){
			this.set.beforeOpenFun();
		}
		if(this.set.beforeOpenEvent){
			let event = new Event(this.set.beforeOpenEvent);
			modal.body.dispatchEvent(event);
		}
		this.setStartStyle(modal);
		setTimeout(this.animateOpen.bind(this,modal),100);
	}
}

initClose(modal,e) {
	if(e.currentTarget === e.target){
		if(!this.inAnimate){
			this.inAnimate = true;
			if(this.set.beforeCloseFun){
				this.set.beforeCloseFun();
			}
			if(this.set.beforeCloseEvent){
				let event = new Event(this.set.beforeCloseEvent);
				modal.body.dispatchEvent(event);
			}
			this.animateClose(modal);
		}
	}
}

setStartStyle(modal){
	let bg = modal.modal;
	let modalBody = modal.body;
	let transition = this.set.transition+'s';
	let bodyWidth = this.set.width;
	bg.setAttribute('style',`display:none; opacity:0; transition:${transition};`);
	modalBody.style.opacity = '0';
	modalBody.style.transition = transition+' '+this.set.timingFunction;
	modalBody.style.width = bodyWidth;
	document.body.style.overflow = 'hidden';
	switch(this.set.from){
		case 'top':
		modalBody.style.transform = 'translateY(-100vh)';
		break;
		case 'right':
		modalBody.style.transform = 'translateX(100vw)';
		break;
		case 'bottom':
		modalBody.style.transform = 'translateY(100vh)';
		break;
		case 'left':
		modalBody.style.transform = 'translateX(-100vw)';
		break;
	}
}

animateOpen(modal){
	let bg = modal.modal;
	let body = modal.body;
	let delay = Number(this.set.transition) * 1000;
	bg.style.display = 'block';
	setTimeout(()=>{
		bg.style.opacity = '1';
		body.style.opacity = '1';
		body.style.transform = 'translate(0)';
	},100);
	setTimeout(()=>{
		if(this.set.afterOpenEvent){
			let event = new Event(this.set.afterOpenEvent);
			body.dispatchEvent(event);
		}
		if(this.set.afterOpenFun){
			this.set.afterOpenFun();
		}
		this.inAnimate = false;
	},delay);
}

animateClose(modal){
	let bg = modal.modal;
	let body = modal.body;
	let delay = Number(this.set.transition) * 1000;
	bg.style.opacity = '0';
	body.style.opacity = '0';
	switch(this.set.from){
		case 'top':
		body.style.transform = 'translateY(-100%)';
		break;
		case 'right':
		body.style.transform = 'translateX(100%)';
		break;
		case 'bottom':
		body.style.transform = 'translateY(100%)';
		break;
		case 'left':
		body.style.transform = 'translateX(-100%)';
		break;
	}
	setTimeout(()=>{
		bg.style.display = 'none';
		document.body.style.overflow = 'auto';
		if(this.set.afterCloseEvent){
			let event = new Event(this.set.afterCloseEvent);
			body.dispatchEvent(event);
		}
		if(this.set.afterCloseFun){
			this.set.afterCloseFun();
		}
		this.inAnimate = false;
	},delay);
}

}
