class TabsTour{
	constructor(id){
		this.id = id;
		this.container = document.querySelector('#'+id) ? document.querySelector('#'+id) : false;
		this.category = this.container ? this.container.dataset.category : false;
		this.init();
	}

	init(){
		if(this.container){
			this.links = {};
			this.toursConnect = new GetTours(this.category);
			this.toursConnect.init()
			.then((res)=>{
				this.tours = res;
				this.showModal = new ShowTourModal(this.id,this.tours);
				this.insertDates();
			});
		}
	}

	insertDates(){
		let count = 0;
		for(let key in this.tours){
			if(this.tours[key][1]){
				let active = !count ? true : false;
				let item = this.createItem(key,this.tours[key],active);
				this.container.appendChild(item);
				count++;
			}
		}
		this.initTabs();
		this.initSearch();
	}

	createItem(key,array,active){
		this.links[key] = [];
		let div = document.createElement('div');
		div.className = active ? 'tab-item tab-active' : 'tab-item';
		let title = document.createElement('a');
		title.className = active ? 'tab-label active-btn' : 'tab-label';
		title.appendChild(document.createTextNode(array[0]));
		let tabContent = document.createElement('div');
		tabContent.className = 'tab-content';
		for(let i = 1; i < array.length; i++){
			let row = this.createRow(key,i,array[i]);
			tabContent.appendChild(row);
		}
		div.appendChild(title);
		div.appendChild(tabContent);
		return div;
	}
	createRow(key,tourIndex,object){
		let div = document.createElement('div');
		div.className = 's-12 m-6 l-3 tabs-tour-item';
		let a = document.createElement('a');
		a.className = 'our-work-container lightbox margin-bottom tab-link open-modal-link';
		a.dataset.tour = key+'%'+tourIndex;
		a.href = '?tour='+encodeURIComponent(this.category)+'&key='+encodeURIComponent(key)+'&index='+encodeURIComponent(tourIndex);
		a.dataset.hashLink = '!tour='+this.category+'&key='+key+'&index='+tourIndex;
		a.appendChild(this.createContent(object));
		let img = new Image();
		let src = object.img[0] ? object.img[0] : 'img/belarus.jpg';
		img.src = src;
		a.appendChild(img);
		this.links[key][tourIndex] = a;
		this.initLink(a);
		div.appendChild(a);
		return div;
	}

	createContent(object){
		let div = document.createElement('div');
		div.className = 'our-work-text';
		let title = document.createElement('h4');
		title.appendChild(document.createTextNode(object.name));
		div.appendChild(title);
		let p = document.createElement('p');
		let textRoute = this.getText(object.route);
		let textDuration = this.getText(object.duration);
		textDuration.setAttribute('style','margin-top: 5px;');
		p.innerHTML = this.resText;
		let price = document.createElement('p');
		let span = document.createElement('span');
		span.className = 'tab-price';
		span.appendChild(document.createTextNode(object.price));
		let spanCur = document.createElement('span');
		spanCur.className = 'tab-currency sub';
		spanCur.appendChild(document.createTextNode(' '+object.currency));
		let from = document.createElement('span');
		from.appendChild(document.createTextNode('от '));
		price.appendChild(from);
		price.appendChild(span);
		price.appendChild(spanCur);
		div.appendChild(textRoute);
		div.appendChild(textDuration);
		div.appendChild(price);
		return div;
	}

	getText(text){
		let wrap = document.createElement('p');
		wrap.innerHTML = text;
		let txt = wrap.textContent;
		wrap.innerHTML = txt;
		return wrap;
	}
	initLink(item){
		item.addEventListener('click',(e)=>{
			e.preventDefault();
			window.location.hash = item.dataset.hashLink;
			this.showModal.initModal(item.dataset.tour);
		});
	}
	initTabs(){
		$(this.container).each(function(intex, element) {
			let current_tabs = $(this);
			$(this).prepend('<div class="tab-nav line"></div>');
			var tab_buttons = $(element).find('.tab-label');
			$(this).children('.tab-nav').prepend(tab_buttons);
			$(this).children('.tab-item').each(function(i) {
				$(this).attr("id", "tab-" + (i + 1));
			});
			$(".tab-nav").each(function() {
				$(this).children().each(function(i) {
					$(this).attr("href", "#tab-" + (i + 1));
				});
			});
			$(this).find(".tab-nav a").click(function(event) {
				$(this).parent().children().removeClass("active-btn");
				$(this).addClass("active-btn");
				var tab = $(this).attr("href");
				$(this).parent().parent().find(".tab-item").not(tab).css("display", "none");
				$(this).parent().parent().find(tab).fadeIn();
				return false;
			});
		});

	}
	initSearch(){
		let search;
		if(window.location.search !== ''){
			search = window.location.search;
		}
		if(window.location.hash !== ''){
			search = window.location.hash;
		}
		if(search){
			let splitHash = search.split('&');
			let path = splitHash[0].split('=');
			let key = splitHash[1].split('=');
			let index = splitHash[2].split('=');
			this.showModal.initModalSearch(this.links[key[1]][index[1]].dataset.tour,path[1]);
			document.body.style.overflow = 'hidden';
		}
	}
}
