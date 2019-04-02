class ModalWindow{
	constructor(top = '25'){
		this.top = Number(top);
		this.createModal();
	}
	createModal(){
		this.element = this.createWrapper();
		this.element.style.zIndex = '10001';
		this.container = this.createContainer();
		this.element.appendChild(this.container);
		this.closeOnClick();
	}
	createWrapper(){
		let div = document.createElement('div');
		div.classList.add('modal-wrapper');
		return div;
	}
	createContainer(){
		let div = document.createElement('div');
		div.setAttribute('style','top: -100%;');
		return div;
	}
	showModal(){
		this.state = true;
		this.position = 100;
		this.step = 5;
		this.stepOpacity = 1 / ((this.position - this.top) / this.step);
		this.stepTransform = 30 / ((this.position - this.top) / this.step);
		this.stateOpacity = 0;
		this.stateTransform = 30;
		this.stepScale = 0.5 / ((this.position - this.top) / this.step);
		this.stateScale = 0.5;
		window.requestAnimationFrame(this.animateModal.bind(this));
	}
	animateModal(){
		if(this.position > this.top){
			let nextStepTop = this.position - this.step < 0 ? this.step - this.position : this.step;
			this.position -= nextStepTop;
			this.stateOpacity += this.stepOpacity;
			this.stateTransform -= this.stepTransform;
			this.stateScale += this.stepScale;
			this.container.setAttribute('style',`top:-${this.position}%; opacity:${this.stateOpacity}; transform: perspective(500px) rotateX(${this.stateTransform}deg) scale(${this.stateScale});`);
			window.requestAnimationFrame(this.animateModal.bind(this));
		}
	}
	closeOnClick(){
		this.element.addEventListener('click',(e)=>{
			if(e.target === e.currentTarget){
				this.state = false;
				this.closeModal();
			}
		})
	}
	closeModal(){
		this.state = false;
		this.element.parentElement.removeChild(this.element);
	}
	createButton(txt,className){
		let button = document.createElement('button');
		button.className = className;
		button.innerHTML = txt;
		return button;
	}
	doNotShowAgain(){
		let wrapper = document.createElement('div');
		wrapper.classList.add('modal-checkbox');
		let div = document.createElement('div');
		div.className = 'box_1';
		let input = document.createElement('input');
		input.classList.add('switch_1');
		input.setAttribute('type','checkbox');
		div.appendChild(input);
		wrapper.appendChild(div);
		this.checkbox = input;
		let label = document.createElement('p');
		label.classList.add('label-hide');
		let txt = document.createTextNode('Больше не показывать');
		label.appendChild(txt);
		wrapper.appendChild(label);
		this.checkState = false;
		this.checkIfClick();
		return wrapper;
	}
	checkIfClick(){
		this.checkbox.addEventListener('click',(e)=>{
			if(!this.checkState){
				this.checkState = true;
			} else {
				this.checkState = false;
			}
		})
	}
}



