//
// class DomSetAlert {
// 	constructor(){
// 		this.checkBox = [];
// 		this.createElement();
// 	}
// 	createElement(){
// 		let div = document.createElement('div');
// 		div.classList.add('set-alert-container');
// 		div.appendChild(this.createTitle());
// 		this.createDropDown();
// 		div.appendChild(this.dropDown);
// 		this.element = div;
// 	}
// 	createTitle(){
// 		this.title = document.createElement('p');
// 		this.title.classList.add('set-alert-title');
// 		return this.title;
// 	}
// 	createDropDown(){
// 		this.dropDown = document.createElement('ul');
// 		this.dropDown.classList.add('set-alert-menu');
// 	}
// 	createMenuItem(name,e){
// 		let li = document.createElement('li');
// 		li.classList.add('set-alert-item');
// 		let label = document.createElement('span');
// 		label.classList.add('set-alert-label');
// 		label.innerHTML = name;
// 		let checkWrap = document.createElement('div');
// 		checkWrap.className = 'box_1';
// 		checkWrap.dataset.event = e;
// 		let input = this.createCheckInput();
// 		checkWrap.appendChild(input);
// 		input.dispatchEvent(new CustomEvent('click'));
// 		li.appendChild(checkWrap);
// 		li.appendChild(input);
// 		this.checkBox.push([input,true]);
// 		return li;
// 	}
// 	createCheckInput(){
// 		let input = document.createElement('input');
// 		input.classList.add('switch_1');
// 		input.setAttribute('type','checkbox');
// 		return input;
// 	}
// }
//
//
// class SetAlert extends DomSetAlert{
// 	constructor(){
// 		super();
// 		this.init();
// 	}
//
// 	init(){
// 		this.title.innerHTML = 'Уведомления';
// 		this.dropDown.appendChild(this.createMenuItem('Добавлен в корзину','addToCart'));
// 		this.dropDown.appendChild(this.createMenuItem('Изменилось колличество','changeCartQuantity'));
// 		this.dropDown.appendChild(this.createMenuItem('Подтверждение удаления','confirmRemove'));
// 	}
//
// 	setLocalStorage() {
// 		let title = this.element.querySelector('.buy-menu-title');
// 		localStorage.setItem('display',title.dataset.id);
// 		this.element.addEventListener('display',(e)=>{
// 			e.preventDefault();
// 			localStorage.setItem('display',e.detail.id);
// 		})
// 	}
// }
