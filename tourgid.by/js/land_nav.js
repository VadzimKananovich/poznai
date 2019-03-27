class LandNav{
	constructor(set){
		this.initDefaultSet();
		this.initPassedSet(set);
		this.getElements();
		this.init();
	}

	initDefaultSet(){
		this.set = {
			'container':'nav',
			'linkClass':'nav-land',
			'target':'menu',
			'speedScroll': 7,
			'offset': 30,
			'fix':300,
			'animateFix': .3,
			'activeClass':'active',
			'navigate':true
		}
	}

	initPassedSet(set){
		for(let key in set){
			this.set[key] = set[key];
		}
	}
	getElements(){
		this.container = document.querySelector(this.set.container);
		this.links = this.container.querySelectorAll('.'+this.set.linkClass);
		this.height = this.container.offsetHeight;
	}

	init(){
		this.getSections();
		if(this.set.navigate){
			this.initLink();
		}
		if(this.set.fix){
			this.initFix();
		}
	}

	getSections(){
		this.sections = {};
		this.links.forEach(item=>{
			let sectionName = item.dataset[this.set.target];
			if(!this.sections[sectionName]) {
				this.sections[sectionName] = {};
			}
			let section = this.sections[sectionName];
			section.item = document.querySelector('#'+sectionName);
			section.height = section.item.offsetHeight;
			section.offsetTop = section.item.getBoundingClientRect().y + window.pageYOffset - this.set.offset;
			section.link = item;
		});
	}

	initLink(){
		for(let key in this.sections){
			let section = this.sections[key];
			section.link.addEventListener('click',this.initScroll.bind(this,section));
		}
	}

	initScroll(section,e){
		e.preventDefault();
		this.position = window.pageYOffset;
		this.endPoint = section.offsetTop;
		this.step = this.set.speedScroll;
		this.inScroll = true;
		this.animation = setInterval(this.animateScroll.bind(this),0);
	}

	animateScroll() {
		if(this.inScroll){
			if((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
				clearInterval(this.animation);
				this.inScroll = false;
			}
			if(this.position >= this.endPoint && this.position <= this.endPoint - this.offset){
				clearInterval(this.animation);
				this.inScroll = false;
			}
			if(this.position < this.endPoint){
				this.scrollToBottom();
			}
			if(this.position > this.endPoint - this.offset){
				this.scrollToTop();
			}
		}
		// if(this.position < this.endPoint){
		// 	let nextPoint = window.pageYOffset + this.step;
		// 	window.scrollTo(0,nextPoint);
		// 	this.position = window.pageYOffset;
		// } else if(this.position > this.endPoint) {
		// 	let nextPoint = window.pageYOffset - this.step;
		// 	window.scrollTo(0,nextPoint);
		// 	this.position = window.pageYOffset;
		// } else {
		// 	clearInterval(this.animation);
		// }
	}

	scrollToBottom(){
		let nextPoint = window.pageYOffset + this.step;
		window.scrollTo(0,nextPoint);
		this.position = window.pageYOffset;
	}

	initFix(){
		this.fixed = false;
		window.addEventListener('scroll',()=>{
			if(window.scrollY > this.set.fix){
				if(!this.fixed){
					this.fixMenu();
					this.fixed = true;
				}
			} else {
				if(this.fixed){
					this.unFixMenu();
					this.fixed = false;
				}
			}
		});
	}

	fixMenu() {
		if(!this.container.parentNode.querySelector('.replaced-menu-nav')){
			this.replacedMenu = document.createElement('div');
			this.replacedMenu.classList.add('replaced-menu-nav');
			this.container.parentNode.insertBefore(this.replacedMenu,this.container);
			this.replacedMenu.setAttribute('style','z-index: -1;background:transparent;border:0;padding:0;margin:0;height:'+this.container.offsetHeight+'px;');
		}
		this.container.style.transition = '0s';
		this.container.style.position = 'fixed';
		this.container.style.overflow = 'hidden';
		this.container.style.top = '0';
		this.container.style.left = '0';
		this.container.style.right = '0';
		this.container.style.opacity = '0';
		this.container.style.transform = 'translateY(-100%)';
		setTimeout(()=>{
			this.container.style.transition = this.set.animateFix+'s';
			setTimeout(()=>{
				this.container.style.transform = 'translateY(0)';
				this.container.style.opacity = '1';
			},0);
		},0);
	}

	unFixMenu(){
		let delay = Number(this.set.animateFix) * 1000;
		this.container.style.transform = 'translateY(-100%)';
		this.container.style.opacity = '0';
		setTimeout(()=>{
			this.container.style.transform = 'translateY(0)';
			this.container.style.position = 'relative';
			this.container.style.opacity = '1';
			if(this.container.parentNode.querySelector('.replaced-menu-nav')) {
				this.replacedMenu.parentNode.removeChild(this.replacedMenu);
			}
		},delay);
	}

}
