class NativeCarousel{
	constructor(set){
		this.initDefaultSet();
		this.initPassedSet(set);
		this.getElements();
		this.init();
	}
	initDefaultSet(){
		this.set = {
			'container': '.native-carousel',
			'height':'100%',
			'items': 2,
			'step': 1,
			'space': 10,
			'loop': true,
			'draggable': true,
			'itemClass': 'carousel-item',
			'bodyClass': 'carousel-body',
			'nav': true,
			'dots': true,
			'navClass': 'carousel-nav',
			'prevClass': 'btn-prev',
			'nextClass': 'btn-next',
			'dotsContainerClass': 'carousel-dots',
			'dotClass': 'carousel-dot',
			'transition': .7,
			'autoplay': false
		}
	}
	initPassedSet(set){
		for(let key in set){
			this.set[key] = set[key]
		}
	}
	getElements(){
		let allCarousels = document.querySelectorAll(this.set.container);
		this.carousels = [];
		allCarousels.forEach((item,i)=>{
			item.style.height = this.set.height;
			this.carousels[i] = {};
			this.carousels[i].container = item;
			this.carousels[i].body = item.querySelector('.'+this.set.bodyClass);
			if(this.set.nav){
				this.carousels[i].nav = this.getCarouselNav(item);
			} else {
				let container = item.querySelector('.'+this.set.navClass);
				container.style.display = 'none';
			}
			this.carousels[i].items = item.querySelectorAll('.'+this.set.itemClass);
			this.carousels[i].items.slice = [].slice;
			this.carousels[i].items = this.carousels[i].items.slice();
			this.carousels[i].slide = 0;
			if(this.set.dots) {
				this.getCarouselDots(this.carousels[i]);
			}
		});
		console.log(this);
	}

	init(){
		this.touch = this.isTouchDevice();
		this.carousels.forEach(item=>{
			item.step = this.calcStep(item);
			item.width = this.calcWidth(item);
			this.calcTotalSlide(item);
			item.body.style.transition = this.set.transition+'s';
			this.initStyle(item);
			if(this.set.draggable){
				this.initDraggable(item);
			}
			if(item.nav){
				this.initNav(item);
			}
		});
	}

	initStyle(carousel){
		carousel.items.forEach((item,i,arr)=>{
			item.style.width = carousel.width+'px';
			item.style.paddingRight = this.set.space+'px';
			item.style.paddingLeft = this.set.space+'px';
		});
	}

	calcWidth(carousel){
		let bodyWidth = carousel.body.offsetWidth;
		return bodyWidth / this.set.items;
	}

	calcTotalSlide(carousel){
		let totalSlide = carousel.items.length / this.set.step;
		if(carousel.items.length % this.set.step > 0){
			carousel.remainder = carousel.items.length % this.set.step;
		} else {
			carousel.remainder = false;
		}
		carousel.totalSlide = Math.trunc(totalSlide);
	}

	calcStep(carousel){
		let width = this.calcWidth(carousel);
		let step = width * this.set.step;
		return step;
	}

	isTouchDevice() {
		return 'ontouchstart' in document.documentElement;
	}

	initDraggable(carousel){
		let div = document.createElement('div');
		div.classList.add('drag-zone');
		div.setAttribute('style','width:10px; height:10px; position:absolute; z-index:100; background-color: transparent;');
		carousel.container.appendChild(div);
		carousel.container.setAttribute('draggable','true');

		if(this.touch){
			carousel.container.addEventListener('touchstart',this.dragStart.bind(this,carousel,div,true));
			carousel.container.addEventListener('touchmove',this.dragCraousel.bind(this,carousel,true));
			carousel.container.addEventListener('touchend',this.dragEndCraousel.bind(this,carousel,true));
		} else {
			carousel.container.addEventListener('dragstart',this.dragStart.bind(this,carousel,div,false));
			carousel.container.addEventListener('drag',this.dragCraousel.bind(this,carousel,false));
			carousel.container.addEventListener('dragend',this.dragEndCraousel.bind(this,carousel,false));
		}
	}

