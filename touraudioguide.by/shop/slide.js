class SlideScroll{
	constructor(body,menu,shop){
		this.body = body;
		this.menu = menu;
		this.shop = shop;
		this.bodyContainer = this.body.element;
		this.elementToScroll = this.body.wrapper;
		this.normalAnimationStep = 80;
		this.animationStep = 	this.normalAnimationStep;
		this.inMove = false;
		this.init();
	}
	init(){
		this.calcStep();
		this.position = 0;
		this.positionId = 0;
		this.calcNextStep();
		this.calcMaxSteps();
		this.scrollToRight();
		this.scrollToLeft();
		this.disableNavButtons();
	}
	calcStep(){
		this.step = this.body.categoryOffset[0][0];

	}
	calcNextStep(){
		this.nextStep = this.step * (this.positionId+1);
	}
	calcMaxSteps(){
		this.maxSteps = this.body.category.length-1;
	}
	scrollToRight(){
		this.bodyContainer.addEventListener('toRight',(e)=>{
			e.preventDefault();
			this.shop.verticalScroll.scrollTo(0);
			if(!this.inMove){
				if(this.positionId < this.maxSteps){
					window.localStorage.setItem('category',this.positionId+1);
					this.menu.filter.category.element.dispatchEvent(new CustomEvent('changeCategoryScroll', {bubbles: true, cancelable: true}));
					this.inMove = true;
					window.requestAnimationFrame(this.scrollToRightAnimation.bind(this));
				}
			}
		})
	}
	scrollToRightAnimation(){
		if(this.position < this.nextStep){
			let newStep = this.animationStep + this.position > this.nextStep ? this.nextStep - this.position : this.animationStep;
			this.position += newStep;
			this.elementToScroll.style.transform = `translateX(-${this.position}px)`;
			window.requestAnimationFrame(this.scrollToRightAnimation.bind(this));
		} else {
			this.positionId += 1;
			this.calcNextStep();
			this.disableNavButtons();
			this.animationStep = this.normalAnimationStep;
			this.inMove = false;
		}
	}
	scrollToLeft(){
		this.bodyContainer.addEventListener('toLeft',(e)=>{
			e.preventDefault();
			this.shop.verticalScroll.scrollTo(0);
			if(!this.inMove){
				if(this.positionId > 0){
					window.localStorage.setItem('category',this.positionId-1);
					this.menu.filter.category.element.dispatchEvent(new CustomEvent('changeCategoryScroll', {bubbles: true, cancelable: true}));
					this.inMove = true;
					window.requestAnimationFrame(this.scrollToLeftAnimation.bind(this));
				}
			}
		})
	}
	scrollToLeftAnimation(){
		if(this.position > this.nextStep - this.step*2){
			let leftStep = this.nextStep - this.step*2
			let newStep = this.position - this.animationStep < leftStep ? this.position - leftStep : this.animationStep;
			this.position -= newStep;
			this.elementToScroll.style.transform = `translateX(-${this.position}px)`;
			window.requestAnimationFrame(this.scrollToLeftAnimation.bind(this));
		} else {
			this.positionId -=1;
			this.calcNextStep();
			this.disableNavButtons();
			this.animationStep = this.normalAnimationStep;
			this.inMove = false;
		}
	}
	scrollTo(id,type){
		this.scrollToId = Number(id);
		this.animationStep = type ? type : this.animationStep;
		if(this.scrollToId || this.scrollToId === 0){
			if(this.positionId <= this.scrollToId){
				this.positionId = this.scrollToId-1;
				this.calcNextStep();
				window.requestAnimationFrame(this.scrollToRightAnimation.bind(this));
			}
			if(this.positionId > this.scrollToId){
				this.positionId = this.scrollToId+1;
				this.calcNextStep();
				window.requestAnimationFrame(this.scrollToLeftAnimation.bind(this));
			}
		}
	}
	disableNavButtons(){
		if(this.positionId === 0){
			this.body.nav.leftButton.dispatchEvent(new CustomEvent('disable', {bubbles: true, cancelable: true}));
		} else {
			this.body.nav.leftButton.dispatchEvent(new CustomEvent('enable', {bubbles: true, cancelable: true}));
		}
		if(this.positionId === this.maxSteps){
			this.body.nav.rightButton.dispatchEvent(new CustomEvent('disable', {bubbles: true, cancelable: true}));
		} else {
			this.body.nav.rightButton.dispatchEvent(new CustomEvent('enable', {bubbles: true, cancelable: true}));
		}
	}
}



class VerticalSlide {
	constructor(shop){
		this.shop = shop;
		this.step = 30;
		this.offsetElements = [];
		this.getOffsetElements();
	}
	getCurrentId(){
		this.currentId = window.localStorage.getItem('category');
	}
	getOffsetElements(){
		for(let i = 0; i < this.shop.body.category.length; i++){
			let item = this.shop.body.category[i].element;
			this.offsetElements[i] = item.getBoundingClientRect().top + window.scrollY;
		}
	}
	scrollTo(id){
		this.getOffsetElements();
		setTimeout(()=>	window.scrollTo(0,this.offsetElements[id] - 60),0);
	}

}
