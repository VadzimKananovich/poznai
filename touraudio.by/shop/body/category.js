class DomCategory {
	constructor() {
		this.categoryContainer = this.createCategoryContainer();
	}
	createCategoryContainer() {
		let div = document.createElement('div');
		div.classList.add('category-container');
		let categoryTitle = document.createElement('h3');
		categoryTitle.classList.add('category-title');
		div.appendChild(categoryTitle);
		return div;
	}
}

class ControlCategory extends DomCategory {
	constructor() {
		super();
		this.sortElements();
	}

	sortElements() {
		this.categoryContainer.addEventListener('sortCategory', (e) => {

		});
	}
}


class Category extends ControlCategory {
	constructor(array){
		super();
		this.category = this.categoryContainer;
		this.createCategory(array);
	}
	createCategory(array,id){
		let title = this.categoryContainer.querySelector('.category-title');
		let txtTitle = document.createTextNode(array[0]);
		title.appendChild(txtTitle);
		for(let i = 0; i < array[1].length; i++){
			let item = new RowItem(array[1][i]).container;
			this.categoryContainer.appendChild(item);
		}
	}
}