	dragStart(carousel,div,touch,e){
		if(!touch){
			e.dataTransfer.setDragImage(div, 0, 0);
		}
		let clientX = touch ? e.touches[0].clientX : e.clientX;
		carousel.drag = clientX;
		carousel.body.style.transition = '0s';
	}

	dragCraousel(carousel,touch,e){
		let clientX = touch ? e.touches[0].clientX : e.clientX;
		if(clientX) {
			carousel.currDrag = carousel.drag - clientX;
			if(this.set.loop && this.ifLastSlide(carousel) && carousel.currDrag > 0){
				this.insertLastSlide(carousel);
			}
			if(this.set.loop && carousel.slide === 0 && carousel.currDrag < 0) {
				this.insertFirstSlide(carousel);
			}
			carousel.translate = carousel.translate ? carousel.translate : 0;
			carousel.body.style.transform = `translateX(${carousel.translate - carousel.currDrag}px)`;
		}
	}

	dragEndCraousel(carousel,touch,e) {
		carousel.body.style.transition = this.set.transition+'s';
		let end = Math.abs(carousel.currDrag);
		if(end > carousel.step / 10){
			if(carousel.currDrag > 0){
				if(this.set.loop && carousel.firstCloned){
					carousel.firstCloned.forEach(item=>item.parentNode.removeChild(item));
					this.remakeNextSlider(carousel);
					carousel.firstCloned = false;
				} else {
					this.nextSlide(carousel);
					carousel.body.style.transform = `translateX(${carousel.translate}px)`;
				}
			} else {
				if(this.set.loop && carousel.lastCloned){
					carousel.lastCloned.forEach(item=>item.parentNode.removeChild(item));
					this.remakePrevSlider(carousel);
					carousel.lastCloned = false;
				} else {
					this.prevSlide(carousel);
					carousel.body.style.transform = `translateX(${carousel.translate}px)`;
				}
			}
		} else {
			if(this.set.loop){
				if(carousel.firstCloned){
					setTimeout(()=>{
						if(carousel.firstCloned){
							carousel.firstCloned.forEach(item=>item.parentNode.removeChild(item));
							carousel.firstCloned = false;
						}
					},this.set.transition*1000);
				}
				if(carousel.lastCloned){
					setTimeout(()=>{
						if(carousel.lastCloned){
							carousel.lastCloned.forEach(item=>item.parentNode.removeChild(item));
							carousel.lastCloned = false;
						}
					},this.set.transition*1000);
				}
			}
			carousel.body.style.transform = `translateX(${carousel.translate}px)`;
		}
	}

	insertLastSlide(carousel) {
		if(!carousel.firstCloned){
			carousel.firstCloned = [];
			for(let i = 0; i < this.set.items; i++) {
				let copy = carousel.items[i].cloneNode(true);
				carousel.body.appendChild(copy);
				carousel.firstCloned.push(copy);
			}
		}
	}

	insertFirstSlide(carousel) {
		if(!carousel.lastCloned){
			carousel.lastCloned = [];
			let first = carousel.items[0];
			for(let i = carousel.items.length - this.set.items; i < carousel.items.length; i++){
				let copy = carousel.items[i].cloneNode(true);
				carousel.body.insertBefore(copy,first);
				carousel.lastCloned.push(copy);
			}
			carousel.translate = -carousel.step;
		}
	}

	ifLastSlide(carousel){
		if(carousel.slide * this.set.step < carousel.items.length - this.set.items){
			return false;
		} else {
			return true;
		}
	}

	getCarouselNav(carousel){
		let nav = {};
		nav.container = carousel.querySelector('.'+this.set.navClass);
		nav.next = carousel.querySelector('.'+this.set.nextClass);
		nav.prev = carousel.querySelector('.'+this.set.prevClass);
		return nav;
	}