class MsgAlert {
	constructor(shop){
		this.shop = shop;
		this.modal = new ModalWindow;
		this.init();
	}
	init(){
		this.shop.element.addEventListener('msgAlert',(e)=>{
			let type = e.detail.type;
			let msg = e.detail.msg;
			if(!this.controlExistHideModal(type) || type === 'confirmRemove'){
				switch(type){
					case 'addToCart':
					this.createAddToCart(msg,false,type);
					this.displayMsg();
					break;
					case 'changeCartQuantity':
					this.createAddToCart(msg,true,type);
					this.displayMsg();
					break;
					case 'error':
					this.createErrorMsg(msg,type);
					this.displayMsg();
					break;
					case 'confirmRemove':
					if(!this.controlExistHideModal('confirmRemove')){
						this.createConfirmRemove(msg,type);
						this.displayMsg();
					} else {
						msg.dispatchEvent(new CustomEvent('removeProduct', {bubbles: true, cancelable: true, detail: msg.dataset.id}));
					}
					break;
				}
			}
		})
	}
	createAddToCart(msg,existItem,type){
		let addToCartModal = new AddToCartModal(msg,existItem);
		this.modal.container.innerHTML = '';
		this.modal.container.className = 'modal-window confirm-modal';
		this.modal.container.appendChild(addToCartModal.element);
		this.modal.container.appendChild(this.createOkButton(type));
		this.modal.container.appendChild(this.modal.doNotShowAgain());
	}
	createConfirmRemove(element,type){
		let p = document.createElement('p');
		p.classList.add('modal-confirm-content');
		let txt = document.createTextNode('Убрать из корзины?');
		p.appendChild(txt);
		this.modal.container.innerHTML = '';
		this.modal.container.className = 'modal-window warning-modal';
		this.modal.container.appendChild(p);
		let buttonsContainer = document.createElement('div');
		buttonsContainer.classList.add('modal-buttons-container');
		this.modal.container.appendChild(this.modal.doNotShowAgain());
		buttonsContainer.appendChild(this.createCancelButton(type));
		buttonsContainer.appendChild(this.createConfirmButton(element,type));
		this.modal.container.appendChild(buttonsContainer);
	}
	createErrorMsg(msg,type){
		let p = document.createElement('p');
		p.classList.add('modal-danger-content');
		let txt = document.createTextNode(msg);
		p.appendChild(txt);
		this.modal.container.innerHTML = '';
		this.modal.container.className = 'modal-window danger-modal';
		this.modal.container.appendChild(p);
		// this.modal.container.appendChild(this.modal.doNotShowAgain());
		this.modal.container.appendChild(this.createDangerButton(type));
	}
	displayMsg(){
		this.shop.element.appendChild(this.modal.element);
		this.modal.showModal();
	}
	createDangerButton(type){
		let button = this.modal.createButton('ЗАКРЫТЬ','modal-button danger-btn');
		button.addEventListener('click',(e)=>{
			e.preventDefault();
			this.controlHideModal(type);
			this.modal.closeModal();
		});
		return button;
	}
	createCancelButton(type){
		let button = this.modal.createButton('НЕТ','modal-button cancel-btn');
		button.addEventListener('click',(e)=>{
			e.preventDefault();
			this.controlHideModal(type);
			this.modal.closeModal();
		})
		return button;
	}
	createConfirmButton(element,type){
		let button = this.modal.createButton('ДА','modal-button success-btn');
		button.addEventListener('click',(e)=>{
			e.preventDefault();
			this.controlHideModal(type);
			this.modal.closeModal();
			element.dispatchEvent(new CustomEvent('removeProduct', {bubbles: true, cancelable: true, detail: element.dataset.id}));
		})
		return button;
	}
	createOkButton(type){
		let button = this.modal.createButton('ОК','modal-button success-btn');
		button.addEventListener('click',(e)=>{
			e.preventDefault();
			this.controlHideModal(type);
			this.modal.closeModal();
		})
		return button;
	}
	controlExistHideModal(type){
		let localHideModal = JSON.parse(window.sessionStorage.getItem('hideModal'));
		if(localHideModal){
			if(localHideModal.indexOf(type) > -1){
				return true;
			} else {
				return false;
			}
		}
		return false;
	}
	controlHideModal(type){
		if(this.modal.checkState){
			let hideModal = JSON.parse(window.sessionStorage.getItem('hideModal')) ? JSON.parse(window.sessionStorage.getItem('hideModal')) : [];
			if(hideModal.indexOf(type) === -1){
				hideModal.push(type);
				window.sessionStorage.setItem('hideModal', JSON.stringify(hideModal));
			}
		}
	}
}





class AddToCartModal {
	constructor(item,existItem){
		this.item = item;
		this.createElement(existItem);
	}
	createElement(existItem){
		let div = document.createElement('div');
		div.classList.add('cart-modal');
		div.appendChild(this.createTitle());
		div.appendChild(this.createMsg(existItem));
		div.appendChild(this.createQuantity());
		this.element = div;
	}
	createTitle(){
		let p = document.createElement('p');
		p.classList.add('cart-modal-title');
		let txt = document.createTextNode(this.item.name);
		p.appendChild(txt);
		return p;
	}
	createMsg(existItem){
		let p = document.createElement('p');
		p.classList.add('cart-modal-content');
		let txtMsg = existItem ? 'Изменен' : 'Добавлен в корзину';
		let txt = document.createTextNode(txtMsg);
		p.appendChild(txt);
		return p;
	}
	createQuantity(){
		let p = document.createElement('p');
		p.classList.add('cart-final-quantity');
		let txt = document.createTextNode(this.item.quantity);
		p.appendChild(txt);
		let afterP = document.createTextNode('шт');
		p.appendChild(afterP);
		return p;
	}
}






