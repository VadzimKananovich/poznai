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
		let title = this.element.querySelector('.buy-menu-title');
		localStorage.setItem('sort',title.dataset.id);
		this.element.addEventListener('sort',(e)=>{
			e.preventDefault();
			localStorage.setItem('sort',e.detail.id);
		})
	}
}
