class DoomBody {
	constructor (array) {
		this.shopBody = this.createResult(array);
		this.insertResult();
	}
	createResult (array) {
		let div = document.createElement('div');
		div.classList.add('result-wrapper');
		for(let i = 0; i < array.length; i++){
			let category = new Category(array[i],i).category;
			category.dataset.id = i;
			div.appendChild(category);
		}
		return div;
	}
	insertResult(){
		let buy = document.querySelector('#buy');
		buy.appendChild(this.shopBody);
	}

}


class ShopBody extends DoomBody {
	constructor(array){
		super(array);
		this.sortElements();
	}

	sortElements() {
		this.shopBody.addEventListener('sort', (e)=>{
			e.preventDefault();
			setTimeout(()=>{
				let visibleCategory = this.shopBody.querySelectorAll('.visible-category');
				for(let i = 0; i < visibleCategory.length; i++){
					let price = e.detail.price;
					let sortCategory = new CustomEvent('sortCategory', {bubbles: true, cancelable: true, detail:{'price':price}});
					visibleCategory[i].dispatchEvent(sortCategory);
				}
			},0);
		})
	}

}
