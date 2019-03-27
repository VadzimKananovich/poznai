class DomCartResult{
	constructor(){
		this.createElement;
	}
	createElement(){
		let divRes = document.createElement('div');
		divRes.classList.add('buy-cart-result');
		this.resContainer = document.createElement('div');
		this.resContainer.classList.add('cart-result-container');
		this.resContainer.classList.add('menu-dropdown-container');
		divRes.appendChild(this.resContainer);
		this.element = divRes;
	}

}

class RowResult {
	constructor(idItem){
		this.idItem = idItem;
		this.createElement();
	}
	createElement() {
		let div = document.createElement('div');
		div.classList.add('cart-row');
		let imgContainer = this.createRowImg();
		div.appendChild(imgContainer);
		let contentContainer = this.createContentContainer();
		div.appendChild(contentContainer);
		this.element = div;
	}
	createRowImg(){
		let imgContainer = document.createElement('div');
		imgContainer.classList.add('cart-img-container');
		let img = document.createElement('img');
		imgContainer.appendChild(img);
		this.img = img;
		return imgContainer;
	}
	createContentContainer(){
		let resContainer = document.createElement('div');
		resContainer.classList.add('cart-res-container');
		this.title = this.createRowTitle();
		let totalContainer = this.createTotalContainer();
		this.control =  new RowControlsElements(this.idItem);
		this.control.addButton.dataset.type = 'menu';
		resContainer.appendChild(this.title);
		resContainer.appendChild(totalContainer);
		resContainer.appendChild(this.control.element);
		let controlButtons = this.createControlButtons();
		resContainer.appendChild(controlButtons);
		return resContainer;
	}
	createControlButtons(){
		let div = document.createElement('div');
		div.classList.add('top-controls-buttons');
		this.deleteButton = this.createDeleteButton();
		this.openPruductButton = this.createOpenButton();
		div.appendChild(this.openPruductButton);
		div.appendChild(this.deleteButton);
		return div;
	}
	createDeleteButton(){
		let div = document.createElement('div');
		div.classList.add('delete-button');
		div.setAttribute('title','удалить');
		div.dataset.id = this.idItem;
		let i = document.createElement('i');
		i.className = 'fas fa-trash-alt';
		div.appendChild(i);
		return div;
	}
	createOpenButton(){
		let div = document.createElement('div');
		div.classList.add('open-button');
		div.setAttribute('title','открыть');
		div.dataset.id = this.idItem;
		let i = document.createElement('i');
		i.className = 'far fa-eye';
		div.appendChild(i);
		return div;
	}
	createRowTitle(){
		let title = document.createElement('p');
		title.classList.add('cart-res-title');
		return title;
	}


	createTotalContainer(){
		let div = document.createElement('div');
		div.classList.add('cart-total-container');
		let totalQuantity = this.createFinalQuantityContainer();
		let finalPriceContainer = this.createFinalPriceContainer();
		div.appendChild(totalQuantity);
		div.appendChild(finalPriceContainer);
		return div;
	}


	createFinalPriceContainer(){
		let p = document.createElement('p');
		p.classList.add('cart-final-price');
		let beforeP = document.createTextNode('Сумма:');
		this.finalPrice = this.createFinalPrice();
		this.finalCurrency = this.createFinalCurrency();
		p.appendChild(beforeP);
		p.appendChild(this.finalPrice);
		p.appendChild(this.finalCurrency);
		return p;
	}
	createFinalPrice(){
		let finalPrice = document.createElement('span');
		finalPrice.classList.add('final-price');
		return finalPrice;
	}
	createFinalCurrency(){
		let finalCurrency = document.createElement('span');
		finalCurrency.classList.add('final-currency');
		return finalCurrency;
	}

	createFinalQuantityContainer(){
		let p = document.createElement('p');
		p.classList.add('cart-final-quantity');
		this.finalQuantity = this.createFinalQuantity();
		let afterQuantity = document.createTextNode('шт.');
		p.appendChild(this.finalQuantity);
		p.appendChild(afterQuantity);
		return p;
	}
	createFinalQuantity(){
		let finalQuantity = document.createElement('span');
		finalQuantity.classList.add('final-quantity');
		return finalQuantity;
	}
}




