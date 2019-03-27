
class ResRowContainer {
	constructor () {
		this.container = this.createContainer();
	}
	createContainer () {
		let div = document.createElement('div');
		div.classList.add('shop-res-row');
		let imgContainer = document.createElement('div');
		imgContainer.classList.add('shop-img-container');
		let contentWrap = document.createElement('div');
		contentWrap.classList.add('shop-content-wrap');
		let title = document.createElement('h4');
		title.classList.add('shop-res-title');
		let price = document.createElement('p');
		price.classList.add('shop-res-price');
		let currency = document.createElement('span');
		currency.classList.add('shop-res-currency');
		price.appendChild(currency);
		let desc = document.createElement('p');
		desc.classList.add('shop-res-desc');
		let control = document.createElement('div');
		control.classList.add('shop-res-control');
		contentWrap.appendChild(title);
		contentWrap.appendChild(price);
		contentWrap.appendChild(desc);
		contentWrap.appendChild(control);
		div.appendChild(imgContainer);
		div.appendChild(contentWrap);
		return div;
	}
}


class ResRowControls {
	constructor (id) {
		this.quantity = this.createQuantity();
		this.button = this.createAddButton(id);
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
	createAddButton (id) {
		let button = document.createElement('button');
		button.setAttribute('type','button');
		button.classList.add('buy-button');
		let contentButton = document.createElement('i');
		contentButton.className = 'fas fa-cart-plus';
		button.appendChild(contentButton);
		button.setAttribute('title','Добавить в корзину');

		button.addEventListener('click',(e)=>{
			let quantity = e.target.parentNode.querySelector('.input-quantity') ||
			e.target.parentNode.parentNode.querySelector('.input-quantity');
			let cartEvent = new CustomEvent('cart', {
				bubbles: true, cancelable: true, detail:{'id':id, 'quantity':Number(quantity.value)}
			});
			e.target.dispatchEvent(cartEvent);
		});

		return button;
	}
}



class RowItem  {
	constructor(item){
		this.container = new ResRowContainer().container;
		this.addControlButtons(item.id);
		this.addInfoItem(item);
	}
	addControlButtons (id) {
		let controlWrapper = this.container.querySelector('.shop-res-control');
		let quantity = new ResRowControls().quantity;
		let button = new ResRowControls(id).button;
		controlWrapper.appendChild(quantity);
		controlWrapper.appendChild(button);
	}
	addInfoItem (item) {
		let imgContainer = this.container.querySelector('.shop-img-container');
		let title = this.container.querySelector('.shop-res-title');
		let price = this.container.querySelector('.shop-res-price');
		let currency = this.container.querySelector('.shop-res-currency');
		let txtCurrency = document.createTextNode(item.currency);
		this.container.dataset.id = item.id;
		this.container.dataset.price = item.price;
		currency.appendChild(txtCurrency);
		let txtPrice = document.createTextNode(item.price);
		price.appendChild(txtPrice);
		let desc = this.container.querySelector('.shop-res-desc');
		let inputQuantity = this.container.querySelector('.input-quantity');
		let quantity = Number(item.minItem) > 0 ? Number(item.minItem) : 1;
		inputQuantity.setAttribute('min',quantity);
		inputQuantity.setAttribute('step',quantity);
		inputQuantity.setAttribute('value',quantity);
		let img = document.createElement('img');
		img.setAttribute('src',item.img);
		imgContainer.appendChild(img);
		let txtTitle = document.createTextNode(item.name);
		title.appendChild(txtTitle);
		let txtDesc = document.createTextNode(item.desc);
		desc.appendChild(txtDesc);
	}
}
