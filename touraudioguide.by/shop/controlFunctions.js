
class CheckDisplay {
	constructor(shop){
		this.shop = shop;
		this.checkDisplay();
	}
	checkDisplay(){
		if(window.localStorage.getItem('display')){
			this.shop.getPosition();
		}
		this.shop.element.addEventListener('display', (e)=>{
			e.preventDefault();
			this.shop.getPosition();
		})
	}
}


class CheckSeries{
	constructor(shop){
		this.shop = shop;
		this.body = this.shop.body;
		this.resWrapper = this.body.wrapper;
		this.menu = this.shop.menu;
		this.checkSeries();
	}
	checkSeries(){
		this.shop.element.addEventListener('series', (e)=>{
			e.preventDefault();
			// this.body.clearContent();
			// this.body.init();
			// this.shop.getPosition();
			this.checkDisplay();
		})
	}
	checkDisplay(){
		let display = window.localStorage.getItem('display');
		switch(display){
			case 'list':
			this.shop.body.wrapper.style.transform = "translateX(0px)";
			break;
			case 'slide':

			break;
		}
	}
}
class CheckSort{
	constructor(body,shop){
		this.body = body;
		this.shop = shop;
		this.checkSort();
	}
	checkSort(){
		this.shop.addEventListener('sort',(e)=>{
			e.preventDefault();
			for(let i = 0; i < this.body.category.length; i++){
				this.body.category[i].clearContent();
				this.body.category[i].init();
			}
		})
	}
}


class Searching {
	constructor(shop){
		this.shop = shop;
		this.searching();
		this.closeSearch();
	}
	searching(){
		this.shop.element.addEventListener('searching',(e)=>{
			e.preventDefault();
			let res = this.shop.menu.search.input.element.value;
			this.shop.body.clearContent();
			this.shop.body.createSearchResult(res);
			this.shop.verticalScroll.scrollTo(0);
		})
	}
	closeSearch(){
		this.shop.element.addEventListener('closesearch',(e)=>{
			e.preventDefault();
			this.shop.body.searchId = null;
			localStorage.removeItem('search');
			this.shop.body.clearContent();
			this.shop.body.init();
			this.shop.getPosition();
			this.checkDisplay();
		});
	}
	checkDisplay(){
		let display = window.localStorage.getItem('display');
		switch(display){
			case 'list':
			this.shop.body.wrapper.style.transform = "translateX(0px)";
			break;
			case 'slide':
			break;
		}
	}
}

class CheckCategory{
	constructor(shop){
		this.shop = shop;
		this.slideScroll = this.shop.slideScroll;
		this.verticalScroll = this.shop.verticalScroll;
		this.checkCategory();
	}
	checkCategory(){
		if(window.localStorage.getItem('category')){
			this.scrollToCategory();
		}
		this.shop.element.addEventListener('category',(e)=>{
			e.preventDefault();
			this.scrollToCategory();
		})
	}
	scrollToCategory(){
		let categoryId = Number(localStorage.getItem('category'));
		let display = window.localStorage.getItem('display');
		this.verticalScroll.scrollTo(categoryId);
		switch(display){
			case 'list':
			break;
			case 'slide':
			this.slideScroll.scrollTo(categoryId);
			break;
		}
	}
}

class DropDownClose {
	constructor(shop,menu){
		this.shop = shop;
		this.menu = menu;
		this.openedOverflow = false;
		this.createOverFlow();
		this.closeOverFlow();
		this.openedDropDown();
		this.closeByClickButton();
	}
	openedDropDown(){
		this.shop.addEventListener('openedDropDown',(e)=>{
			e.preventDefault();
			if(!this.openedOverflow){
				this.shop.appendChild(this.element);
				this.openedOverflow = true;
			}
		})
	}
	createOverFlow(){
		this.element = document.createElement('div');
		this.element.classList.add('overflow');
		this.element.style.zIndex = '110';
	}
	closeOverFlow(){
		this.element.addEventListener('click',(e)=>{
			e.preventDefault();
			this.closeAll();
		});
	}
	closeAll(){
		if(this.openedOverflow){
			this.element.parentElement.removeChild(this.element);
			this.openedOverflow = false;
		}
		if(this.menu.filter.openedDropDown){
			this.menu.filter.showHide();
		}
		if(this.menu.cart.openedDropDown){
			this.menu.cart.closeOpen();
		}
	}
	closeByClickButton(){
		this.shop.addEventListener('closeAll',(e)=>{
			e.preventDefault();
			this.closeAll();
		})
	}
}

class AddToCart {
	constructor(shop){
		this.shop = shop;
		this.init();
	}
	init(){
		this.shop.element.addEventListener('cart',(e)=>{
			this.target = e.target;
			this.checkQuantity(e.detail);
		})
	}

