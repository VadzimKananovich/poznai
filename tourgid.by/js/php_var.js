class PhpVar {
	constructor(){
		this.init();
	}
	init(){
		let el = document.querySelectorAll('.php_var');
		el.forEach(item=>{
			console.log(JSON.parse(item.textContent));
			item.parentNode.removeChild(item);
		});
	}
}
new PhpVar;
