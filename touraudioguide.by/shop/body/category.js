
class Category {
	constructor(array){
		this.array = array;
		this.createElement();
		this.init();
	}
	createElement(){
		let div = document.createElement('div');
		div.classList.add('category-container');
		this.element = div;
	}
	init(){
		this.createTitle();
		this.createContent();
		this.appendElements();
	}
	createTitle(){
		let categoryTitle = document.createElement('h3');
		categoryTitle.classList.add('category-title');
		let txtTitle = document.createTextNode(this.array[0]);
		categoryTitle.appendChild(txtTitle);
		this.element.appendChild(categoryTitle);
	}
	createContent(){
		let arrayContent = [];
		for(let i = 0; i < this.array[1].length;i++){
			let row = new RowItem(this.array[1][i].id,this.array[1][i].price);
			this.insertDates(row,this.array[1][i]);
			let arrayCategoryId = Number(this.array[1][i].price);
			while(arrayContent[arrayCategoryId]){
				arrayCategoryId++;
			}
			arrayContent[arrayCategoryId] = row.element;
		}
		let filterArrayContent = arrayContent.filter((el)=> el);
		this.items = filterArrayContent;
	}
	appendElements(){
			for(let i = 0; i < this.items.length; i++){
				this.element.appendChild(this.items[i]);
			}
		// let sort = localStorage.getItem('sort');
		// switch(sort){
		// 	case 'up':
		// 	for(let i = 0; i < this.items.length; i++){
		// 		this.element.appendChild(this.items[i]);
		// 	}
		// 	break;
		// 	case 'down':
		// 	for(let i = this.items.length-1; i >= 0; i--){
		// 		this.element.appendChild(this.items[i]);
		// 	}
		// 	break;
		// }
	}
	clearContent(){
		this.element.innerHTML = '';
	}

	insertDates(row,item){
		this.addText(row.title,item.name);
		this.addText(row.desc, item.description);
		// this.addText(row.currency, item.currency);
		// this.addText(row.price, item.price);
		let imgSrc = item.img;
		row.img.setAttribute('src',imgSrc);
		// row.controls.inputQuantity.setAttribute('min',item.minItem);
		// row.controls.inputQuantity.setAttribute('max',item.maxItem);
		// row.controls.inputQuantity.setAttribute('step',item.minItem);
		// row.controls.inputQuantity.setAttribute('value',item.minItem);
	}
	addText(container,text){
		let txt = document.createTextNode(text);
		container.appendChild(txt);
	}
}
