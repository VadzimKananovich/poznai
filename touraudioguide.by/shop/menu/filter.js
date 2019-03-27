class Filter {
	constructor(array){
		this.array = array;
		this.createElement();
		this.openedDropDown = false;
		this.initControls();
	}
	createElement(){
		this.series = new Series(this.array);
		this.category = new CategoryMenu(this.array);
		this.sort = new Sort();
		this.display = new Display();
		// this.setAlert = new SetAlert();
		this.element = this.createWrapper();
		this.appendChilds(this.series.element,this.category.element,this.sort.element,this.display.element);
	}
	initControls(){
		this.changeSeries();
		this.hideControls();
		this.showControls();
		this.changeOnClick();
	}
	createWrapper(){
		let div = document.createElement('div');
		div.classList.add('menu-row-controls');
		div.classList.add('controls-hide');
		let button = document.createElement('div');
		button.classList.add('menu-controls-element');
		button.classList.add('filter-button');
		let i = document.createElement('i');
		i.className = 'fas fa-sliders-h';
		let p = document.createElement('p');
		p.classList.add('menu-controls-button');
		let txt = document.createTextNode('Параметры');
		p.appendChild(txt);
		button.appendChild(i);
		button.appendChild(p);
		div.appendChild(button);
		this.button = button;
		return div;
	}
	appendChilds(...childs){
		let div = document.createElement('div');
		div.classList.add('filter-elements-wrap');
		div.classList.add('menu-dropdown-container');
		for(let i = 0; i < childs.length; i++){
			div.appendChild(childs[i]);
		}
		this.element.appendChild(div);
	}


	changeSeries() {
		this.element.addEventListener('series',(e)=>{
			this.category.dropDown.menu.parentElement.removeChild(this.category.dropDown.menu);
			this.category.createDropDownMenu();
			this.category.appendDropDownMenu();
			this.category.setByLocalStorage();
		})
	}
	hideControls(){
		this.element.addEventListener('hideControls',(e)=>{
			e.preventDefault();
			this.series.element.classList.add('hide-opacity');
			this.category.element.classList.add('hide-opacity');
			this.sort.element.classList.add('hide-opacity');
			this.display.element.classList.add('hide-opacity');
		})
	}
	showControls(){
		this.element.addEventListener('showControls',(e)=>{
			e.preventDefault();
			this.series.element.classList.remove('hide-opacity');
			this.category.element.classList.remove('hide-opacity');
			this.sort.element.classList.remove('hide-opacity');
			this.display.element.classList.remove('hide-opacity');
		})
	}
	changeOnClick(){
		this.button.addEventListener('click',(e)=>{
			e.preventDefault();
			this.showHide();
		});
	}
	showHide(){
		if(this.element.classList.contains('controls-hide')){
			this.element.dispatchEvent(new CustomEvent('openedDropDown', {bubbles: true, cancelable: true}));
			this.openedDropDown = true;
			this.element.style.opacity = '0';
			this.element.style.height = 'auto';
			this.element.style.width = 'auto';
			let height = this.element.offsetHeight;
			let width = this.element.offsetWidth;
			this.element.removeAttribute('style');
			this.element.classList.remove('controls-hide');
			setTimeout(()=>{
				this.element.style.height = `${height}px`;
				this.element.style.width = `${width}px`;
				setTimeout(()=>{
					this.element.style.height = 'auto';
					this.element.style.width = 'auto';
				},300)
			},0);
		} else {

			this.openedDropDown = false;
			this.element.dispatchEvent(new CustomEvent('closeAll', {bubbles: true, cancelable: true}));
			let height = this.element.offsetHeight;
			let width = this.element.offsetWidth;
			this.element.style.height = `${height}px`;
			this.element.style.width = `${width}px`;
			setTimeout(()=>{
				this.element.removeAttribute('style');
				this.element.classList.add('controls-hide');
			},0)
		}
	}
}
