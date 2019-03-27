class Sort extends MenuFunctions {
	constructor(array){
		super();
		this.array = array;
		this.createSort();
	}

	createSort(){
		this.createDropDownMenu();
		this.createElement();
		this.appendDropDownMenu();
		this.setLocalStorage();
		this.checkLocalStorage();
	}

	createDropDownMenu() {
		this.dropDown =  new DropDown(this.createSortArray(),'sort');
	}

	createSortArray(){
		let newArray = [];
		let upRow = ['По возрастанию цены','fas fa-arrow-up','up'];
		let downRow = ['По убыванию цены','fas fa-arrow-down','down'];
		newArray.push(upRow,downRow);
		return newArray;
	}

	createElement() {
		let container = this.createBlockTitle('Сортировать:');
		this.element = container;
	}

	appendDropDownMenu(){
		this.element.appendChild(this.dropDown.menu);
	}

	setLocalStorage() {
		this.element.addEventListener('sort',(e)=>{
			e.preventDefault();
			localStorage.setItem('sort',e.detail.id);
		})
	}
	checkLocalStorage(){
		if(!window.localStorage.getItem('sort')){
			let title = this.dropDown.title;
			localStorage.setItem('sort',title.dataset.id);
		} else {
			let local = window.localStorage.getItem('sort');
			for(let i = 0; i<this.dropDown.links.length; i++){
				if(local === this.dropDown.links[i].dataset.id){
					this.dropDown.changeTitle(this.dropDown.links[i],this.dropDown.title,this.dropDown.links[i].dataset.id);
				}
			}
		}
	}
}
