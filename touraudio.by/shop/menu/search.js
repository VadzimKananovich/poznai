

class SearchButton {
	constructor(){
		this.element = this.createElement();
	}
	createElement(){
		let button = document.createElement('button');
		button.classList.add('buy-search-button');
		return button;
	}
	showOnClick(el){
		this.element.addEventListener('click', (e)=>{
			let eventName;
			if(el.classList.contains('show-search')){
				el.classList.remove('show-search');
				eventName = 'showControls';
			} else {
				el.classList.add('show-search');
				eventName = 'hideControls';
			}
			let customEvent = new CustomEvent(eventName, {bubbles: true, cancelable: true});
			this.element.dispatchEvent(customEvent);
		});
	}
}


class SearchInput {
	constructor (){
		this.element = this.createElement();
		this.createSearchString();
	}
	createElement(){
		let input = document.createElement('input');
		input.classList.add('buy-search-input');
		input.setAttribute('type','text');
		input.setAttribute('placeholder','Найти');
		return input;
	}

	createSearchString() {
		this.timerDelay = 0;
		this.element.addEventListener('keypress', (e)=>{
			this.startTimer();
		});
	}
	startTimer () {
		this.stopTimer();
		this.timerDelay = setTimeout(()=>{
			this.searchString = this.element.value;
			this.element.dispatchEvent( new CustomEvent('searching', {bubbles: true, cancelable: true}));
		},1000);
	}
	stopTimer () {
		if(this.timerDelay){
			clearTimeout(this.timerDelay);
			this.timerDelay = 0;
		}
	}
}




class SearchElements extends MenuFunctions {
	constructor() {
		super();
		this.button = new SearchButton();
		this.input = new SearchInput();
		this.element = this.createSearch();
		this.button.showOnClick(this.element);
	}

	createSearch () {
		let div = document.createElement('div');
		div.classList.add('buy-search');
		// let divRes = document.createElement('div');
		// divRes.classList.add('buy-search-res');
		// divRes.classList.add('hide');
		div.appendChild(this.input.element);
		div.appendChild(this.button.element);
		// div.appendChild(divRes);
		return div;
	}




}


class Search extends SearchElements {
	constructor(array){
		super();
		this.array = array;
		this.searchInArray();
	}

	searchInArray(){
		this.element.addEventListener('searching',(e)=>{
			e.preventDefault();
			let countRes = 0;
			let resArray = [];
			console.log(this.array);
			for(let i = 0; i < this.array.length; i++){
				for(let j = 0; j < this.array[i][1].length; j++){
					for(let count = 0; count < this.array[i][1][j][1].length; count++){
						let product = this.array[i][1][j][1][count];
						if(
							product.series.includes(this.input.element.value) ||
							product.category.includes(this.input.element.value) ||
							product.name.includes(this.input.element.value) ||
							product.description.includes(this.input.element.value)
					){
						resArray.push(product);
					}
					}
				}
			}

			if(resArray.length){
				console.log(resArray);
			} else {
				console.log('no');
			}
		})
	}

	createResRow (item) {
		console.log(item);
		// let wrapper = document.createElement('div');
		// let img = document.createElement('img');
		// img.classList.add('res-row-img');
		// img.setAttribute('src',item.img);
		// wrapper.classList.add('res-row-wrap');
		// wrapper.appendChild(img);
		// let container = document.createElement('div');
		// container.classList.add('res-row-container');
		// let title = document.createElement('h5');
		// title.classList.add('res-row-title');
		// let txtTitle = document.createTextNode(item.name);
		// title.appendChild(txtTitle);
		// container.appendChild(title);
		// let desc = document.createElement('p');
		// let shirtDesc;
		// if(item.desc.length > 50){
		// 	shirtDesc = item.desc.slice(50);
		// } else {
		// 	shirtDesc = item.desc;
		// }
		// let txtDesc = document.createTextNode(shirtDesc);
		// desc.appendChild(txtDesc);
		// container.appendChild(txtDesc);
		// wrapper.appendChild(container);
		// this.result.appendChild(wrapper);
		// console.log(wrapper);
	}

