class RowItem {
	constructor(id,price){
		this.price = price;
		this.id = id;
		this.createElement();
	}
	createElement(){
		let div = document.createElement('div');
		div.dataset.price = this.price;
		div.dataset.id = this.id;
		div.classList.add('shop-res-row');
		let imgContainer = this.createImg();
		let contentElements = this.createContentElements();
		div.appendChild(imgContainer);
		div.appendChild(contentElements);
		this.element = div;
	}
	createImg(){
		let imgContainer = document.createElement('div');
		imgContainer.classList.add('shop-img-container');
		let img = document.createElement('img');
		imgContainer.appendChild(img);
		this.img = img;
		return imgContainer;
	}
	createContentElements(){
		let contentWrap = document.createElement('div');
		contentWrap.classList.add('shop-content-wrap');
		let title = this.createTitle();
		// let priceCurrency = this.createPriceCurrency();
		let desc = this.createDesc();
		// let controls = this.createControls();
		contentWrap.appendChild(title);
		// contentWrap.appendChild(priceCurrency);
		contentWrap.appendChild(desc);
		// contentWrap.appendChild(controls);
		this.contentWrap = contentWrap;
		return contentWrap;
	}
	createTitle(){
		let title = document.createElement('h4');
		title.classList.add('shop-res-title');
		this.title = title;
		return title;
	}
	createPriceCurrency(){
		let p = document.createElement('p');
		p.classList.add('shop-res-finaly');
		let price = document.createElement('span');
		price.classList.add('shop-res-price');
		this.price = price;
		p.appendChild(this.price);
		let currency = document.createElement('span');
		currency.classList.add('shop-res-currency');
		this.currency = currency;
		p.appendChild(this.currency);
		return p;
	}
	createDesc(){
		let desc = document.createElement('p');
		desc.classList.add('shop-res-desc');
		this.desc = desc;
		return desc;
	}
	createControls(){
		let controls = new RowControlsElements(this.id);
		this.controls = controls;
		return controls.element;
	}
}
