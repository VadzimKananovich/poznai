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
		this.checkLocalStorage();
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
		this.element.addEventListener('series',(e)=>{
			e.preventDefault();
			localStorage.setItem('series',e.detail.id);
		})
	}
	checkLocalStorage(){
		if(!window.localStorage.getItem('series')){
			let title = this.dropDown.title;
			localStorage.setItem('series',title.dataset.id);
		} else {
			let local = window.localStorage.getItem('series');
			for(let i = 0; i<this.dropDown.links.length; i++){
				if(local === this.dropDown.links[i].dataset.id){
					this.dropDown.changeTitle(this.dropDown.links[i],this.dropDown.title,this.dropDown.links[i].dataset.id);
				}
			}
		}
	}
}
