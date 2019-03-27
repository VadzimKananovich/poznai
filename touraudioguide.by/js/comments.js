class CommentsDom {
	constructor(){
		this.element = this.createWrapper();
	}

	createWrapper(){
		let div = document.createElement('div');
		div.classList.add('item');
		div.appendChild(this.createTitle());
		this.content = document.createElement('p');
		div.appendChild(this.content);
		div.appendChild(this.createMedia());
		return div;
	}
	createTitle(){
		let div = document.createElement('div');
		div.classList.add('text-center');
		div.appendChild(this.createImg());
		this.title = document.createElement('h4');
		this.title.className = 'body-slider media-heading';
		div.appendChild(this.title);
		let hr = document.createElement('hr');
		hr.className = 'slider_hr';
		div.appendChild(hr);
		return div;
	}
	createImg(){
		let div = document.createElement('div');
		div.classList.add('img-s');
		let img = document.createElement('img');
		img.setAttribute('src', 'assets/images/testimonial-top.png');
		div.appendChild(img);
		return div;
	}
	createMedia(){
		let div = document.createElement('div');
		div.className = 'media';
		div.appendChild(this.createMediaLeft());
		div.appendChild(this.createMediaBody());
		return div;
	}
	createMediaLeft(){
		let div = document.createElement('div');
		div.className = 'media-left';
		this.img = document.createElement('img');
		div.appendChild(this.img);
		return div;
	}
	createMediaBody(){
		let div = document.createElement('div');
		div.className = 'media-body';
		let name = document.createElement('h4');
		name.className = 'media-heading';
		this.userName = document.createElement('span');
		this.userName.className = 'user-name';
		name.appendChild(this.userName);
		this.date = document.createElement('span');
		this.date.className = 'slider_span_color';
		name.appendChild(this.date);
		div.appendChild(name);
		return div;
	}
}


/* ===========================================
COMMENTS CLASS
==============================================*/

class Comments {
	constructor(id){
		this.container = document.querySelector(`#${id}`);
		this.getComments();
	}
	getComments(){
		$.ajax({
			cache: false,
			type: "GET",
			url: 'includes/request.php?request=comments',
			processData: true,
			success: this.parseComments.bind(this)
		});
	}
	parseComments(res){
		this.comments = JSON.parse(res);
		this.insertComments();
	}
	insertComments(){
		for(let i = 0; i < this.comments.length; i++){
			let comment = new CommentsDom;
			let date = this.comments[i].currentDate;
			let correctDate = date.split(' ');
			comment.date.innerHTML = correctDate[0];
			comment.content.innerHTML = this.comments[i].comment;
			comment.userName.innerHTML = this.comments[i].name;
			let img = this.comments[i].img === 'null' ? 'img/no-profile.jpg' : this.comments[i].img;
			comment.img.setAttribute('src',img);
			this.container.appendChild(comment.element);
		}
		this.initCarousel();
	}
	initCarousel(){
		$('.testimonial_carosel').owlCarousel({
			loop:true,
			items:1,
			autoplay:false,
		});
	}
}
