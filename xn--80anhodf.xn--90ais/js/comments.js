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
		this.connect = new JSONconnect;
		this.connect.open_json('about','comments')
		.then(this.getDates.bind(this));
	}
	getDates(){
		this.comments = this.connect.json.about.comments;
		this.insertDates();
	}
	insertDates(){
		for(let i = 0; i < this.comments.length; i++){
			if(this.comments[i].state === 'confirm'){
				let element = new CommentElement(this.id);
				element.comment.innerHTML = this.comments[i].comment;
				element.date.innerHTML = this.comments[i].date;
				element.user.innerHTML = this.comments[i].name;
				let imgSrc = this.comments[i].img === 'no' ? 'img/noprofile.png' : this.comments[i].img;
				element.img.setAttribute('src',imgSrc);
				this.container.appendChild(element.element);
			}
		}
		this.initSwiper();
	}
	initSwiper(){
		var swiper = new Swiper('.swipper-comments', {
			speed: 1000,
			autoplay: 10000,
			slidesPerView: 3,
			spaceBetween: 10,
			loop: true,
			breakpoints: {
				480: {
					slidesPerView: 1,
					spaceBetween: 5
				}
			}
		});
	}
}


class LeaveComment{
	constructor(id){
		this.conn = new JSONconnect;
		this.form = document.querySelector(`#${id}`);
		this.init();
	}
	init(){
		this.name = this.form.querySelector('#name');
		this.email = this.form.querySelector('#email');
		this.comment = this.form.querySelector('#comment');
		this.submit = this.form.querySelector('#submitButton');
		this.date = this.createDate();
		this.insertComment();
	}
	createDate(){
		let today = new Date();
		let dd = today.getDate();
		let mm = today.getMonth() + 1;
		let yyyy = today.getFullYear();
		if (dd < 10) {
			dd = '0' + dd;
		}
		if (mm < 10) {
			mm = '0' + mm;
		}
		today = mm + '/' + dd + '/' + yyyy;
		return today;
	}
	insertComment(){
		this.conn.json_push('about','comments',{
			'name':this.name.value,
			'email':this.email.value,
			'comment':this.comment.value,
			'img':'no',
			'date': this.date,
			'state':'pending'
		});
	}
}
