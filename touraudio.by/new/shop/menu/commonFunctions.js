

class MenuFunctions {
	constructor() {

	}
	createBlockTitle (title) {
		let div = document.createElement('div');
		div.classList.add('menu-controls-element');
		let p = document.createElement('p');
		p.classList.add('buy-title');
		let txt = document.createTextNode(title);
		p.appendChild(txt);
		div.appendChild(p);

		return div;
	}

	// menuEvent(key,value){
	// 	return new CustomEvent('menu', {bubbles: true, cancelable: false, detail:{key:value}});
	// }
}
