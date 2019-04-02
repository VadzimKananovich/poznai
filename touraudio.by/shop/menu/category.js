class CategoryMenu extends MenuFunctions {
	constructor(array){
		super();
		this.array = array;
		this.createCategoryMenu();
	}

	createCategoryMenu(){
		this.createDropDownMenu();
		this.createElement();
		this.appendDropDownMenu();
		this.setLocalStorage();
	}

	createDropDownMenu() {
		this.dropDown =  new DropDown(this.createCategoryArray(),'category');
	}

	createCategoryArray(){
		let newArray = [];
		let arrayToPass = [];
		let series = localStorage.getItem('series');
		for(let i = 0; i < this.array.length; i++){
			if(this.array[i][0] === series){
				newArray = this.array[i][1];
			}
		}
		for(let i = 0; i < newArray.length; i++){
			let row = [newArray[i][0],newArray[i][2],newArray[i][0]];
			arrayToPass.push(row);
		}
		return arrayToPass;
	}

	createElement() {
		let container = this.createBlockTitle('Категория:');
		this.element = container;
	}

	appendDropDownMenu(){
		this.element.appendChild(this.dropDown.menu);
	}

	setLocalStorage() {
		let title = this.element.querySelector('.buy-menu-title');
		localStorage.setItem('category',title.dataset.id);
		this.element.addEventListener('category',(e)=>{
			e.preventDefault();
			localStorage.setItem('category',e.detail.id);
		})
	}
}


//
//
// class DomViewCategory extends MenuFunctions {
// 	constructor(array){
// 		super();
// 		this.element = this.createView(array);
// 	}
// 	createView (array) {
// 		let div = this.createBlockTitle('buy-show', 'Категория');
// 		let titleMenu = div.querySelector('.buy-menu-title');
// 		let ul = this.createUl('buy-list');
// 		ul.classList.add('hide');
// 		for(let i = 0; i < array.length; i++){
// 			let li = this.createLi(array[i][3], array[i][0]);
// 			li.dataset.view = i;
// 			ul.appendChild(li);
// 		}
// 		let firstElement = ul.firstChild;
// 		this.insertName(firstElement,titleMenu);
// 		div.appendChild(ul);
// 		return div;
// 	}
// }
//
// class Category extends DomViewCategory {
// 	constructor(array){
// 		super(array);
// 		this.openMenu();
// 		this.changeCategoryHover();
// 		this.changeCategoryClick();
// 		this.closeMenu();
// 	}
// 	openMenu () {
// 		let button = this.element.querySelector('.buy-menu-title');
// 		let menuBuy = this.element.querySelector('.buy-list');
// 		button.addEventListener('click', ()=>{
// 			this.showHide(menuBuy);
// 		});
// 	}
// 	changeCategoryHover() {
// 		let to = this.element.querySelector('.buy-menu-title');
// 		let from = this.element.querySelector('.buy-list');
// 		from.addEventListener('mouseover', (e)=>{
// 			if('view' in e.target.dataset || 'view' in e.target.parentNode.dataset){
// 				let showEvent = this.menuEvent('show',e.target.dataset.view);
// 				e.target.dispatchEvent(showEvent);
// 			}
// 		});
// 	}
// 	changeCategoryClick () {
// 		let to = this.element.querySelector('.buy-menu-title');
// 		let from = this.element.querySelector('.buy-list');
// 		from.addEventListener('click', (e)=>{
// 			if('view' in e.target.dataset || 'view' in e.target.parentNode.dataset){
// 				let showEvent = this.menuEvent('show',e.target.dataset.view);
// 				e.target.dispatchEvent(showEvent);
// 				if('view' in e.target.dataset){
// 					this.insertName(e.target,to);
// 				} else {
// 					this.insertName(e.target.parentNode,to);
// 				}
// 				this.showHide(from);
// 			}
// 		});
// 	}
// 	closeMenu () {
// 		let menu = this.element.querySelector('.buy-list');
// 		menu.addEventListener('closemenu',()=>{
// 			if(!menu.classList.contains('hide')){
// 				this.showHide(menu);
// 			}
// 		})
// 	}
// }
