
class CartElement extends MenuFunctions {
	constructor(){
		super();
		this.createElement();
		this.openedDropDown = false;
	}
	createElement () {
		this.element = this.createWrapper();
		this.button = this.createButtonWrapper();
		let ico = this.createIco();
		this.button.appendChild(ico);
		this.title = this.createTitle();
		this.button.appendChild(this.title);
		this.element.appendChild(this.button);
	}
	createWrapper(){
		let div = document.createElement('div');
		div.classList.add('buy-cart');
		div.classList.add('cart-hide');
		return div;
	}
	createButtonWrapper(){
		let div = document.createElement('div');
		div.classList.add('cart-button');
		return div;
	}
	createIco(){
		let divIco = document.createElement('div');
		divIco.classList.add('buy-cart-ico');
		let i = document.createElement('i');
		i.className = 'fas fa-shopping-cart';
		divIco.appendChild(i);
		return divIco;
	}
	createTitle(){
		let cartTitle = document.createElement('p');
		cartTitle.classList.add('cart-title');
		return cartTitle;
	}
}


class Cart extends CartElement {
	constructor(array){
		super();
		this.array = array;
		this.init();
	}
	init(){
		this.displayQuantity();
		this.result = new CartResult(this.array);
		this.element.appendChild(this.result.element);
		this.changeOnClick();
	}
	displayQuantity(){
		this.quantity = window.localStorage.getItem('cart') ? (JSON.parse(window.localStorage.getItem('cart'))).length : 0;
		this.title.innerHTML = `${this.quantity}`;
	}
	changeOnClick(){
		this.button.addEventListener('click',(e)=>{
			e.preventDefault();
			this.closeOpen();
		})
	}
	closeOpen(){
		if(this.element.classList.contains('cart-hide')){
			this.element.dispatchEvent(new CustomEvent('openedDropDown', {bubbles: true, cancelable: true}));
			this.openedDropDown = true;
			this.element.classList.remove('cart-hide');
		} else {
			this.openedDropDown = false;
			this.element.classList.add('cart-hide');
			this.element.dispatchEvent(new CustomEvent('closeAll', {bubbles: true, cancelable: true}));
		}
	}
}