class CartResult extends DomCartResult{
	constructor(array){
		super();
		this.products = array;
		this.createElement();
		this.init();
	}
	init(){
		if(window.localStorage.getItem('cart')){
			this.createResProductsArray();
			this.createDomResult();
			this.appendRows();
			this.fixCompliteOrder();
			this.completeOrder();
			this.removeAll();
		} else {
			this.createEmptyCart();
		}
	}
	completeOrder(){
		this.completeButton.addEventListener('click',(e)=>{
			e.preventDefault();
			this.completeButton.dispatchEvent(new CustomEvent('completeOrder', {bubbles: true, cancelable: true}));
		})
	}
	removeAll(){
		this.removeAllButton.addEventListener('click',(e)=>{
			e.preventDefault();
			this.removeAllButton.dispatchEvent(new CustomEvent('removeAll', {bubbles: true, cancelable: true}));
		})
	}

	createEmptyCart(){
		let p = document.createElement('p');
		p.classList.add('empty-cart');
		let txtP = document.createTextNode('Нет товаров в корзине');
		p.appendChild(txtP);
		this.resContainer.appendChild(p);
	}
	createResProductsArray(){
		this.resItems = [];
		let cartItems = JSON.parse(window.localStorage.getItem('cart'));
		for(let i = 0; i < cartItems.length; i++){
			let checkItem = cartItems[i];
			for(let j = 0; j < this.products.length; j++){
				if(checkItem.id === this.products[j].id){
					this.products[j].quantity = checkItem.quantity;
					this.resItems.push(this.products[j]);
				}
			}
		}
	}
	createDomResult(){
		this.resItemsDom = [];
		this.totalPrice = 0;
		this.currency = 0;
		for(let i = 0; i < this.resItems.length; i++){

			this.resItemsDom[i] = new RowResult(this.resItems[i].id);
			let domRow = this.resItemsDom[i];
			this.insertControlsDates(domRow,this.resItems[i]);

			let txtTitle = document.createTextNode(this.resItems[i].name);
			domRow.title.appendChild(txtTitle);

			domRow.img.setAttribute('src',this.resItems[i].img);

			let price = Number(this.resItems[i].price) * Number(this.resItems[i].quantity);
			this.totalPrice += price;
			let txtPrice = document.createTextNode(price);
			domRow.finalPrice.appendChild(txtPrice);

			let txtCurrency = document.createTextNode(this.resItems[i].currency);
			domRow.finalCurrency.appendChild(txtCurrency);

			let txtQuantity = document.createTextNode(this.resItems[i].quantity);
			domRow.finalQuantity.appendChild(txtQuantity);

			if(!this.currency){
				this.currency = this.resItems[i].currency;
			}
			this.openProduct(domRow);
			this.removeProduct(domRow);
		}
	}
	insertControlsDates(row,item){
		row.control.inputQuantity.setAttribute('min',item.minItem);
		row.control.inputQuantity.setAttribute('max',item.maxItem);
		row.control.inputQuantity.setAttribute('step',item.minItem);
		row.control.inputQuantity.setAttribute('value',item.quantity);
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
	clearContent(){
		this.resContainer.innerHTML = '';
	}
	appendRows(){
		for(let i = 0; i < this.resItemsDom.length; i++){
			this.resContainer.appendChild(this.resItemsDom[i].element);
		}
		this.completeOrderElement = this.createCompleteOrdere();
		this.resContainer.appendChild(this.completeOrderElement);
	}
	createCompleteOrdere (){
		let div = document.createElement('div');
		div.classList.add('complete-order');
		let buttonsContainer = document.createElement('div');
		buttonsContainer.classList.add('complete-buttons-container');
		this.completeButton = this.createCompleteButton('заказать','complete-button success-btn');
		this.removeAllButton = this.createCompleteButton('Очистить','clear-button danger-btn')
		buttonsContainer.appendChild(this.completeButton);
		buttonsContainer.appendChild(this.removeAllButton);
		div.appendChild(this.createTotalPayment());
		div.appendChild(buttonsContainer);
		return div;
	}
	createCompleteButton(text, className) {
		let button = document.createElement('button');
		let txtButton = document.createTextNode(text);
		button.appendChild(txtButton);
		button.className = className;
		return button;
	}
	createTotalPayment(){
		let p = document.createElement('p');
		p.classList.add('total-payment');
		let beforeP = document.createTextNode('Итог:');
		let span = document.createElement('span');
		span.classList.add('shop-res-price');
		let txtPayment = document.createTextNode(this.totalPrice);
		span.appendChild(txtPayment);
		let spanAfter = document.createElement('span');
		spanAfter.classList.add('shop-res-currency');
		let afterP = document.createTextNode(this.currency);
		spanAfter.appendChild(afterP);
		p.appendChild(beforeP);
		p.appendChild(span);
		p.appendChild(spanAfter);
		return p;
	}
	fixCompliteOrder() {
		this.element.addEventListener('scroll',(e)=>{
			this.completeOrderElement.style.bottom = `-${this.element.scrollTop}px`;
		})
	}
}
