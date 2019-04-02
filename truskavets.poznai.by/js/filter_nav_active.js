class FilterNavActive{
	constructor(item,link,callBack){
		this.container = document.querySelector(item);
		this.callBack = callBack;
		this.init(link);
	}
	init(link){
		this.items = this.container.querySelectorAll(link);
		for(let i = 0; i < this.items.length; i++){
			this.initClick(this.items[i]);
		}
	}
	initClick(item){
		item.addEventListener('click',(e)=>{
			this.removeActive();
			this.addActive(item);
			if(this.callBack) this.callBack();
		});
	}
	removeActive(){
		for(let i = 0; i < this.items.length; i++){
			if(this.items[i].classList.contains('active')){
				this.items[i].classList.remove('active');
			}
		}
	}
	addActive(item){
		if(!item.classList.contains('active')){
			item.classList.add('active');
		}
	}
}
