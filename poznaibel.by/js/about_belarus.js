class AboutBelarus{
	constructor(id){
		this.block = document.querySelector(`#${id}`);
		this.nav = this.block.querySelector('#interestingFilter');
		this.slider = this.block.querySelector('#interestingSlider');
		this.slideWrap = this.block.querySelector('#interestingSliderWrapper');
		this.showMoreBtn = this.block.querySelector('#showMoreButton');
		this.toDelete = document.querySelector('#toDelete');
		this.init();
	}
	init(){
		let getImg = new AboutBelarusInfo();
		getImg.init()
		.then((res)=>{
			this.dates = res;
			this.createContent();
			this.initSlider();
			this.initHash();
		});
	}
	createContent(){
		this.nav.appendChild(this.createFilter());
		this.slider.appendChild(this.createSlider());
		this.slideWrap.appendChild(this.slider);
	}
	createFilter(){
		let filter = document.createDocumentFragment();
		let btn = document.createElement('button');
		btn.className = 'btn-md fil-cat filter active';
		btn.dataset.filter = 'all';
		btn.appendChild(document.createTextNode('Все'));
		this.navButtons = [btn];
		filter.appendChild(btn);
		filter.appendChild(document.createTextNode(' / '));
		const propOwn = Object.getOwnPropertyNames(this.dates);
		let count = 1;
		for(let key in this.dates){
			let item = this.dates[key];
			filter.appendChild(this.createBtn(item.tabs_name,key));
			if(count < propOwn.length){
				filter.appendChild(document.createTextNode(' / '));
			}
			count++;
		}
		return filter;
	}
	createBtn(name,key){
		let btn = document.createElement('button');
		btn.className = 'btn-md fil-cat filter';
		btn.dataset.rel = key;
		btn.dataset.filter = '.'+key;
		this.navButtons.push(btn);
		btn.appendChild(document.createTextNode(name));
		return btn;
	}

	createSlider(){
		let slider = document.createDocumentFragment();
		this.links = {};
		for(let key in this.dates){
			this.links[key] = [];
			let images = this.dates[key].img;
			for(let i = 0; i < images.length; i++){
				let img = new Image();
				img.src = 'img/about_belarus/'+key+'/'+images[i].src;
				let hashUrl = images[i].src;
				let fileTitle = images[i].title;
				let fileDesc = images[i].desc;
				let container = document.createElement('div');
				container.className = 'single_portfolio tile scale-anm';
				container.classList.add(key);
				let wrapImg = document.createElement('div');
				wrapImg.className = 'slider-img-wrap';
				wrapImg.appendChild(img);
				container.appendChild(wrapImg);
				let link = this.createLink(key,img.src,fileTitle,fileDesc,hashUrl,i);
				container.appendChild(link);
				if(i === 0){
					this.exampleContainer = container;
				}
				slider.appendChild(container);
			}
		}
		return slider;
	}
	createLink(key,src,fileTitle,fileDesc,hashUrl,index){
		let wrap = document.createElement('div');
		wrap.className = 'about-link-wrap';
		let a = document.createElement('a');
		a.className = 'portfolio-img';
		a.setAttribute('href','preview=home&key='+key+'&item='+encodeURIComponent(hashUrl));
		a.dataset.hashLink = 'preview=home&key='+key+'&item='+index;
		a.dataset.key = key;
		a.dataset.id = index;
		a.dataset.figcaption = '<h5>'+fileTitle+'</h5>'+' '+'<p>'+fileDesc+'</p>';
		a.setAttribute('data-mfp-src',src);
		a.setAttribute('title',fileTitle);
		a.appendChild(this.createGridItem(fileTitle,fileDesc));
		this.links[key].push(a);
		wrap.appendChild(a);
		this.initLink(a);
		return wrap;
	}
	createGridItem(fileTitle,fileDesc){
		let div = document.createElement('div');
		div.className = 'grid_item_overlay';
		div.appendChild(this.createSeparator());
		div.appendChild(this.createTitle(fileTitle));
		div.appendChild(this.createDesc(fileDesc));
		return div;
	}
	createSeparator(){
		let div = document.createElement('div');
		div.className = 'separator4';
		return div;
	}
	createTitle(fileTitle){
		let h3 = document.createElement('h3');
		h3.appendChild(document.createTextNode(fileTitle));
		return h3;
	}
	createDesc(fileDesc){
		let res = fileDesc.length > 200 ? fileDesc.substr(0,200)+'...' : fileDesc;
		let p = document.createElement('p');
		p.appendChild(document.createTextNode(res));
		return p;
	}


	initSlider(){
		jQuery(this.block).mixItUp({
			selectors: {
				target: '.tile',
				filter: '.filter'
			},
			animation: {
				animateResizeContainer: false,
				effects: 'fade scale'
			}
		});
		$('#interestingSlider .portfolio-img').magnificPopup({
			type: 'image',
			disableOn: false,
			gallery: {
				enabled: true
			},
			image: {
				titleSrc: 'data-figcaption',
			},
			callbacks: {
				close: ()=> {
					history.pushState("", document.title, window.location.pathname);
					if(this.toDelete){
						this.toDelete.parentNode.removeChild(this.toDelete);
					}
					document.body.style.overflow = 'visible';
				},
				change: (item)=>{
					history.pushState("", document.title, window.location.pathname);
					window.location.hash = item.el[0].dataset.hashLink;
				},
				open: ()=>{
					document.body.style.overflow = 'hidden';
				}
			}
		});
		setTimeout(this.hideOverflowSlide.bind(this),0);
	}

	initLink(item){
		item.addEventListener('click',(e)=>{
			window.location.hash = item.dataset.hashLink;
		})
	}
	initHash(){
		let hash;
		if(window.location.search !== ''){
			hash = window.location.search;
		}
		if(window.location.hash !== ''){
			hash = window.location.hash;
		}
		if(hash){
			let arrayHash = hash.split('&');
			if(arrayHash[0].includes('preview')){
				let key = arrayHash[1].split('=');
				let item = arrayHash[2].split('=');
				let domItem = this.links[key[1]][Number(item[1])];
				domItem.click();
			}
		}
	}

	hideOverflowSlide(){
		let height = this.exampleContainer.offsetHeight;
		let styles = window.getComputedStyle(this.exampleContainer);
		let marginBottom = parseInt(styles.marginBottom);
		this.minHeight = height+marginBottom;
		this.calcSize();
		this.initNavBtn();
		this.initShowMore();
	}
	calcSize(){
		this.slideStep = this.minHeight*3;
		if(this.slider.offsetHeight < this.slideStep){
			this.slideWrap.style.height = `${this.slider.offsetHeight}px`;
			this.disableShowMore();
		} else {
			this.slideWrap.style.height = `${this.slideStep}px`;
			this.enableShowMore();
		}
		this.slideHeight = this.slideStep;
	}
	initNavBtn(){
		for(let i = 0; i < this.navButtons.length; i++){
			this.navButtons[i].addEventListener('click',(e)=>{
				setTimeout(this.calcSize.bind(this),800);
			});
		}
	}
	initShowMore(){
		this.showMoreBtn.addEventListener('click',(e)=>{
			if(this.slider.offsetHeight > this.slideHeight){
				if(this.slideHeight + this.slideStep > this.slider.offsetHeight){
					this.slideHeight =  this.slider.offsetHeight;
					this.disableShowMore();
				} else {
					this.slideHeight =  this.slideHeight + this.slideStep;
					this.enableShowMore();
				}
				this.slideWrap.style.height = `${this.slideHeight}px`;
			}
		});
	}
	disableShowMore(){
		if(!this.showMoreBtn.classList.contains('disable')){
			this.showMoreBtn.classList.add('disable');
		}
	}
	enableShowMore(){
		if(this.showMoreBtn.classList.contains('disable')){
			this.showMoreBtn.classList.remove('disable');
		}
	}

}