	getCarouselDots(carousel,length){
		let res = [];
		let dotExample;
		if(carousel.container.querySelector('.'+this.set.dotsContainerClass)) {
			let container = carousel.container.querySelector('.'+this.set.dotsContainerClass);
			if(container.querySelector('.'+this.set.dotClass)) {
				let dot = container.querySelector('.'+this.set.dotClass);
				dotExample = dot.cloneNode(true);
			} else {
				dotExample = this.createDotExample();
			}
			container.parentNode.removeChild(container);
		} else {
			dotExample = this.createDotExample();
		}
		let container = document.createElement('div');
		container.className = this.set.dotsContainerClass;
		let dotsLength = Math.floor(carousel.items.length / this.set.step);
		carousel.dots = [];
		for(let i = 0; i < dotsLength; i++){
			let dot = dotExample.cloneNode(true);
			carousel.dots.push(dot);
			container.appendChild(dot);
		}
		carousel.container.appendChild(container);
		this.checkActiveDot(carousel);
		this.initDots(carousel);
	}

	checkActiveDot(carousel){
		carousel.dots.forEach((item,i)=>{
			if(i === carousel.slide){
				if(!item.classList.contains('active')){
					item.classList.add('active');
				}
			} else {
				if(item.classList.contains('active')){
					item.classList.remove('active');
				}
			}
		});
	}

	initDots(carousel){
		carousel.dots.forEach((item,i)=>{
			item.addEventListener('click',()=>{
				if(i > carousel.slide){
					this.nextSlide(carousel);
				}
				if(i < carousel.slide){
					this.prevSlide(carousel);
				}
			});
		});
	}

	createDotExample(){
		let btn = document.createElement('button');
		btn.className = this.set.dotClass;
		btn.type = 'button';
		return btn;
	}

	initNav(carousel){
		let next = carousel.nav.next;
		let prev = carousel.nav.prev;
		next.addEventListener('click',this.nextSlide.bind(this,carousel));
		prev.addEventListener('click',this.prevSlide.bind(this,carousel));
	}

	nextSlide(carousel){
		let condition;
		if(!this.set.loop){
			condition = carousel.slide * this.set.step < carousel.items.length - this.set.items ? true : false;
		} else {
			condition = true;
		}
		this.calcPrevCurrNext(carousel);
		if(condition) {
			console.log(carousel);

			if(carousel.currentLastSlide > this.set.slide){
				this.addFromStart(carousel,carousel.remainder);
				carousel.slide = 0;
				// setTimeout(()=>{
				// 	carousel.body.style.transform = 'translateX(0px)';
				// 	setTimeout(() => {
				// 		carousel.body.style.transition = this.set.transition+'s';
				// 		setTimeout(() => {
				// 			this.changeNextSlide(carousel);
				// 		},0);
				// 	},10);
				// },10);
			} else {
				// if(carousel.slide * this.set.step < carousel.items.length - this.set.items){
				this.changeNextSlide(carousel);
				// }
			}
		}
	}


