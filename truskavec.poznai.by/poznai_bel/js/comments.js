class CommentElement {
	
	constructor(){
		this.createElement()
	}

	createElement(){
		this.element = this.createContainer();
	}
	createContainer(){
		let div = document.createElement('div');
		div.className = 'container-fluid swiper-slide';
		let row = document.createElement('div');
		row.className = 'row';
		row.appendChild(this.createColUser());
		row.appendChild(this.createColComment());
		div.appendChild(row);
		return div;
	}
	createColUser(){
		let col = document.createElement('div');
		col.className = 'col-md-3';
		let container = document.createElement('div');
		container.className = 'comments-user-container';
		container.appendChild(this.createImg());
		container.appendChild(this.createUserInfo());
		col.appendChild(container);
		return col;
	}
	createImg(){
		let div = document.createElement('div');
		div.className = 'comments-img';
		this.img = document.createElement('img');
		div.appendChild(this.img);
		return div;
	}
	createUserInfo(){
		this.user = document.createElement('p');
		this.user.className = 'comments-user';
		return this.user;
	}
	createColComment(){
		let col = document.createElement('div');
		col.className = 'col-md-9';
		this.comment = document.createElement('p');
		this.comment.className = 'comments-content';
		this.date = document.createElement('p');
		this.date.className = 'comments-date text-right';
		col.appendChild(this.comment);
		col.appendChild(this.date);
		return col;
	}
}



class Comment {

	constructor(id){
		this.container = document.querySelector(`#${id}`);
		this.init();
	}

	init(){
		this.connect = new JSONconnect('vadzim','arrogaminca');
		this.connect.connect()
		.then(this.openTable.bind(this));
	}
	openTable(){
		this.connect.opentable('about','comments')
		.then(this.getDates.bind(this));
	}
	getDates(){
		this.comments = this.connect.bd.about.comments;
		this.insertDates();
	}
	insertDates(){
		for(let i = 0; i < this.comments.length; i++){
			let element = new CommentElement(this.id);
			element.comment.innerHTML = this.comments[i].comment;
			element.date.innerHTML = this.comments[i].date;
			element.user.innerHTML = this.comments[i].name;
			let imgSrc = this.comments[i].img === 'no' ? 'img/noprofile.png' : this.comments[i].img;
			element.img.setAttribute('src',imgSrc);
			this.container.appendChild(element.element);
		}
		this.initSwiper();
		this.connect.disconnect();
	}
	initSwiper(){
		var swiper = new Swiper('.swipper-comments', {
		  speed: 1000,
		  autoplay: 10000,
		  slidesPerView: 1,
		  spaceBetween: 50,
		  loop: true,
		});
	}
}
