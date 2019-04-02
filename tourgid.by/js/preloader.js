class Preloader{
	constructor(){
		this.container = document.querySelector('#preloader');
		this.init();
	}
	init(){
		window.addEventListener('load',(()=>{
			this.container.classList.add('remove-preloader');
			setTimeout(()=>{
				this.container.parentNode.removeChild(this.container);
			},400);
		}).bind(this));
	}
}