	checkQuantity(detail){
		this.quantity = Number(detail.quantity);
		this.id = detail.id;
		this.item = this.searchItem();
		let min = Number(this.item.minItem);
		let max = Number(this.item.maxItem);
		if(this.quantity < min){
			this.shop.element.dispatchEvent(new CustomEvent('msgAlert',
			{ bubbles: true,
				cancelable: true,
				detail: {
					'type':'error',
					'msg': `минимальное количество ${min} шт.`}
				}
			));
		} else if(this.quantity > max){
			this.shop.element.dispatchEvent(new CustomEvent('msgAlert',
			{ bubbles: true,
				cancelable: true,
				detail: {
					'type':'error',
					'msg': `максимальное количество ${max} шт.`}
				}
			));
		} else {
			this.showModal();
			this.setLocalstorage();
			this.changeCart();
			this.shop.body.markInCart();
			if(this.shop.modalComplete){
				this.shop.modalComplete.modalCart.refreshResult();
			}
		}
	}

	showModal(){
		if(this.target.dataset.type != 'menu'){
			let localCart = window.localStorage.getItem('cart') ? JSON.parse(window.localStorage.getItem('cart')) : [];
			this.item.quantity = this.quantity;
			let checkExist = 0;
			let differentQuantity = 0;
			for(let i = 0; i < localCart.length; i++){
				if(localCart[i].id === this.item.id && localCart[i].quantity === this.quantity){
					checkExist++;
				}
				if(localCart[i].id === this.item.id && localCart[i].quantity !== this.quantity){
					differentQuantity++;
				}
			}
			if(checkExist){
				return
			}
			let type = differentQuantity ? 'changeCartQuantity' : 'addToCart';
			this.shop.element.dispatchEvent(new CustomEvent('msgAlert',
			{ bubbles: true,
				cancelable: true,
				detail: {
					'type':type,
					'msg': this.item}
				}
			));
		}
	}

	searchItem(){
		for(let i = 0; i < this.shop.allProducts.length; i++){
			if(this.id === this.shop.allProducts[i].id){
				return this.shop.allProducts[i];
			}
		}
	}

	setLocalstorage(){
		let items = window.localStorage.getItem('cart') ? JSON.parse(window.localStorage.getItem('cart')) : [];
		let checkExist = 0;
		for(let i = 0; i < items.length; i++){
			if(items[i].id === this.id){
				items[i].quantity = Number(this.quantity);
				checkExist++;
			}
		}
		if(!checkExist){
			items.push({'id':this.id, 'quantity':Number(this.quantity)});
		}
		window.localStorage.setItem('cart',JSON.stringify(items));
	}
	changeCart(){
		let cart = this.shop.menu.cart;
		cart.displayQuantity();
		cart.result.clearContent();
		cart.result.init();
	}

}



class RemoveFromCart {
	constructor(shop){
		this.shop = shop;
		this.init();
	}
	init(){
		this.shop.element.addEventListener('removeProduct', (e)=>{
			this.id = e.detail;
			this.setLocalStorage();
			this.changeCart();
			this.changeCartInModal();
			this.shop.body.markInCart();
		})
	}
	setLocalStorage(){
		let items = this.getFromLocalStorage();
		let newArray = [];
		for(let i = 0; i < items.length; i++){
			if(items[i].id !== this.id){
				newArray.push(items[i]);
			}
		}
		window.localStorage.setItem('cart', JSON.stringify(newArray));
		if(!this.getFromLocalStorage()){
			window.localStorage.removeItem('cart');
		}
	}
	getFromLocalStorage(){
		let items = JSON.parse(window.localStorage.getItem('cart'));
		if(items.length){
			return JSON.parse(window.localStorage.getItem('cart'));
		} else {
			return false;
		}
	}
	changeCart(){
		let cart = this.shop.menu.cart;
		cart.displayQuantity();
		cart.result.clearContent();
		cart.result.init();
	}
	changeCartInModal(){
		if(this.shop.modalComplete){
			if(JSON.parse(window.localStorage.getItem('cart'))){
				this.shop.modalComplete.modalCart.refreshResult();
			} else {
				if(this.shop.modalComplete.state){
					this.shop.modalComplete.closeModal();
				}
			}
		}
	}
}


class CompleteOrder{
	constructor(shop){
		this.shop = shop;
		this.init();
	}
	init(){
		this.shop.element.addEventListener('completeOrder',(e)=>{
			e.preventDefault();
			this.shop.modalComplete = new ModalWindow('0');
			this.shop.modalComplete.modalForm = new CompleteOrderForm();
			this.shop.modalComplete.modalCart = new CompleteOrderCart(this.shop);
			this.showModal();
		})
	}
	showModal(){
		this.shop.modalComplete.container.appendChild(this.shop.modalComplete.modalForm.element);
		this.shop.modalComplete.container.appendChild(this.shop.modalComplete.modalCart.element);
		this.shop.modalComplete.container.className = 'modal-window complete-order';
		this.shop.element.appendChild(this.shop.modalComplete.element);
		this.shop.modalComplete.showModal();
	}
}


class RemoveAll{
	constructor(shop){
		this.shop = shop;
		this.init();
	}
	init(){
		this.shop.element.addEventListener('removeAll',(e)=>{
			e.preventDefault();
		})
	}

}
