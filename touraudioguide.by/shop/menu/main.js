
class Menu {
	constructor(array,products) {
		this.array = array;
		this.allProducts = products;
		this.createElement();
		this.menuFix = false;
		this.fixMenu();
	}
	createElement() {
		this.filter = new Filter(this.array);
		this.search = new Search(this.array);
		this.cart = new Cart(this.allProducts);
		this.element = this.createWrapper();
		this.element.appendChild(this.filter.element);
		this.element.appendChild(this.search.element);
		this.element.appendChild(this.cart.element);
	}
	createWrapper () {
		let div = document.createElement('div');
		div.classList.add('buy-menu');
		return div;
	}
	fixMenu(){
		window.addEventListener('scroll', (e)=>{
			e.preventDefault();
			this.position = this.position ? this.position : this.element.getBoundingClientRect().y - document.body.getBoundingClientRect().y;
			let offsetTop = document.body.getBoundingClientRect().y;
			if(!this.menuFix){
				if(-offsetTop > this.position){
					this.element.setAttribute('style','position: fixed; top: -45px; left: 0; right: 0; z-index: 10001;');
					this.menuFix = true;
					window.requestAnimationFrame(this.animateMenu.bind(this));
				}
			} else {
				if(-offsetTop < this.position - 200){
					this.element.removeAttribute('style');
					this.menuFix = false;
				}
			}
		})
	}
	animateMenu(){
		if(parseInt(this.element.style.top) < 0){
			this.element.style.top = `${parseInt(this.element.style.top)+5}px`;
			window.requestAnimationFrame(this.animateMenu.bind(this));
		}
	}
}
