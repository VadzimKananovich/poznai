class HeaderSlider{
	constructor(id){
		this.container = document.querySelector(`#${id}`);
		this.init();
	}
	init(){
		let getInfo = new AboutBelarusInfo(true);
		getInfo.init()
		.then((res)=>{
			this.dates = res;
			this.createContent();
			this.initSlider();
		});
	}
	createContent(){
		let wrap = document.createDocumentFragment();
		for(let i = 0; i < this.dates.length; i++){
			wrap.appendChild(this.createItem(this.dates[i]));
		}
		this.container.appendChild(wrap);
	}
	createItem(object){
		let div = document.createElement('div');
		div.className = 'item';
		object.img.setAttribute('title',object.name);
		div.appendChild(object.img);
		div.appendChild(this.createInfo(object.name,object.desc));
		return div;
	}
	createInfo(name,desc){
		let line = document.createElement('div');
		line.className = 'line';

		let text = document.createElement('div');
		text.className = 'text hide-s';

		let secondLine = document.createElement('div');
		secondLine.className = 'line';
		line.appendChild(text);
		text.appendChild(secondLine);
		text.appendChild(this.createTitle(name));
		text.appendChild(this.createDesc(desc));
		return line;
	}
	createTitle(name){
		let h2 = document.createElement('h2');
		h2.appendChild(document.createTextNode(name));
		return h2;
	}
	createDesc(desc){
		let p = document.createElement('p');
		p.appendChild(document.createTextNode(desc));
		return p;
	}

	initSlider(){
		$(this.container).owlCarousel({
			navigation: false,
			slideSpeed: 300,
			paginationSpeed: 400,
			autoPlay: 6000,
			addClassActive: true,
			transitionStyle: "fade",
			singleItem: true
		});

	}
}
