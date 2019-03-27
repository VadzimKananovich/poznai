class CategoryMenu extends MenuFunctions {
	constructor(array){
		super();
		this.array = array;
		this.init();
	}

	init(){
		this.createDropDownMenu();
		this.createElement();
		this.appendDropDownMenu();
		this.setLocalStorage();
		this.checkLocalStorage();
		this.changeOnScrollPage();
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
			let row = [newArray[i][0],newArray[i][2],i];
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
		this.element.addEventListener('category',(e)=>{
			e.preventDefault();
			localStorage.setItem('category',e.detail.id);
		})
	}
	checkLocalStorage(){
		if(!window.localStorage.getItem('category')){
			let title = this.dropDown.title;
			localStorage.setItem('category',title.dataset.id);
		} else {
			let local = window.localStorage.getItem('category');
			for(let i = 0; i<this.dropDown.links.length; i++){
				if(local === this.dropDown.links[i].dataset.id){
					this.dropDown.changeTitle(this.dropDown.links[i],this.dropDown.title,this.dropDown.links[i].dataset.id);
				}
			}
		}
	}
	setByLocalStorage(){
		let idItem = Number(window.localStorage.getItem('category'));
		this.dropDown.changeTitle(this.dropDown.links[idItem],this.dropDown.title,idItem);
	}
	changeOnScrollPage(){
		this.element.addEventListener('changeCategoryScroll',(e)=>{
			e.preventDefault();
			this.setByLocalStorage();
		})
	}
}
