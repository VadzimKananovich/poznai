
class ShopBody {
	constructor (array) {
		this.array = array;
		this.createWrapper();
		this.init();
	}
	init(){
		this.checkSeries();
		this.createContent();
		// this.createNavButtons();
		// this.markInCart();
		if(window.localStorage.getItem('category')){
			// let id = Number(window.localStorage.getItem('category'));
			// let step = this.category[0].element.offsetWidth;
			// let translate = step * id;
			// this.wrapper.setAttribute('style',`transform: translateX(-${translate}px);`);
		}
	}
	markInCart(){
		this.removeAllMark();
		let localCart = JSON.parse(window.localStorage.getItem('cart'));
		if(localCart){
			let itemsArray = this.searchItems(localCart);
			for(let i = 0; i < itemsArray.length; i++){
				let inCart = new InCartElement;
				inCart.title.innerHTML = itemsArray[i][1];
				itemsArray[i][0].appendChild(inCart.element);
				if(!itemsArray[i][0].classList.contains('in-cart')){
					itemsArray[i][0].classList.add('in-cart');
				}
			}
		}
	}
	searchItems(localCart){
		let itemsArray = [];
		for(let i = 0; i < this.category.length; i++){
			for(let j = 0; j < this.category[i].items.length; j++){
				let item = this.category[i].items[j];
				for(let count = 0; count < localCart.length; count++){
					if(localCart[count].id === item.dataset.id){
						let newArray = [item,localCart[count].quantity];
						itemsArray.push(newArray);
					}
				}
			}
		}
		return itemsArray;
	}
	removeAllMark(item){
		for(let i = 0; i < this.category.length; i++){
			for(let j = 0; j < this.category[i].items.length; j++){
				let item = this.category[i].items[j];
				let existMark = item.querySelector('.row-in-cart');
				if(existMark){
					existMark.parentElement.removeChild(existMark);
				}
				if(item.classList.contains('in-cart')){
					item.classList.remove('in-cart');
				}
			}
		}
	}

	checkSeries(){
		if(!window.localStorage.getItem('series')) {
			window.localStorage.setItem('series',this.array[0][0]);
		}
		let series = localStorage.getItem('series');
		for(let i = 0; i < this.array.length; i++){
			if(series === this.array[i][0]){
				this.seriesId = i;
			}
		}
	}
	checkSearching(){
		if(localStorage.getItem('search')){
			this.searchId = localStorage.getItem('search');
		}
	}
	createWrapper(){
		let div = document.createElement('div');
		div.classList.add('result-wrapper');
		let topContainer = document.createElement('div');
		topContainer.classList.add('shop-body-wrap');
		topContainer.appendChild(div);
		this.element = topContainer;
		this.wrapper = div;
	}
	createContent(){
		this.category = [];
		this.categoryOffset = [[],[]];
		for(let i = 0; i < this.array[this.seriesId][1].length; i++){
			let category = new Category(this.array[this.seriesId][1][i]);
			setTimeout(()=>{
				this.categoryOffset[0].push(category.element.offsetWidth);
				this.categoryOffset[1].push(category.element.offsetHeight);
			},0)
			category.element.dataset.id=i;
			this.wrapper.appendChild(category.element);
			this.category.push(category);
		}
	}
	createSearchResult(request){
		this.checkSearching();
		let result = JSON.parse(this.searchId);
		this.nav.leftButton.style.display = 'none';
		this.nav.rightButton.style.display = 'none';
		if(result.constructor === Array){
			let resArray = this.createResArray(result);
			this.displayResult(resArray,request);
		} else {
			this.createNoResult();
		}
		this.createCloseButton();
	}
	createResArray(searchArray){
		let resArray = [``,[]];
		for(let i = 0; i < this.array.length; i++){
			for(let j = 0; j < this.array[i][1].length; j++){
				let category = this.array[i][1][j];
				for(let count = 0; count < category[1].length; count++){
					if(searchArray.indexOf(category[1][count].id) > -1){
						resArray[1].push(category[1][count]);
					}
				}
			}
		}
		return resArray;
	}
	displayResult(array,request){
		this.category = [];
		let category = new Category(array);
		this.category.push(category);
		category.element.insertBefore(this.createQueryText(array[1].length,request), category.element.firstChild);
		this.wrapper.appendChild(category.element);
	}
	createQueryText(leng, request){
		let p = document.createElement('p');
		p.classList.add('res-query');
		let txtBefore = document.createTextNode('По запросу ');
		let span = document.createElement('span');
		span.innerHTML = request;
		let txtAfter = document.createTextNode(` найдено результатов: `);
		p.appendChild(txtBefore);
		p.appendChild(span);
		p.appendChild(txtAfter);
		let spanQuantity = document.createElement('span');
		spanQuantity.classList.add('search-quantity');
		spanQuantity.innerHTML = leng;
		p.appendChild(spanQuantity);
		return p;
	}
	createNoResult(){
		let div = document.createElement('div');
		div.classList.add('category-container');
		let p = document.createElement('p');
		p.classList.add('no-res-text');
		p.innerHTML = 'по вашему запросу ничего не найдено';
		div.appendChild(p);
		this.wrapper.appendChild(div);
	}
	createCloseButton(){
		let div = document.createElement('div');
		div.classList.add('search-close-button');
		let i = document.createElement('i');
		i.className = 'fas fa-times-circle';
		div.appendChild(i);
		div.addEventListener('click',(e)=>{
			e.preventDefault();
			e.currentTarget.dispatchEvent(new CustomEvent('closesearch', {bubbles: true, cancelable: true}));
		});
		this.wrapper.appendChild(div);
	}
	createNavButtons(){
		if(!this.nav){
			this.nav = new NavButtons();
			this.element.appendChild(this.nav.leftButton);
			this.element.appendChild(this.nav.rightButton);
			this.element.appendChild(this.wrapper);
		} else {
			if(this.nav.leftButton.style.display === 'none'){
				this.nav.leftButton.style.display = '';
			}
			if(this.nav.rightButton.style.display === 'none'){
				this.nav.rightButton.style.display = '';
			}
		}
	}
	clearContent(){
		this.wrapper.innerHTML = '';
		if(this.wrapper.style.transform.includes('translateX')){
			this.wrapper.style.transform = 'translateX(0)';
		}
	}
}