class ViewProductModal{
	constructor(object){
		this.object = object;
		this.createElement();
	}
	createElement(){
		this.element = this.createWrapper();
		this.element.appendChild(this.createImg());
		this.element.appendChild(this.createContent());
	}
	createWrapper(){
		let div = document.createElement('div');
		div.classList.add('preview-wrapper');
		return div;
	}
	createContent(){
		let div = document.createElement('div');
		div.classList.add('shop-content-wrap');
		div.appendChild(this.createTitle());
		div.appendChild(this.createFinalyPrice());
		div.appendChild(this.createDesc());
		this.controls = new RowControlsElements(this.object.id);
		this.initControls();
		div.appendChild(this.controls.element);
		return div;
	}
	initControls(){
		this.controls.inputQuantity.setAttribute('min',this.object.minItem);
		this.controls.inputQuantity.setAttribute('max',this.object.maxItem);
		this.controls.inputQuantity.setAttribute('step',this.object.minItem);
		this.controls.inputQuantity.setAttribute('value',this.object.quantity);
	}
	createDesc(){
		let p = document.createElement('p');
		p.classList.add('shop-res-desc');
		let txt = document.createTextNode(this.object.description);
		p.appendChild(txt);
		return p;
	}
	createFinalyPrice(){
		let p = document.createElement('p');
		p.classList.add('shop-res-finaly');
		p.appendChild(this.createResPrice());
		p.appendChild(this.createResCurrency());
		return p;
	}
	createResPrice(){
		let span = document.createElement('span');
		span.classList.add('shop-res-price')
		let txt = document.createTextNode(this.object.price);
		span.appendChild(txt);
		return span;
	}
	createResCurrency(){
		let span = document.createElement('span');
		span.classList.add('shop-res-currency');
		let txt = document.createTextNode(this.object.currency);
		span.appendChild(txt);
		return span;
	}
	createTitle(){
		let title = document.createElement('h4');
		title.classList.add('shop-res-title');
		let txt = document.createTextNode(this.object.name);
		title.appendChild(txt);
		return title;
	}
	createImg(){
		let div = document.createElement('div');
		div.classList.add('shop-img-container');
		let img = document.createElement('img');
		img.setAttribute('src',this.object.img);
		div.appendChild(img);
		return div;
	}
}

class ViewProduct {
	constructor(shop){
		this.shop = shop;
		this.init();
	}
	init(){
		this.shop.element.addEventListener('openProduct',(e)=>{
			e.preventDefault();
			this.id = e.detail;
			this.object = this.searchObject();
			this.object.quantity = this.getQuantity();
			this.modal = new ModalWindow;
			this.modalContent = new ViewProductModal(this.object);
			this.insertContent();
			this.displayModal();
		})
	}
	getQuantity(){
		let localCart = JSON.parse(window.localStorage.getItem('cart'));
		for(let i = 0; i< localCart.length; i++){
			if(this.id === localCart[i].id){
				return localCart[i].quantity;
			}
		}
	}
	searchObject(){
		for(let i = 0; i < this.shop.allProducts.length; i++){
			if(this.shop.allProducts[i].id === this.id){
				return this.shop.allProducts[i];
			}
		}
	}
	insertContent(){
		this.modal.container.innerHTML = '';
		this.modal.container.className = 'modal-window view-product';
		this.modal.container.appendChild(this.modalContent.element);
	}
	displayModal(){
		this.shop.element.appendChild(this.modal.element);
		this.modal.showModal();
	}
}


class CompleteOrderForm {
	constructor(shop){
		this.shop = shop;
		this.createElement();
	}
	createElement(){
		this.element = this.createWrapper();
		this.element.appendChild(this.createForm());
	}
	createWrapper(){
		let div = document.createElement('div');
		div.classList.add('modal-complete-wrapper');
		return div;
	}
	createForm(){
		let container = document.createElement('form');
		container.classList.add('modal-form-complete');

		let nameRow = this.createRow();
		this.nameInput = this.createInput('Имя','completeName','text','Ваше имя');
		let nameLabel = this.createLabel('Имя:','completeName');
		nameRow.appendChild(nameLabel);
		nameRow.appendChild(this.nameInput);

		let emailRow = this.createRow();
		this.emailInput = this.createInput('Email','completeEmail','email','Ваш email');
		let emailLabel = this.createLabel('Email:','completeEmail');
		emailRow.appendChild(emailLabel);
		emailRow.appendChild(this.emailInput);

		let telRow = this.createRow();
		this.telInput = this.createInput('Телефон','completeTel','text','+375 ');
		let telLabel = this.createLabel('Телефон:','completeTel');
		telRow.appendChild(telLabel);
		telRow.appendChild(this.telInput);

		container.appendChild(nameRow);
		container.appendChild(emailRow);
		container.appendChild(telRow);

		container.appendChild(this.createButtons());
		return container;
	}

