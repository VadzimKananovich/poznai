
class Menu {
	constructor(array) {
		this.series = new Series(array);
		this.category = new CategoryMenu(array);
		this.sort = new Sort();
		this.display = new Display();
		this.search = new Search(array);
		// this.cart = new Cart(array).element;

		this.rowControls = this.createRowControls(this.series.element, this.category.element,this.sort.element,this.display.element,this.search.element);
		this.menu = this.createMenu(this.rowControls);

		this.changeSeries(array);
		this.hideControls();
		this.showControls();
	}
	createWrapper () {
		let div = document.createElement('div');
		div.classList.add('buy-menu');
		return div;
	}
	createRowControls (...args) {
		let div = document.createElement('div');
		div.classList.add('menu-row-controls');
		for(let i = 0; i < args.length; i++){
			div.appendChild(args[i]);
		}
		return div;
	}
	createMenu(...args) {
		let buy = document.querySelector('#buy');
		let menu = this.createWrapper();
		for(let i = 0; i < args.length; i++){
			menu.appendChild(args[i]);
		}
		buy.appendChild(menu);
		return menu;
		// let showSort = document.createElement('div');
		// showSort.classList.add('show-sort-wrap');
		// showSort.classList.add('menu-element-wrap');
		// showSort.appendChild(this.display);
		// showSort.appendChild(this.category);
		// showSort.appendChild(this.sort);
		// this.wrapper.appendChild(showSort);
		// let searchCart = document.createElement('div');
		// searchCart.classList.add('search-cart-wrap');
		// searchCart.classList.add('menu-element-wrap');
		// searchCart.appendChild(this.search);
		// searchCart.appendChild(this.cart);
		// this.wrapper.appendChild(searchCart);
		// buy.appendChild(this.wrapper);
	}

	changeSeries() {
		this.menu.addEventListener('series',(e)=>{
			// e.preventDefault();
			this.category.dropDown.menu.parentElement.removeChild(this.category.dropDown.menu);
			this.category.createDropDownMenu();
			this.category.appendDropDownMenu();
			this.category.setLocalStorage();
		})
	}
	hideControls(){
		this.menu.addEventListener('hideControls',(e)=>{
			e.preventDefault();
			this.series.element.classList.add('hide-opacity');
			this.category.element.classList.add('hide-opacity');
			this.sort.element.classList.add('hide-opacity');
			this.display.element.classList.add('hide-opacity');
		})
	}
	showControls(){
		this.menu.addEventListener('showControls',(e)=>{
			e.preventDefault();
			this.series.element.classList.remove('hide-opacity');
			this.category.element.classList.remove('hide-opacity');
			this.sort.element.classList.remove('hide-opacity');
			this.display.element.classList.remove('hide-opacity');
		})
	}

}
