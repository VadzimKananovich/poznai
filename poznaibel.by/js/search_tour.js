class SearchTour{
	constructor(type){
		this.type = type;
		this.toursClass = new GetTours(type);
		this.getDomElements();
		this.getTours();
	}
	getDomElements(){
		this.menu = document.querySelector('#typeTour');
		this.placesContainer = document.querySelector('#placesTours');
		this.filterRes = document.querySelector('#filterRes');
		this.filterRes.dataset.category = this.type;
	}
	getTours(){
		this.toursClass.init()
		.then((res)=>{
			this.tours = res;
			this.toursModal = new ShowTourModal('filterRes',this.tours);
			this.createMenu();
			this.createPlaces();
		});
	}

	//===========================================
	//CREATE MENU
	//===========================================
	createMenu(){
		for(let key in this.tours){
			this.menu.appendChild(this.createOption(key,this.tours[key][0]));
		}
		this.initMenu();
	}
	createOption(key,name){
		let option = document.createElement('option');
		option.value = key;
		option.appendChild(document.createTextNode(name));
		return option;
	}
	initMenu(){
		this.createPlaces();
		this.createFilterRes();
		this.menu.addEventListener('change',()=>{
			this.createPlaces();
			this.createFilterRes();
		});
	}

	//===========================================
	//GET ALL PLACES OF TOURS
	//===========================================
	createPlaces(){
		this.resPlaces = [];
		for(let i = 1; i < this.tours[this.menu.value].length; i++){
			let tour = this.tours[this.menu.value][i];
			if(tour.hasOwnProperty('place')){
				let place = tour.place.split(',');
				for(let j = 0; j < place.length; j++){
					place[j].trim();
					if(this.resPlaces.indexOf(place[j]) === -1){
						this.resPlaces.push(place[j]);
					}
				}
			}
		}
		this.createCheckBox();
	}
	createCheckBox(){
		this.placesContainer.innerHTML = '';
		this.checkBox = [];
		for(let i = 0; i < this.resPlaces.length; i++){
			let checkBox = this.createCheckRow(this.resPlaces[i]);
			this.placesContainer.appendChild(checkBox);
		}
	}
	createCheckRow(name){
		let label = document.createElement('label');
		label.className = 'form-check-label add-text text-left mrb-1';
		label.appendChild(this.createCheckInput(name));
		label.appendChild(document.createTextNode(name));
		return label;
	}
	createCheckInput(){
		let input = document.createElement('input');
		input.type = 'checkbox';
		input.className = 'form-check-input';
		this.initCheckBox(input);
		return input;
	}

	initCheckBox(input){
		input.addEventListener('change', (e)=>{
			if(e.currentTarget.checked){
				if(this.checkBox.indexOf(e.currentTarget.nextSibling.nodeValue) === -1){
					this.checkBox.push(e.currentTarget.nextSibling.nodeValue);
				}
			} else {
				if(this.checkBox.indexOf(e.currentTarget.nextSibling.nodeValue) > -1){
					this.checkBox.splice(this.checkBox.indexOf(e.currentTarget.nextSibling.nodeValue),1);
				}
			}
			this.createFilterRes();
		});
	}


	//===========================================
	//CREATE RESULT FILTER
	//===========================================
	createFilterRes(){
		this.filterRes.innerHTML = '';
		if(this.resPlaces.length){
			if(!this.checkBox.length){
				this.insertError('Выберите что вы хотите посетить');
			} else {
				this.createArrayResult();
				this.insertResult();
			}
		} else {
			this.insertError('К сожалению по вашим критериям ничего не найдено');
		}

	}
	createArrayResult(){
		this.resSearch = [];
		for(let i = 0; i < this.checkBox.length; i++){
			let tour = this.tours[this.menu.value];
			for(let j = 1; j < tour.length; j++){
				if(tour[j].hasOwnProperty('place')){
					if(tour[j].place.includes(this.checkBox[i])){
						let exist = 0;
						for(let s = 0; s < this.resSearch.length; s++){
							if(this.resSearch[s][0].name === tour[j].name){
								exist++;
							}
						}
						if(!exist){
							let resArray = [tour[j],j];
							this.resSearch.push(resArray);
						}
					}
				}
			}
		}
	}
	insertResult(){
		let table = document.createElement('table');
		table.className = 'table table-res-search';
		table.appendChild(this.createHead());
		table.appendChild(this.createBody());
		this.filterRes.appendChild(table);
	}
	createHead(){
		let thead = document.createElement('thead');
		let tr = document.createElement('tr');
		tr.appendChild(this.createTextTd('Маршрут',true));
		tr.appendChild(this.createTextTd('Стоимость',true));
		thead.appendChild(tr);
		return thead;
	}
	createBody(){
		let tbody = document.createElement('tbody');
		for(let i = 0; i < this.resSearch.length; i++){
			tbody.appendChild(this.createRow(this.resSearch[i][0],this.resSearch[i][1]));
		}
		return tbody;
	}
	createRow(item,index){
		let tr = document.createElement('tr');
		tr.className = 'open-modal-link';
		tr.dataset.tour = this.menu.value+'%'+index;
		tr.dataset.hashLink = '!tour='+this.type+'&key='+this.menu.value+'&index='+index;
		tr.appendChild(this.createTextTd(item.route));
		let priceTxt = 'от '+item.price+' '+item.currency;
		tr.appendChild(this.createTextTd(priceTxt));
		this.initRow(tr);
		return tr;
	}
	createTextTd(txt,head=false){
		let col;
		if(head){
			col = document.createElement('th');
			col.scope = 'col';
		} else {
			col = document.createElement('td');
		}
		col.innerHTML = txt;
		return col;
	}
	createResTr(el){
		let tr = document.createElement('tr');
		tr.appendChild(this.createTd())
	}
	initRow(item){
		item.addEventListener('click',(e)=>{
			window.location.hash = item.dataset.hashLink;
			this.toursModal.initModal(item.dataset.tour);
		});
	}

	insertError(txt) {
		let p = document.createElement('p');
		p.className = 'error-text';
		p.appendChild(document.createTextNode(txt));
		this.filterRes.appendChild(p);
	}
}
