class ProgramDays{
	constructor(selector,path,type,url){
		this.container = document.querySelector(selector);
		this.path = path;
		this.type = type;
		this.url = url;
		this.http = new XMLHttpRequest();
		this.init();
	}
	init(){
		this.sendRequest()
		.then(this.writeDates.bind(this));
	}
	writeDates(res){
		this.dates = JSON.parse(res);
		if(this.type === 'single'){
			this.initSingleProgram();
		}
		if(this.type === 'modal'){
			this.getModal();
			this.createModalRow();
		}
	}

	getModal(){
		this.modal = {};
		this.modal.container = document.querySelector('#modalProgram');
		this.modal.title = this.modal.container.querySelector('.day-number');
		this.modal.carousel = this.modal.container.querySelector('.modal-carousel');
		this.modal.programTitle = this.modal.container.querySelector('.modal-program-title');
		this.modal.programContent = this.modal.container.querySelector('.modal-program-content');
	}

	createModalRow(){
		let row = document.createElement('div');
		row.className = 'slider-program-row';
		row.appendChild(this.createDayTitle(this.stripTags(this.dates.title)));
		let slider = document.createElement('div');
		slider.className = 'owl-carousel owl-theme';
		slider.id = 'modalProgramSlider';
		this.dates.program.forEach((item,i)=>slider.appendChild(this.createCardSlider(item,i)));
		this.initCardCarousel(slider);
		row.appendChild(slider);
		this.container.appendChild(row);
	}

	createCardSlider(item,i){
		let sliderItem = document.createElement('div');
		sliderItem.className = 'program-card item';
		sliderItem.setAttribute('style','background-image: url(\''+this.url+this.createPath(item.imgPath)+item.img[0]+'\');');
		sliderItem.appendChild(this.createCardTitleDesc(this.stripTags(item.desc),this.stripTags(item.name)));
		this.initCardModal(sliderItem,i);
		return sliderItem;
	}
	createCardImg(src){
		let img = new Image();
		img.src = src;
		return img;
	}
	createCardTitleDesc(desc,title){
		let wrap = document.createElement('div');
		wrap.className = 'car-content-wrap';
		let h6 = document.createElement('h6');
		h6.className = 'card-title';
		h6.innerHTML = title;
		wrap.appendChild(h6);
		wrap.appendChild(this.createCardContent(desc));
		return wrap;
	}
	createCardContent(desc){
		let content = desc.length > 200 ? desc.substring(0,197)+'...' : desc;
		let p = document.createElement('p');
		p.className = 'card-content';
		p.innerHTML = content;
		return p;
	}

	initCardModal(item,i){
		item.addEventListener('click',(e)=>{
			let object = this.dates.program[Number(i)];
			this.modal.title.innerHTML = this.stripTags(this.dates.title);
			this.modal.programTitle.innerHTML = this.stripTags(object.name);
			this.modal.programContent.innerHTML = this.stripTags(object.desc);
			this.modal.carousel.innerHTML = '';
			let path = this.createPath(object.imgPath);
			let carouselWrap = document.createElement('div');
			carouselWrap.className = 'owl-carousel';
			object.img.forEach(item => carouselWrap.appendChild(this.createCarouselItem(this.url+path+item)));
			if(this.modal.carousel.querySelector('.owl-carousel')){
				let oldCarousel = this.modal.querySelector('.owl-carousel');
				oldCarousel.parentNode.removeChild(oldCarousel);
			}
			this.modal.carousel.appendChild(carouselWrap);
			this.initCarousel(carouselWrap);
			$(this.modal.container).modal('show');
		});
	}

	initSingleProgram(){
		let img = [];
		let path = this.dates.program[0].imgPath;
		this.dates.program[0].img.forEach(item=>img.push(this.url+this.createPath(path)+item));
		this.container.appendChild(this.createSingleProgram(
			this.stripTags(this.dates.title),
			this.stripTags(this.dates.program[0].name),
			img,
			this.stripTags(this.dates.program[0].desc)
		));
	}

