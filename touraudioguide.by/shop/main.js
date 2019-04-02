let shop = window.location.href.indexOf('equip') != -1 ? true : false;

class Shop {
	constructor(array,sectionId){
		this.sectionId = sectionId;
		this.allProducts = array;
		this.array = new ShopArray(array).array;
		this.createElement();
		// this.initCommonFunctions();
	}
	createElement(){
		this.element = document.querySelector(this.sectionId);
		this.createChangeSeriesButtons();
		this.checkButtonsClass();
		// this.menu = new Menu(this.array,this.allProducts);
		this.body = new ShopBody(this.array);
		// this.element.appendChild(this.menu.element);
		this.element.appendChild(this.body.element);
		this.checkSeries();
		this.body.element.classList.add('display-list');

	}
	createChangeSeriesButtons(){
		let btnWrap = document.createElement('div');
		btnWrap.classList.add('change-series-btn-wrap');
		let labelBeforeBtn = this.createLabelBeforeBtn();
		btnWrap.appendChild(labelBeforeBtn);
		this.buttonsChangeSeries = [];
		for(let i = 0; i < this.array.length; i++){
			let button = this.createButton(this.array[i][0]);
			this.buttonsChangeSeries.push(button);
			btnWrap.appendChild(button);
		}
		this.element.appendChild(btnWrap);
	}
	createButton (label) {
		let button = document.createElement('button');
		button.className = 'btn btn-primary button_12  wow fadeInUp  js-scroll-trigger';
		button.innerHTML = label;
		button.setAttribute('style','visibility: visible; animation-delay:  0.5s; animation-name: fadeInUp;');
		button.dataset.id=label;
		this.initButton(button);
		return button
	}
	createLabelBeforeBtn(){
		let h4 = document.createElement('h4');
		h4.className = 'change-series-title';
		h4.innerHTML = 'Выберите серию: ';
		return h4;
	}
	initButton(button){
		button.addEventListener('click',(e)=>{
			window.localStorage.setItem('series',e.currentTarget.dataset.id);
			this.switchClassButton(e.currentTarget.dataset.id);
			e.currentTarget.dispatchEvent(new CustomEvent('series',{bubbles: true,cancelable: true}));
		})
	}
	checkButtonsClass(){
		let series = window.localStorage.getItem('series');
		for(let i = 0; i < this.buttonsChangeSeries.length; i++){
			if(this.buttonsChangeSeries[i].dataset.id === series){
				this.switchClassButton(this.buttonsChangeSeries[i].dataset.id);
			}
		}
	}
	switchClassButton(id){
		for(let i = 0; i < this.buttonsChangeSeries.length; i++){
			if(this.buttonsChangeSeries[i].dataset.id !== id){
				if(this.buttonsChangeSeries[i].classList.contains('active')){
					this.buttonsChangeSeries[i].classList.remove('active');
				}
			} else {
				if(!this.buttonsChangeSeries[i].classList.contains('active')){
					this.buttonsChangeSeries[i].classList.add('active');
				}
			}
		}
	}
	checkSeries(){
		this.element.addEventListener('series', (e)=>{
			e.preventDefault();
			this.body.clearContent();
			this.body.init();
			// this.shop.getPosition();
			// this.checkDisplay();
		})
	}
	initCommonFunctions(){
		setTimeout(()=>{
			this.slideScroll = new SlideScroll(this.body,this.menu,this);
			this.verticalScroll = new VerticalSlide(this);
			let checkDisplay = new CheckDisplay(this);
			let checkSeries = new CheckSeries(this);
			let checkSort = new CheckSort(this.body,this.element);
			let searching = new Searching(this);
			let checkCategory = new CheckCategory(this);
			let OpenedDropDown = new DropDownClose(this.element,this.menu);
			let addToCart = new AddToCart(this);
			let removeFromCart = new RemoveFromCart(this);
			let errorAlert = new MsgAlert(this);
			let viewProduct = new ViewProduct(this);
			let completeOrder = new CompleteOrder(this);
			let removeAll = new RemoveAll(this);
		},0);
	}

	addToCart(){
		this.body.shopBody.addEventListener('cart',(e)=>{
			e.preventDefault();
			setTimeout(()=>{
				this.menu.cart.dispatchEvent(e);
			},0);
		})
	}
	sort() {
		this.menu.sort.addEventListener('sort',(e)=>{
			e.preventDefault();
			setTimeout(()=>{
				this.body.shopBody.dispatchEvent(e);
			},0);
		});
	}
	getPosition(){
		let id = window.localStorage.getItem('category');
		let display = localStorage.getItem('display');
		switch(display){
			case 'list':
			this.body.element.classList.add('display-list');
			this.slideScroll.scrollTo(0,300);
			this.verticalScroll.scrollTo(id);
			break;
			case 'slide':
			if(this.body.element.classList.contains('display-list')){
				this.body.element.classList.remove('display-list');
				this.verticalScroll.scrollTo(0);
				this.slideScroll.scrollTo(id);
			}
			break;
		}
	}
}
