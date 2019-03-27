class ShowTourModal {
	constructor(id,tours){
		this.container = document.querySelector('#'+id);
		this.modal = document.querySelector('#modalTour');
		this.alltours = document.querySelector('#modalAllTours');
		this.modalRequest = document.querySelector('#modalRequest');
		this.category = this.container.dataset.category;
		this.tours = tours;
		this.toDelete = document.querySelector('#toDelete');
		this.init();
	}

	init(){
		if(!this.tours){
			this.toursConnect = new GetTours(this.category);
			this.toursConnect.init()
			.then((res)=>{
				this.tours = res;
			});
		}
	}
	initModalSearch(tour,path){
		if(path && path === this.category){
			this.initModal(tour);
		}
	}
	initModal(tour){
		this.showModal();
		this.createCloseBtn();
		let title = this.modal.querySelector('.modal-right-title');
		let desc = this.modal.querySelector('.modal-right-content');
		let program = this.modal.querySelector('.modal-tour-program');
		let route = this.modal.querySelector('.modal-tour-route');
		let duration = this.modal.querySelector('.modal-tour-duration');
		let price = this.modal.querySelector('.modal-right-price .price');
		let currency = this.modal.querySelector('.modal-right-price .currency');
		let splitTour = tour.split('%');
		this.sendRequest = this.modal.querySelector('#sendRequest');
		let tourKey = splitTour[0];
		let tourIndex = Number(splitTour[1]);
		this.checkDateElement();
		if(this.tours[tourKey][tourIndex].date){
			this.createRowDate(this.tours[tourKey][tourIndex].date);
		}
		this.initSendRequest(tourKey,tourIndex);
		this.initCarousel(tourKey,tourIndex);
		title.innerHTML = this.tours[tourKey][tourIndex].name;
		desc.innerHTML = this.tours[tourKey][tourIndex].desc;
		program.innerHTML = this.tours[tourKey][tourIndex].program;
		route.innerHTML = this.tours[tourKey][tourIndex].route;
		duration.innerHTML = this.tours[tourKey][tourIndex].duration;
		price.innerHTML = this.tours[tourKey][tourIndex].price;
		currency.innerHTML = this.tours[tourKey][tourIndex].currency;
	}
	createRowDate(date){
		let el = this.modal.querySelector('.route-wrap');
		let wrap = document.createElement('p');
		wrap.className = 'modal-route-content date-wrap';
		let name = document.createElement('span');
		name.className = 'title-text';
		name.appendChild(document.createTextNode('Дата выезда: '));
		let dateTxt = document.createElement('span');
		dateTxt.className = 'modal-tour-date';
		dateTxt.appendChild(document.createTextNode(date));
		wrap.appendChild(name);
		wrap.appendChild(dateTxt);
		el.parentNode.insertBefore(wrap,el);
	}
	checkDateElement(){
		let el = this.modal.querySelector('.date-wrap');
		if(el){
			el.parentNode.removeChild(el);
		}
	}
	createCloseBtn(){
		let closeBtnWrap = this.modal.querySelector('.close-btn-wrap');
		closeBtnWrap.innerHTML = '';
		let div = document.createElement('div');
		div.className = 'close-btn';
		let i =document.createElement('i');
		i.className = 'fas fa-window-close';
		div.appendChild(i);
		closeBtnWrap.appendChild(div);
		div.addEventListener('click',(e)=>{
			if(this.toDelete){
				this.toDelete.parentNode.removeChild(this.toDelete);
			}
			this.hideModal();
			history.pushState("", document.title, window.location.pathname);
		});
	}


	createHR(){
		let hr = document.createElement('hr');
		return hr;
	}


	createColSlider(key){
		let col = document.createElement('div');
		col.className = 'col-md-5';
		let sliderWrap = document.createElement('div');
		sliderWrap.className = 'carousel-container';
		for(let i = 0 ; i < this.tours[key].img.length; i++){
			let item = document.createElement('div');
			item.className = 'item';
			item.appendChild(this.tours[key].img[i]);
			sliderWrap.appendChild(item);
		}
		$(sliderWrap).owlCarousel({
			navigation: false,
			slideSpeed: 300,
			paginationSpeed: 400,
			autoPlay: 6000,
			addClassActive: true,
			singleItem: true
		});
		col.appendChild(sliderWrap);
		return col;
	}

	createColContent(key){
		let col = document.createElement('col');
		col.className = 'col-md-7';
		let wrap = document.createElement('div');
		wrap.className = 'modal-right-container';
		wrap.appendChild(this.createTitle(key));
		wrap.appendChild(this.createContent(key));
		let button = document.createElement('button');
		button.className = 'btn btn-success';
		button.setAttribute('type','button');
		button.dataset.toggle = 'modal';
		button.dataset.target = '#modalRequest';
		button.innerHTML = 'Предварительный заказ';
		wrap.appendChild(button);
		col.appendChild(wrap);
		return col;
	}

	createTitle(key){
		let div = document.createElement('div');
		div.className = 'modal-right-row-title';
		let p = document.createElement('p');
		p.className = 'modal-tour-title';
		p.innerHTML = this.tours[key].name;
		div.appendChild(p);
		div.appendChild(this.createPrice(key));
		return div;
	}

	createPrice(key){
		let p = document.createElement('p');
		p.className = 'modal-right-price';
		p.innerHTML = 'от ';
		let price = document.createElement('span');
		price.className = 'price';
		price.innerHTML = this.tours[key].price;
		p.appendChild(price);
		let currency = document.createElement('span');
		currency.innerHTML = this.tours[key].currency;
		currency.className = 'currency';
		p.appendChild(currency);
		return p;
	}

	createContent(key){
		let p = document.createElement('p');
		p.className = 'modal-right-content';
		p.innerHTML = this.tours[key].desc;
		return p;
	}

	initCarousel(key,index){
		let carousel = this.modal.querySelector('#modal-carousel');
		carousel.innerHTML = '';
		this.createCarousel(key,index,carousel);
	}

	initSendRequest(key,index){
		this.sendRequest.addEventListener('click',(e)=>{
			let path = window.location.pathname;
			let dir;
			if(path.includes('belarus')){
				dir = 'Экскурсии по Беларуси';
			}
			if(path.includes('foreigners')){
				dir = 'Туры в Беларуси';
			}
			let input = this.modalRequest.querySelector('#tourInput');
			let tour = JSON.stringify(dir+' / '+this.tours[key][0]+' / '+this.tours[key][index].name);
			input.value = tour;
		});
	}

	createCarousel(key,index,carousel){
		let carouselContainer = document.createElement('div');
		carouselContainer.className = 'carousel-container';
		if(this.tours[key][index].img.length){
			for(let i = 0; i < this.tours[key][index].img.length; i++){
				let item = document.createElement('div');
				item.className = 'item';
				let img = new Image();
				img.src = this.tours[key][index].img[i];
				item.appendChild(img);
				carouselContainer.appendChild(item);
			}
		} else {
			let item = document.createElement('div');
			item.className = 'item';
			let img = new Image();
			img.src = 'img/belarus.jpg';
			item.appendChild(img);
			carouselContainer.appendChild(item);
		}
		$(carouselContainer).owlCarousel({
			navigation: false,
			slideSpeed: 300,
			paginationSpeed: 400,
			autoPlay: 6000,
			addClassActive: true,
			singleItem: true
		});
		carousel.appendChild(carouselContainer);
	}

	hideModal(){
		if(this.modal.classList.contains('open-modal-right')){
			this.modal.style.left = '100%';
			setTimeout(()=>{
				this.modal.classList.remove('open-modal-right');
			},400);
			document.body.style.overflow = 'auto';
		}
	}
	showModal(){
		if(!this.modal.classList.contains('open-modal-right')){
			this.modal.style.left = '100%';
			setTimeout(()=>{
				this.modal.classList.add('open-modal-right');
				setTimeout(()=>{
					this.modal.style.left = '0';
				},0);
			},0);
			document.body.style.overflow = 'hidden';
		}
	}
}