	clearRes () {
		// this.result.innerHTML = "";
	}

	showError () {
		console.log('no result');
	}
	// createDisplay(){
	// 	this.createDropDownMenu();
	// 	this.createElement();
	// 	this.appendDropDownMenu();
	// 	this.setLocalStorage();
	// }
	//
	// createDropDownMenu() {
	// 	this.dropDown =  new DropDown(this.createDisplayArray(),'display');
	// }
	//
	// createDisplayArray(){
	// 	let newArray = [];
	// 	let slideRow = ['Слайдером','fas fa-arrows-alt-h','slide'];
	// 	let listRow = ['Списком','fas fa-list-ul','list'];
	// 	newArray.push(slideRow,listRow);
	// 	return newArray;
	// }
	//
	// createElement() {
	// 	let container = this.createBlockTitle('Найти:');
	// 	this.element = container;
	// }
	//
	// appendDropDownMenu(){
	// 	this.element.appendChild(this.dropDown.menu);
	// }
	//
	// setLocalStorage() {
	// 	let title = this.element.querySelector('.buy-menu-title');
	// 	localStorage.setItem('display',title.dataset.id);
	// 	this.element.addEventListener('display',(e)=>{
	// 		e.preventDefault();
	// 		localStorage.setItem('display',e.detail.id);
	// 	})
	// }
}








class Search2 extends SearchElements {
	constructor (array) {
		super();
		this.showHint (array);
	}

	showHint(array) {
		this.hintTimerDelay = 0;
		this.searchInput = this.element.querySelector('.buy-search-input');
		this.result = this.element.querySelector('.buy-search-res');
		this.searchInput.addEventListener('keypress', (e)=>{
			if(this.result.classList.contains('hide')){
				this.showHide(this.result,200);
			}
			if(e.keyCode === 8){
				this.clearRes();
			}
			this.startTimer(array);
		});
	}
	startTimer (array) {
		this.stopTimer();
		this.clearRes();
		this.hintTimerDelay = setTimeout(this.searchResult.bind(this,array),1000);
	}
	stopTimer () {
		if(this.hintTimerDelay){
			clearTimeout(this.hintTimerDelay);
			this.hintTimerDelay = 0;
		}
	}
	searchResult (array) {
		let countRes = 0;
		for(let i = 0; i < array.length; i++){
			for(let j = 0; j < array[i][1].length; j++){
				if(array[i][1][j].name.includes(this.searchInput.value)){
					this.createResRow(array[i][1][j]);
					countRes++;
				} else if (array[i][1][j].desc.includes(this.searchInput.value)){
					this.createResRow(array[i][1][j]);
					countRes++;
				}
			}
		}
		if(!countRes){
			this.showError();
		}
	}
	createResRow (item) {
		let wrapper = document.createElement('div');
		let img = document.createElement('img');
		img.classList.add('res-row-img');
		img.setAttribute('src',item.img);
		wrapper.classList.add('res-row-wrap');
		wrapper.appendChild(img);
		let container = document.createElement('div');
		container.classList.add('res-row-container');
		let title = document.createElement('h5');
		title.classList.add('res-row-title');
		let txtTitle = document.createTextNode(item.name);
		title.appendChild(txtTitle);
		container.appendChild(title);
		let desc = document.createElement('p');
		let shirtDesc;
		if(item.desc.length > 50){
			shirtDesc = item.desc.slice(50);
		} else {
			shirtDesc = item.desc;
		}
		let txtDesc = document.createTextNode(shirtDesc);
		desc.appendChild(txtDesc);
		container.appendChild(txtDesc);
		wrapper.appendChild(container);
		this.result.appendChild(wrapper);
		console.log(wrapper);
	}
	clearRes () {
		this.result.innerHTML = "";
	}
	showError () {
		this.result.innerHTML = "<p class='res-row-error'>Ничего не найдено</p>";
	}


}
