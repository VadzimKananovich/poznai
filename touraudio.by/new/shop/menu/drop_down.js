class DomDropDown extends MenuFunctions {
	constructor(){
		super();
	}
	createUl (){
		let ul = document.createElement('ul');
		ul.className = 'buy-list hide';
		return ul;
	}
	createLi (className, txtName,id){
		let li = document.createElement('li');
		let spanIco = document.createElement('span');
		spanIco.classList.add('buy-menu-ico');
		let i = document.createElement('i');
		i.className = className;
		spanIco.appendChild(i);
		let spanName = document.createElement('span');
		spanName.classList.add('buy-menu-name');
		let text = document.createTextNode(txtName);
		spanName.appendChild(text);
		li.appendChild(spanIco);
		li.appendChild(spanName);
		li.classList.add('menu-li');
		li.dataset.id = id;
		return li;
	}
	createTitle () {
		let pMenu = document.createElement('p');
		pMenu.classList.add('buy-menu-title');
		return pMenu;
	}
	createContainer() {
		let menu = document.createElement('div');
		menu.classList.add('drop-down-menu');
		let title = this.createTitle();
		let ul = this.createUl();
		menu.appendChild(title);
		menu.appendChild(ul);
		return menu;
	}
}




class DropDownControls extends DomDropDown {
	constructor(){
		super();
		this.inMove = false;
	}
	showHide (e, height = false) {
		if(!this.inMove){
			this.inMove = true;
			if (e.classList.contains('hide')){
				e.setAttribute('style', 'height:0; opacity: 0');
				e.classList.remove('hide');
				e.style.height = 'auto';
				setTimeout(()=>{
					let eHeight = !height ? e.offsetHeight : height;
					e.style.height = 0;
					e.style.opacity = 1;
					e.style.height = `${eHeight}px`;
					e.style.overflow = 'auto';
				},0);
				setTimeout(()=> this.inMove = false,400);
			} else {
				this.inMove = true;
				e.removeAttribute('style');
				e.classList.add('hide');
				setTimeout(()=> this.inMove = false,400);
			}
		}
	}
	changeTitle(from,to,id){
		to.innerHTML = '';
		let content = from.childNodes;
		for(let i =0; i < content.length; i++){
			let copy = content[i];
			to.appendChild(copy.cloneNode(true));
		}
		to.dataset.id = id;
	}
}




class DropDown extends DropDownControls {
	constructor(array, customEvent){
		super();
		this.eventName = customEvent;
		this.listItems = array;
		this.createMenu();
	}

	createMenu (){
		this.menu = this.createList();
		this.setState('close');
		this.addEventList();
	}

	createList () {
		let menu = this.createContainer();
		let title = menu.querySelector('.buy-menu-title');
		let ul = menu.querySelector('.buy-list');
		for(let i = 0; i < this.listItems.length; i++){
			let li = this.createLi(this.listItems[i][1],this.listItems[i][0],this.listItems[i][2]);
			ul.appendChild(li);
		}
		let firstEl = this.createLi(this.listItems[0][1],this.listItems[0][0],this.listItems[0][2]);
		this.changeTitle(firstEl,title,firstEl.dataset.id);
		menu.appendChild(title);
		menu.appendChild(ul);
		return menu;
	}
	setState(state) {
		let title = this.menu.querySelector('.buy-menu-title');
		let ul = this.menu.querySelector('.buy-list');
		switch (state) {
			case 'open':
			if(ul.classList.contains('hide')){
				this.showHide(ul);
			}
			break;
			case 'close':
			if(!ul.classList.contains('hide')){
				this.showHide(ul);
			}
			break;
		}

		title.addEventListener('click', ()=>{
			this.showHide(ul);
		})
	}

	addEventList() {
		let els = this.menu.querySelectorAll('.menu-li');
		let title = this.menu.querySelector('.buy-menu-title');
		for(let i = 0; i < els.length; i++){
			els[i].addEventListener('click', (e) => {
				e.currentTarget.dispatchEvent(
					new CustomEvent(this.eventName, {bubbles: true, cancelable: true, detail:{'id':e.currentTarget.dataset.id}})
				);
				this.changeTitle(els[i],title,els[i].dataset.id);
				this.showHide(this.menu.querySelector('.buy-list'));
			});
		}
	}
}
