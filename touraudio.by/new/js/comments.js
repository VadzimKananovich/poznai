


$(document).ready(function(){
	$.ajax({
		cache: false,
		type: "POST",
		url: "includes/request.php",
		processData: true,
		data: {request:'comments'},
		success: function(res) {
			let comments = $.parseJSON(res);
			console.log(comments);
			let createComments = new Comments(comments, 'img/comments_foto/', document.querySelector('.comments-wrap'));
			console.log(createComments);
		}
	});
});



class CommentsRow {
	constructor(){
		this.container = this.createContainer();
	}
	createContainer () {
		let div = document.createElement('div');
		div.classList.add('comments-row');
		let imgDate = this.createImgDateContainer();
		let commentsContent = this.createCommentsContent();
		div.appendChild(imgDate);
		div.appendChild(commentsContent);
		return div;
	}

	createImgDateContainer() {
		let div = document.createElement('div');
		div.classList.add('comments-img-name');
		let commentImg = this.createCommentImg();
		let commentsTitle = document.createElement('p');
		commentsTitle.classList.add('comments-title');
		let wrapperTitle = document.createElement('span');
		commentsTitle.appendChild(wrapperTitle);

		div.appendChild(commentImg);
		div.appendChild(commentsTitle);
		this.nameContainer = wrapperTitle;
		return div;
	}

	createCommentImg() {
		let div = document.createElement('div');
		div.classList.add('comments-img');
		let img = document.createElement('img');
		img.setAttribute('alt','tour-audio');
		div.appendChild(img);
		this.img = img;
		return div;
	}

	createCommentsContent() {
		let div = document.createElement('div');
		div.classList.add('comments-content');
		let commentsText = document.createElement('p');
		commentsText.classList.add('comments-text');
		let commentsDate = document.createElement('p');
		commentsDate.classList.add('comments-date');

		div.appendChild(commentsText);
		div.appendChild(commentsDate);
		this.dateContainer = commentsDate;
		this.commentContainer = commentsText;
		return div;
	}

}

class Comments {
	constructor(array, imgPatch, container){
		this.insertDates(array,imgPatch, container);
	}

	insertDates(array, imgPatch, container){
		for (let i = 0; i < array.length; i++){
			let commentRow = new CommentsRow;
			if(i%2!==0){
				commentRow.container.classList.add('comments-reverse');
			}
			let textName = document.createTextNode(array[i].name);
			commentRow.nameContainer.appendChild(textName);

			commentRow.img.setAttribute('src', this.createImg(array[i].img,imgPatch));

			let onlyData = this.createDate(array[i].currentDate);
			let textDate = document.createTextNode(onlyData);
			commentRow.dateContainer.appendChild(textDate);

			let textComment = document.createTextNode(array[i].comment);
			commentRow.commentContainer.appendChild(textComment);
			container.appendChild(commentRow.container);
		}
	}
	createDate(data){
		let newData = data.split(' ');
		return newData[0];
	}
	createImg(img,imgPatch){
		return img ? imgPatch+img : imgPatch+'noprofile.png';
	}
}
