class AnimateBox {
	constructor(){
		this.container = document.querySelector('.animate-box');
		this.modal = document.querySelector('#modalTour');
		this.alltours = document.querySelector('#modalAllTours');
		this.init();
	}
	init(){
		this.vad = new JSONconnect('vadzim','arrogaminca');
		this.vad.connect()
		.then(this.vad.opentable.bind(this.vad,'home','tours'))
		.then(this.getDates.bind(this));
	}
	getDates(){
		this.tours = this.vad.bd.home.tours;
		this.getImgDir();
	}
	getImgDir(){
		this.img = [];
		for(let key in this.tours){
			let array = [];
			array.push(key);
			array.push(this.tours[key].img);
			this.img.push(array);
		}
		this.getImg()
		.then(this.getLinks.bind(this));
	}
	getImg(){
		let xhttp = new XMLHttpRequest();
		let url = 'includes/request.php?action=imgfromdir&img='+(encodeURIComponent(JSON.stringify(this.img)));
		xhttp.open('GET', url);
		xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhttp.send();
		return new Promise(this.resGetImg.bind(this,xhttp));
	}
	resGetImg(xhttp,resolve,reject){
		xhttp.onreadystatechange=()=>{
			if(xhttp.responseText){
				resolve(JSON.parse(xhttp.responseText));
			}
		}
	}

	getLinks(res){
		this.img = res;
		for(let i = 0; i < this.img.length; i++){
			for(let j = 0; j < this.img[i][1].length; j++){
				let image = new Image();
				image.src = this.img[i][1][j];
				this.img[i][1][j] = image;
			}
		}
		let links = this.container.querySelectorAll('.animate-box-link');
		let closeButton = this.modal.querySelector('.close-btn');
		let closeAllTours = this.alltours.querySelector('.close-btn');
		closeButton.addEventListener('click',(e)=>{
			this.modalToggleClass();
		});
		closeAllTours.addEventListener('click',(e)=>{
			this.modalToggleClass(this.alltours);
		});
		for(let i = 0; i < links.length; i++){
			links[i].addEventListener('click',(e)=>{
				e.preventDefault();
				this.initModal(e.currentTarget.dataset.tour);
			})
		}

	}
	initModal(tour){
		if(tour !== 'all'){
			let title = this.modal.querySelector('.modal-right-title');
			let desc = this.modal.querySelector('.modal-right-content');
			let price = this.modal.querySelector('.modal-right-price .price');
			let currency = this.modal.querySelector('.modal-right-price .currency');
			this.initCarousel(tour);
			title.innerHTML = this.tours[tour].name;
			desc.innerHTML = this.tours[tour].desc;
			price.innerHTML = this.tours[tour].price;
			currency.innerHTML = this.tours[tour].currency;
			this.modalToggleClass();
		} else {
			this.createAllModalContent();
			this.modalToggleClass(this.alltours);
		}
	}

	createAllModalContent(){
		let container = this.alltours.querySelector('.modal-right-content');
		container.innerHTML = '';
		for(let key in this.tours){
			container.appendChild(this.createRowAllModalContent(key));
			container.appendChild(this.createHR());
		}
	}

	createHR(){
		let hr = document.createElement('hr');
		return hr;
	}

	createRowAllModalContent(key){
		let div = document.createElement('div');
		div.className = 'row tour-row';
		div.appendChild(this.createColSlider(key));
		div.appendChild(this.createColContent(key));
		return div;
	}

	createColSlider(key){
		let col = document.createElement('div');
		col.className = 'col-md-5';
		let sliderWrap = document.createElement('div');
		sliderWrap.className = 'carousel-container';
		for(let i = 0 ; i < this.img.length; i++){
			if(this.img[i][0] === key){
				for(let j = 0; j < this.img[i][1].length; j++){
					let item = document.createElement('div');
					item.className = 'item';
					item.appendChild(this.img[i][1][j]);
					sliderWrap.appendChild(item);
				}
			}
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

	initCarousel(tour){
		let carousel = this.modal.querySelector('#modal-carousel');
		carousel.innerHTML = '';
		this.createCarousel(tour,carousel);
	}

	createCarousel(tour,carousel){
		let carouselContainer = document.createElement('div');
		carouselContainer.className = 'carousel-container';
		for(let j = 0; j < this.img.length; j++){
			if(this.img[j][0] === tour){
				for(let i = 0; i < this.img[j][1].length; i++){
					let item = document.createElement('div');
					item.className = 'item';
					item.appendChild(this.img[j][1][i]);
					carouselContainer.appendChild(item);
				}
			}
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

	modalToggleClass(modalWindow = this.modal){
		if(modalWindow.classList.contains('open-modal-right')){
			modalWindow.classList.remove('open-modal-right');
			document.body.style.overflow = 'auto';
		} else {
			modalWindow.classList.add('open-modal-right');
			document.body.style.overflow = 'hidden';
		}
	}

}
