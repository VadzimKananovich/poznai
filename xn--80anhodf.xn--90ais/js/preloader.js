class Preloader{
	constructor(){
		this.container = document.querySelector('#preloader');
		this.init();
	}
	init(){
		window.onload = ()=>{
			AOS.init();
			this.container.classList.add('remove-preloader');
			setTimeout(()=>{
				this.container.parentNode.removeChild(this.container);
			},400)
		}
	}
}
