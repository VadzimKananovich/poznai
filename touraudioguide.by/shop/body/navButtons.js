
class DomNavButtons{
	constructor(){

	}
	createLeftButton(){
		let div = this.createWrapper();
		div.classList.add('buy-left');
		let i = document.createElement('i');
		i.className = 'fas fa-angle-left';
		div.appendChild(i);
		this.leftButton = div;
		return div;
	}
	createRightButton(){
		let div = this.createWrapper();
		div.classList.add('buy-right');
		let i = document.createElement('i');
		i.className = 'fas fa-angle-right';
		div.appendChild(i);
		this.rightButton = div;
		return div;
	}
	createWrapper(){
		let div = document.createElement('div');
		div.classList.add('nav-buttons');
		return div;
	}
}


class NavButtons extends DomNavButtons {

	constructor(){
		super();
		this.createLeftButton();
		this.createRightButton();

		this.scrollToRight();
		this.scrollToLeft();
		this.checkDisable();
	}

	scrollToRight(){
		this.rightButton.addEventListener('click',(e)=>{
			e.preventDefault();
			e.currentTarget.dispatchEvent(new CustomEvent('toRight', {bubbles: true, cancelable: true}));
		});
	}
	scrollToLeft(){
		this.leftButton.addEventListener('click',(e)=>{
			e.preventDefault();
			e.currentTarget.dispatchEvent(new CustomEvent('toLeft', {bubbles: true, cancelable: true}));
		});
	}

	checkDisable(){
		this.leftButton.addEventListener('disable',(e)=>{
			this.leftButton.classList.add('disable');
		});
		this.leftButton.addEventListener('enable',(e)=>{
			if(this.leftButton.classList.contains('disable')){
				this.leftButton.classList.remove('disable');
			}
		});
		this.rightButton.addEventListener('disable',(e)=>{
			this.rightButton.classList.add('disable');
		});
		this.rightButton.addEventListener('enable',(e)=>{
			if(this.rightButton.classList.contains('disable')){
				this.rightButton.classList.remove('disable');
			}
		});
	}



}