	calcPrevCurrNext(carousel){
		// PREVIOUS SLIDER
		console.log();
		if((carousel.slide-1) * this.set.step > 0) {
			carousel.prevFirstId = (carousel.slide-1) * this.set.step;
			carousel.prevLastId = carousel.prevFirstId + this.set.items;
			carousel.prev = carousel.items.slice(carousel.prevFirstId,carousel.prevLastId);
		} else {
			if(this.set.loop){
				carousel.prevFirstId = (carousel.slide-1) * this.set.step;
				carousel.prevLastId = carousel.prevFirstId + this.set.items;
				carousel.prev = carousel.items.slice(carousel.prevFirstId,carousel.prevLastId);
			} else {
				carousel.prevFirstId = (carousel.slide-1) * this.set.step;
				carousel.prevLastId = carousel.prevFirstId + this.set.items;
				carousel.prev = carousel.items.slice(carousel.prevFirstId,carousel.prevLastId);
			}
		}
		// CURRENT SLIDER
		if((carousel.slide-1) * this.set.step > 0) {
			carousel.currFirstId = carousel.prevLastId+1;
			carousel.currLastId = carousel.currFirstId + this.set.items;
			carousel.curr = carousel.items.slice(carousel.currFirstId,carousel.currLastId);
		} else {
			if(this.set.loop){
				carousel.currFirstId = carousel.prevLastId+1;
				carousel.currLastId = carousel.currFirstId + this.set.items;
				carousel.curr = carousel.items.slice(carousel.currFirstId,carousel.currLastId);
			} else {
				carousel.currFirstId = carousel.prevLastId+1;
				carousel.currLastId = carousel.currFirstId + this.set.items;
				carousel.curr = carousel.items.slice(carousel.currFirstId,carousel.currLastId);
			}
		}
		// NEXT SLIDER
		if((carousel.slide-1) * this.set.step > 0) {
			carousel.nextFirstId = carousel.currLastId+1;
			carousel.nextLastId = carousel.nextFirstId + this.set.items;
			carousel.next = carousel.items.slice(carousel.nextFirstId,carousel.nextLastId);
		} else {
			if(this.set.loop){
				carousel.nextFirstId = carousel.currLastId+1;
				carousel.nextLastId = carousel.nextFirstId + this.set.items;
				carousel.next = carousel.items.slice(carousel.nextFirstId,carousel.nextLastId);
			} else {
				carousel.nextFirstId = carousel.currLastId+1;
				carousel.nextLastId = carousel.nextFirstId + this.set.items;
				carousel.next = carousel.items.slice(carousel.nextFirstId,carousel.nextLastId);
			}
		}
	}

	addFromStart(carousel,count) {
		let cut = carousel.items.splice(0,carousel.currentSlide);
		carousel.items = carousel.items.concat(cut);
		console.log(carousel.items);
		carousel.body.removeAttribute('style');
		this.rewriteBody(carousel);
	}


	changeNextSlide(carousel) {
		carousel.slide++;
		let slide = carousel.slide * this.set.step;
		if(this.set.dots){
			this.checkActiveDot(carousel);
		}
		let nextStep = carousel.slide * carousel.step;
		carousel.translate = -nextStep;
		carousel.body.style.transform = `translateX(-${nextStep}px)`;
	}


	rewriteBody(carousel){
		carousel.body.innerHTML = '';
		carousel.items.forEach(item=>{
			carousel.body.appendChild(item);
		});
	}

	prevSlide(carousel){
		let condition;
		if(!this.set.loop){
			condition = carousel.slide * this.set.step > 0 ? true : false;
		} else {
			condition = true;
		}
		if(condition){
			if(carousel.slide * this.set.step > 0) {

				carousel.slide--;
				if(this.set.dots){
					this.checkActiveDot(carousel);
				}
				let nextStep = carousel.slide * carousel.step;
				carousel.translate = -nextStep;
				carousel.body.style.transform = `translateX(-${nextStep}px)`;
			} else {
				this.remakePrevSlider(carousel);
			}
		}
	}

	remakePrevSlider(carousel) {
		carousel.body.style.transition = '0s';
		let firstElements = carousel.items.splice(0,this.set.items);
		for(let i = 0; i < firstElements.length; i++){
			carousel.body.appendChild(firstElements[i]);
		}
		carousel.items = carousel.items.concat(firstElements);
		carousel.slide =  Math.floor(carousel.items.length / this.set.step) - this.set.items;
		carousel.body.style.transform = `translateX(-${carousel.slide * carousel.step}px)`;
		setTimeout(()=>{
			carousel.body.style.transition = this.set.transition+'s';
			this.prevSlide(carousel);
		},50);
	}

	remakeNextSlider(carousel) {
		carousel.body.style.transition = '0s';
		let firstElements = carousel.items.splice(0,carousel.items.length - this.set.items);
		for(let i = 0; i < firstElements.length; i++){
			carousel.body.appendChild(firstElements[i]);
		}
		carousel.items = carousel.items.concat(firstElements);
		carousel.slide = 0;
		carousel.body.style.transform = `translateX(-${0}px)`;
		setTimeout(()=>{
			carousel.body.style.transition = this.set.transition+'s';
			this.nextSlide(carousel);
		},50);
	}

}
