class UpButton {
	constructor(mode,maxScroll, bgUrl, sizeX = 45, sizeY = 45, transition = 0.3, scrollStep = 200){
		this.mode = mode;
		this.maxScroll = maxScroll;
		this.bgUrl = bgUrl;
		this.x = sizeX;
		this.y = sizeY;
		this.scrollStep = scrollStep;
		this.transition = transition;
		this.button = this.createButton();
		this.appendButton();
		this.scrollEvent();
		this.scrollToTop();
	}

	scrollEvent(){
		document.addEventListener('scroll',this.scrollFunction.bind(this));
	}

	scrollFunction () {
		if(!this.inMove){
			this.position = window.pageYOffset;
			if(this.position>this.maxScroll){
				this.showButton();
			} else {
				this.hideButton();
			}
		}
	}
	createButton () {
		let div = document.createElement('div');
		div.setAttribute('style',`
		width: ${this.x}px;
		height: ${this.y}px;
		position: fixed;
		bottom: -${this.y}px;
		right: 10px;
		transform: translateZ(0);
		transition: ${this.transition}s;
		background-image: url(${this.bgUrl});
		background-position: center center;
		background-size: 100% 100%;
		opacity: 0;
		z-index: 1000;
		cursor: pointer;
		`);
		this.buttonHover(div);
		return div;
	}
	buttonHover(div){
		div.addEventListener('mouseover',(e)=>{
			e.currentTarget.style.bottom = '20px';
			e.currentTarget.style.opacity = '1';
		});
		div.addEventListener('mouseleave',(e)=>{
			e.currentTarget.style.bottom = '10px';
			e.currentTarget.style.opacity = '0.7';
		});
	}
	appendButton(){
		document.body.appendChild(this.button);
	}
	showButton(){
		this.button.style.opacity = '0.7';
		this.button.style.bottom = '10px';
	}
	hideButton(){
		this.button.style.opacity = '0';
		this.button.style.bottom = '-45px';
	}
	scrollToTop(){
		this.slowScrollPosition = this.position;
		this.button.addEventListener('click',(e)=>{
			if(!this.mode){
				window.requestAnimationFrame(this.slowScroll.bind(this));
			} else {
				window.scrollTo(0,0);
			}
		});
	}
	slowScroll(){
		if(this.position > 0 ){
			this.position = this.position - this.scrollStep;
			window.scrollTo(0, this.position);
			window.requestAnimationFrame(this.slowScroll.bind(this));
		} else {
			this.position = 0;
		}
	}
}
