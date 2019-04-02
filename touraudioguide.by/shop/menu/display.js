class Display extends MenuFunctions {
	constructor(){
		super();
		this.createDisplay();
	}

	createDisplay(){
		this.createDropDownMenu();
		this.createElement();
		this.appendDropDownMenu();
		this.setLocalStorage();
		this.checkLocalStorage();
	}

	createDropDownMenu() {
		this.dropDown =  new DropDown(this.createDisplayArray(),'display');
	}

	createDisplayArray(){
		let newArray = [];
		let slideRow = ['Слайдером','fas fa-arrows-alt-h','slide'];
		let listRow = ['Списком','fas fa-list-ul','list'];
		newArray.push(slideRow,listRow);
		return newArray;
	}

	createElement() {
		let container = this.createBlockTitle('Показать:');
		this.element = container;
	}

	appendDropDownMenu(){
		this.element.appendChild(this.dropDown.menu);
	}

	setLocalStorage() {
		this.element.addEventListener('display',(e)=>{
			e.preventDefault();
			localStorage.setItem('display',e.detail.id);
		})
	}
	checkLocalStorage(){
		if(!window.localStorage.getItem('display')){
			let title = this.dropDown.title;
			localStorage.setItem('display',title.dataset.id);
		} else {
			let local = window.localStorage.getItem('display');
			for(let i = 0; i<this.dropDown.links.length; i++){
				if(local === this.dropDown.links[i].dataset.id){
					this.dropDown.changeTitle(this.dropDown.links[i],this.dropDown.title,this.dropDown.links[i].dataset.id);
				}
			}
		}
	}
}





//
// class DomDisplay extends MenuFunctions {
// 	constructor(){
// 		super();
// 		this.element = this.createDisplay();
// 	}
// 	createDisplay () {
// 		let div = this.createBlockTitle('buy-show', 'Показать');
// 		let titleMenu = div.querySelector('.buy-menu-title');
// 		let ul = this.createUl('buy-list');
// 		ul.classList.add('hide');
// 		let firstLi = this.createLi('fas fa-arrows-alt-h','Слайд');
// 		firstLi.dataset.view = 'slide';
// 		this.insertName(firstLi,titleMenu);
// 		let li = this.createLi('fas fa-list-ul','Список');
// 		li.dataset.view = 'list';
// 		ul.appendChild(firstLi);
// 		ul.appendChild(li);
// 		div.appendChild(ul);
// 		return div;
// 	}
// }
//
// class Display extends DomDisplay {
// 	constructor(array){
// 		super(array);
// 		this.openMenu();
// 		this.changeCategoryHover();
// 		this.changeCategoryClick();
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
// }
