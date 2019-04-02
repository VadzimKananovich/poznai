class AnimateBox{
	constructor(id){
		this.id = id;
		this.container = document.querySelector(`#${id}`);
		this.init();
	}
	init(){
		this.toursConnect = new GetTours;
		this.toursConnect.init()
		.then((res)=>{
			this.tours = res;
			this.createElements();
		});
	}
	createElements(){
		let container = document.createDocumentFragment();
		this.countElements = 0;

		for(let key in this.tours){
			if(this.countElements < 11){
				if(this.tours[key].state === 'popular'){
					if(this.countElements === 5){
						container.appendChild(this.createRowAllTours());
					} else {
						container.appendChild(this.createRow(this.tours[key],key));
					}
					this.countElements++;
				}
			} else {
				break;
			}
		}
		this.container.appendChild(container);
		new ShowTourModal(this.id);
	}
	createRowAllTours(){
		let li = document.createElement('li');
		li.className = 'one-half text-center';
		let titleBg = document.createElement('div');
		titleBg.className = 'title-bg';
		li.appendChild(titleBg);
		titleBg.appendChild(this.createContentAll());
		return li;
	}
	createContentAll(){
		let wrap = document.createElement('div');
		wrap.className = 'case-studies-summary';
		let h2 = document.createElement('h2');
		h2.appendChild(document.createTextNode('ВСЕ ТУРЫ ПО БЕЛАРУСИ'));
		wrap.appendChild(h2);
		wrap.appendChild(this.createAllLink());
		return wrap;
	}
	createAllLink(){
		let span = document.createElement('span');
		let a = document.createElement('a');
		a.className = 'animate-box-link open-modal-link';
		a.dataset.tour='all';
		a.appendChild(document.createTextNode('все туры'));
		span.appendChild(a);
		return span;
	}


	createRow(object,key){
		let li = document.createElement('li');
		li.className = 'one-forth text-center';
		li.setAttribute('style', `background-image: url(${object.img[0].src});`);
		li.appendChild(this.createLink(object,key));
		return li;
	}
	createLink(object,key){
		let a = document.createElement('a');
		a.className = 'animate-box-link open-modal-link';
		a.dataset.tour = key;
		a.appendChild(this.createTitle(object.name));
		return a;
	}
	createTitle(name){
		let div = document.createElement('div');
		div.className = 'case-studies-summary';
		let h2 = document.createElement('h2');
		h2.appendChild(document.createTextNode(name));
		div.appendChild(h2);
		return div;
	}
}
