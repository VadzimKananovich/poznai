class InitSize {
	constructor(shop){
		this.shop = shop;
		this.category = shop.body.category;
		this.getSize();
	}
	getSize(){
		for(let i = 0; i < this.category.length; i++){
			// let it
		}
	}
}
class MenuFunctions {
	constructor() {
	}
	createBlockTitle (title) {
		let div = document.createElement('div');
		div.classList.add('menu-controls-element');
		let p = document.createElement('p');
		p.classList.add('buy-title');
		let txt = document.createTextNode(title);
		p.appendChild(txt);
		div.appendChild(p);
		return div;
	}
}



class InCartElement {
	constructor(){
		this.createElement();
	}
	createElement(){
		let div = document.createElement('div');
		div.className = 'row-in-cart cart-button';
		div.setAttribute('title','Товар в корзине');
		let ico = this.createInCartIco();
		div.appendChild(ico);
		this.title = this.createInCartTitle();
		div.appendChild(this.title);
		this.element = div;
	}
	createInCartTitle(){
		let p = document.createElement('p');
		p.classList.add('cart-title');
		return p;
	}
	createInCartIco(){
		let div = document.createElement('div');
		div.classList.add('buy-cart-ico');
		let i = document.createElement('i');
		i.className = 'fas fa-shopping-cart';
		div.appendChild(i);
		return div;
	}
}




class RowControlsElements {
	constructor (id) {
		this.id = id;
		this.init();
	}
	init(){
		this.createElement();
		this.addToCart();
		this.reduceQuantity();
		this.addQuantity();
		this.controlInput();
	}
	createElement(){
		let wrapper = document.createElement('div');
		wrapper.classList.add('shop-res-control');
		let quantity = this.createQuantity();
		let addButton = this.createAddButton();
		wrapper.appendChild(quantity);
		wrapper.appendChild(addButton);
		this.element = wrapper;
	}
	createQuantity () {
		let quantity = document.createElement('div');
		quantity.classList.add('shop-res-quantity');
		let plus = this.createPlus();
		let minus = this.createMinus();
		let inputQuantity = this.createInputQuantity();
		quantity.appendChild(minus);
		quantity.appendChild(inputQuantity);
		quantity.appendChild(plus);
		return quantity;
	}
	createPlus(){
		let plus = document.createElement('i');
		plus.className = 'fas fa-plus-circle';
		this.plus = plus;
		return plus;
	}
	createMinus(){
		let minus = document.createElement('i');
		minus.className = 'fas fa-minus-circle';
		this.minus = minus;
		return minus;
	}
	createInputQuantity(){
		let inputQuantity = document.createElement('input');
		inputQuantity.setAttribute('type','number');
		inputQuantity.setAttribute('name','count');
		inputQuantity.classList.add('input-quantity');
		this.inputQuantity = inputQuantity;
		return inputQuantity;
	}
	createAddButton () {
		let button = document.createElement('button');
		button.setAttribute('type','button');
		button.classList.add('buy-button');
		button.dataset.id = this.id;
		let contentButton = this.createContentButton();
		button.appendChild(contentButton);
		button.setAttribute('title','Добавить в корзину');
		this.addButton = button;
		return button;
	}
	createContentButton(){
		let contentButton = document.createElement('i');
		contentButton.className = 'fas fa-cart-plus';
		return contentButton;
	}


	controlInput(){
		this.inputQuantity.addEventListener('keydown',(e)=>{
			if(e.keyCode === 189 || e.keyCode === 187 || e.keyCode === 109 || e.keyCode === 107){
				e.preventDefault();
			}
		})
	}
	reduceQuantity(){
		let minus = this.minus;
		let input = this.inputQuantity;
		minus.addEventListener('click', ()=>{
			input.value = input.value === input.step ?
			input.value : Number(input.value) - Number(input.step);
		});
	}
	addQuantity(){
		let plus = this.plus;
		let input = this.inputQuantity;
		plus.addEventListener('click', ()=>{
			input.value = Number(input.value) + Number(input.step);
		});
	}

	addToCart(){
		let button = this.addButton;
		let input = this.inputQuantity;
		button.addEventListener('click',(e)=>{
			e.currentTarget.dispatchEvent(new CustomEvent('cart', {
				bubbles: true,
				cancelable: true,
				detail: {
					'id': button.dataset.id,
					'quantity': input.value
				}
			}));
		});
	}
}
