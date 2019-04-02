

class SearchButton {
	constructor(){
		this.element = this.createElement();
		this.init();
	}
	createElement(){
		let button = document.createElement('button');
		button.classList.add('buy-search-button');
		return button;
	}
	init(){
		this.element.addEventListener('click',(e)=>{
			e.preventDefault();
			this.element.dispatchEvent( new CustomEvent('searching', {bubbles: true, cancelable: true}));
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
		},300);
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
		// this.button.showOnClick(this.element);
		// this.button.focusOnClick(this.input.element);
	}
	createSearch () {
		let div = document.createElement('div');
		div.classList.add('buy-search');
		div.appendChild(this.input.element);
		div.appendChild(this.button.element);
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
						resArray.push(product.id);
					}
					}
				}
			}
			let resSearch;
			if(resArray.length){
				resSearch = resArray;
			} else {
				resSearch = 'Нет результатов';
			}
			localStorage.setItem('search',JSON.stringify(resSearch));
			this.element.dispatchEvent(new CustomEvent('searchResult', {bubbles: true, cancelable: true}));
		})
	}
}
