class Series extends MenuFunctions {
	constructor(array){
		super();
		this.array = array;
		this.createSeries();
	}

	createSeries(){
		this.createDropDownMenu();
		this.createElement();
		this.appendDropDownMenu();
		this.setLocalStorage();
	}

	createDropDownMenu() {
		this.dropDown =  new DropDown(this.createSeriesArray(),'series');
	}

	createSeriesArray(){
		let newArray = [];
		for(let i = 0; i < this.array.length; i++){
			let row = [this.array[i][0],'fas fa-mobile-alt',this.array[i][0]];
			newArray.push(row);
		}
		return newArray;
	}

	createElement() {
		let container = this.createBlockTitle('Серия:');
		this.element = container;
	}

	appendDropDownMenu(){
		this.element.appendChild(this.dropDown.menu);
	}

	setLocalStorage() {
		let title = this.element.querySelector('.buy-menu-title');
		localStorage.setItem('series',title.dataset.id);
		this.element.addEventListener('series',(e)=>{
			e.preventDefault();
			localStorage.setItem('series',e.detail.id);
		})
	}
}