	createRow(){
		let div = document.createElement('div');
		div.classList.add('modal-row');
		return div;
	}
	createInput(name,id,type,placeholder){
		let input = document.createElement('input');
		input.classList.add('modal-input');
		input.setAttribute('id',id);
		input.setAttribute('name',id);
		input.setAttribute('type',type);
		input.setAttribute('placeholder',placeholder);
		return input;
	}
	createLabel(name,id){
		let label = document.createElement('label');
		label.classList.add('modal-label');
		label.setAttribute('for',id);
		label.innerHTML = name;
		return label;
	}
	createButtons(){
		let div = document.createElement('div');
		div.classList.add('complete-wrap-btn');
		this.confirmButton = this.createButton('заказать','confirm-order-btn success-btn');
		this.cancelButton = this.createButton('отмена','cancel-order-btn danger-btn');
		div.appendChild(this.confirmButton);
		div.appendChild(this.cancelButton);
		return div;
	}
	createButton(txt,className){
		let button = document.createElement('button');
		button.setAttribute('type','button');
		button.className = className;
		button.innerHTML = txt;
		return button;
	}
}


class CompleteOrderCart{
	constructor(shop){
		this.shop = shop;
		this.createElement();
	}
	createElement(){
		this.element = document.createElement('div');
		this.element.classList.add('modal-complete-cart');
		this.createTitle();
		this.createContent();
	}
	createTitle(){
		let p = document.createElement('p');
		p.classList.add('modal-cart-title');
		this.element.appendChild(p);
	}
	createContent(){
		this.totalQuantity = 0;
		this.totalPrice = 0;
		this.currency = false;
		let container = document.createElement('div');
		container.classList.add('modal-cart-container');
		let cartContent = this.shop.menu.cart.result.resItems;
		for(let i = 0; i < cartContent.length; i++){
			let row = new RowResult(cartContent[i].id);
			this.totalQuantity += 1;
			if(!this.currency){
				this.currency = cartContent[i].currency;
			}
			this.initControls(cartContent[i],row);
			this.openProduct(row);
			this.removeProduct(row);
			container.appendChild(row.element);
		}
		this.element.appendChild(this.createResPrice());
		this.element.appendChild(container);
	}
	createResPrice(){
		let p = document.createElement('p');
		p.classList.add('total-payment');
		let txt = document.createTextNode('Всего: ');
		let totalQuantity = document.createElement('span');
		totalQuantity.classList.add('total-quantity');
		totalQuantity.innerHTML = this.totalQuantity;
		let txtAfter = document.createTextNode(' шт. На сумму:');
		let totalPrice = document.createElement('span');
		totalPrice.classList.add('shop-res-price');
		totalPrice.innerHTML = this.totalPrice;
		let totalCurrency = document.createElement('span');
		totalCurrency.innerHTML = this.currency;
		p.appendChild(txt);
		p.appendChild(totalQuantity);
		p.appendChild(txtAfter);
		p.appendChild(totalPrice);
		p.appendChild(totalCurrency);
		return p;
	}
	initControls(object, row){
		row.control.inputQuantity.setAttribute('value',object.quantity);
		row.control.inputQuantity.setAttribute('min',object.minItem);
		row.control.inputQuantity.setAttribute('max',object.maxItem);
		row.control.inputQuantity.setAttribute('step',object.minItem);
		row.finalCurrency.innerHTML = object.currency;
		let resPrice = Number(object.price) * Number(object.quantity);
		this.totalPrice += resPrice;
		row.finalPrice.innerHTML = resPrice;
		row.finalQuantity.innerHTML = object.quantity;
		row.title.innerHTML = object.name;
		row.img.setAttribute('src',object.img);
	}
	clearContent(){
		this.element.innerHTML = '';
	}
	openProduct(row){
		row.openPruductButton.addEventListener('click',(e)=>{
			e.preventDefault();
			e.currentTarget.dispatchEvent(new CustomEvent('openProduct', {bubbles: true, cancelable: true, detail: e.currentTarget.dataset.id}));
		})
	}
	removeProduct(row){
		row.deleteButton.addEventListener('click',(e)=>{
			e.preventDefault();
			e.currentTarget.dispatchEvent(new CustomEvent('msgAlert',
			{ bubbles: true,
				cancelable: true,
				detail: {
					'type':'confirmRemove',
					'msg': e.currentTarget}
				}));
			})
		}
		refreshResult(){

			this.clearContent();
			this.createTitle();
			this.createContent();
		}
	}