	createSingleProgram(dayTitlePass,programTitle,img,desc){
		let wrap = document.createElement('div');
		wrap.className = 'day-program-wrapper';
		let dayTitle = this.createDayTitle(dayTitlePass);
		let singleProgramRow = document.createElement('div');
		singleProgramRow.classList='single-program-row';
		let carousel = this.createCarousel(img);
		this.initCarousel(carousel);
		let content = this.createSingleProgramContent(programTitle,desc);
		singleProgramRow.appendChild(carousel);
		singleProgramRow.appendChild(content);
		wrap.appendChild(dayTitle);
		wrap.appendChild(singleProgramRow);
		return wrap;
	}
	createDayTitle(title){
		let h5 = document.createElement('h5');
		h5.className = 'day-program-title';
		h5.innerHTML = title;
		return h5;
	}
	createCarousel(img){
		let wrap = document.createElement('div');
		wrap.className = 'owl-carousel owl-theme aos-el';
		wrap.setAttribute('data-aos','fade-right');
		wrap.id = '#singleProgramCarousel';
		img.forEach(item=> wrap.appendChild(this.createCarouselItem(item)));
		return wrap;
	}
	createCarouselItem(item){
		let div = document.createElement('div');
		div.className = 'item';
		div.setAttribute('style','background-image: url(\''+item+'\')');
		return div;
	}
	createSingleProgramContent(programTitle,desc){
		let div = document.createElement('div');
		div.className = 'single-program-content mCustomScrollbar aos-wrap';
		div.setAttribute('data-mcs-theme','dark');
		div.setAttribute('data-aos','fade-left');
		div.appendChild(this.createProgramSingleTitle(programTitle));
		div.appendChild(this.createProgramSingleContent(desc));
		return div;
	}
	createProgramSingleTitle(title){
		let h6 = document.createElement('h6');
		h6.className = 'program-single-title';
		h6.innerHTML = title;
		return h6;
	}
	createProgramSingleContent(desc){
		let p = document.createElement('p');
		p.className = 'porgram-single-text';
		p.innerHTML = desc;
		return p;
	}
	destroyCarousel(carousel){
		$(carousel).trigger('remove.owl.carousel');
	}
	initCarousel(carousel){
		$(carousel).owlCarousel({
			nav : false,
			slideSpeed : 300,
			paginationSpeed : 300,
			items:1,
			autoplay:true,
			loop:true,
			// autoplayHoverPause:true,
			// mouseDrag: false,
			// touchDrag: false
		});
	}
	initCardCarousel(carousel){
		$(carousel).owlCarousel({
			nav : true,
			slideSpeed : 300,
			paginationSpeed : 400,
			items:1,
			autoplay:false,
			loop:true,
			margin: 20,
			autoplayHoverPause:true,
			responsiveClass:true,
			mouseDrag: false,
			responsive:{
				600:{
					items:2,
					margin: 30
				},
				1000:{
					items:3,
					margin: 10
				},
				1400:{
					items:3,
					margin:30
				}
			}
		});
	}
	createPath(path){
		let path2 = path.replace(/\s/g,'');
		let pathSplit = path2.split('/');
		let clearPathSplit = pathSplit.filter(item=>item);
		return clearPathSplit.join('/')+'/';
	}
	stripTags(el){
		let wrap = document.createElement('div');
		wrap.innerHTML = el;
		return wrap.textContent;
	}
	sendRequest(path){
		this.http.open('GET',this.url+'includes/request.php?action=get_program&path='+encodeURIComponent(this.path));
		this.http.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		this.http.send();
		return new Promise(this.getDates.bind(this));
	}
	getDates(resolve,reject){
		this.http.onreadystatechange = ()=>{
			if(this.http.readyState === 4 && this.http.status === 200){
				resolve(this.http.responseText);
			}
		}
	}
}
