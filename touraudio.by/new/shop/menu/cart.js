
class CartElement extends MenuFunctions {
	constructor(){
		super();
		this.element = this.createCart();
	}
	createCart () {
		let div = document.createElement('div');
		div.classList.add('buy-cart');
		let divIco = document.createElement('div');
		divIco.classList.add('buy-cart-ico');
		let i = document.createElement('i');
		i.className = 'fas fa-shopping-cart';
		divIco.appendChild(i);
		let cartTitle = document.createElement('div');
		cartTitle.classList.add('cart-title');
		let txtCartTitle = document.createTextNode('Корзина');
		cartTitle.appendChild(txtCartTitle);
		divIco.appendChild(cartTitle);
		div.appendChild(divIco);
		let divRes = document.createElement('div');
		divRes.classList.add('buy-cart-result');
		div.appendChild(divRes);
		return div;
	}
	createRow() {
		let div = document.createElement('div');
		div.classList.add('cart-row');
		let imgContainer = document.createElement('div');
		imgContainer.classList.add('cart-img-container');
		let img = document.createElement('img');
		imgContainer.appendChild(img);
		div.appendChild(imgContainer);

		let resContainer = document.createElement('div');
		div.classList.add('cart-res-container');
		let title = document.createElement('p');
		title.classList.add('cart-res-title');
		let priceContainer = document.createElement('div');
		priceContainer.classList.add('cart-price-container');
		let quantity = this.createQuantity();
		let price = document.createElement('p');
		price.classList.add('cart-total-price');
		priceContainer.appendChild(quantity);
		priceContainer.appendChild(price);
		let desc = document.createElement('p');
		desc.classList.add('cart-desc');
		resContainer.appendChild(title);
		resContainer.appendChild(priceContainer);
		resContainer.appendChild(desc);
		div.appendChild(resContainer);
		return div;
	}

	createQuantity () {
		let quantity = document.createElement('div');
		quantity.classList.add('shop-res-quantity');
		let plus = document.createElement('i');
		plus.className = 'fas fa-plus-circle';
		let minus = document.createElement('i');
		minus.className = 'fas fa-minus-circle';
		let inputQuantity = document.createElement('input');
		inputQuantity.setAttribute('type','number');
		inputQuantity.setAttribute('name','count');
		inputQuantity.classList.add('input-quantity');
		quantity.appendChild(minus);
		quantity.appendChild(inputQuantity);
		quantity.appendChild(plus);
		minus.addEventListener('click', ()=>{
			inputQuantity.value = inputQuantity.value === inputQuantity.step ?
			inputQuantity.value : Number(inputQuantity.value) - Number(inputQuantity.step);
		});
		plus.addEventListener('click', ()=>{
			inputQuantity.value = Number(inputQuantity.value) + Number(inputQuantity.step);
		});
		return quantity;
	}
}




class Cart extends CartElement {
	constructor(array){
		super();
		this.addToCart(array);
	}
	addToCart(array) {
		this.element.addEventListener('cart', (e)=>{
			let localArray = localStorage.cart ? JSON.parse(localStorage.getItem('cart')) : [];
			let existItem = 0;
			if(localArray.length){
				for(let i = 0; i < localArray.length; i++){
					if(localArray[i].id === e.detail.id){
						localArray[i].quantity = e.detail.quantity;
						existItem++;
					}
				}
			}
			if(!existItem){
				localArray.push(e.detail);
			}
			let detail = JSON.stringify(localArray);
			localStorage.setItem('cart', detail);
			this.refreshResult(array);
		});
	}
	refreshResult(array) {
		if(localStorage.cart){
			let result = this.element.querySelector('.buy-cart-result');
			result.innerHTML = '';
			let localArray = JSON.parse(localStorage.getItem('cart'));
			for(let count = 0; count < localArray.length; count++){
				let container = this.createResRow(localArray[count].id, localArray[count].quantity,array);
				result.appendChild(container);
			}

		}
	}
	createResRow(id, quantity, array) {
		for(let i = 0; i < array.length; i++){
			for(let j = 0; j < array[i][1].length; j++){
				let item = array[i][1][j];
				if(item.id === id){
					return this.insertInRow(item, quantity);
				}
			}
		}
	}
	insertInRow(object, quantity){
		let container = this.createRow();
		let img = container.querySelector('.cart-img-container img');
		let title = container.querySelector('.cart-res-title');
		let price = container.querySelector('.cart-total-price');
		let desc = container.querySelector('.cart-desc');
		let quantityNode = container.querySelector('.input-quantity');

		img.setAttribute('src',object.img);
		let txtTitle = document.createTextNode(object.name);
		title.appendChild(txtTitle);
		let totalPrice = Number(object.price) * Number(quantity);
		let txtPrice = document.createTextNode(totalPrice);
		price.appendChild(txtPrice);
		let txtDesc = document.createTextNode(object.desc);
		desc.appendChild(txtDesc);
		// let txtQuantity = document.createTextNode(quantity);
		quantityNode.setAttribute('value',quantity);
		return container;
	}
}
