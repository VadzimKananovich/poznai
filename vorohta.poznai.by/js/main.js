


// ============================================================================= RELAX MODAL WINDOW

let viewWidth = window.innerWidth;


// CARD CONTENT SMALL TEXT
	let contentCard = document.querySelectorAll('.relax-content');
	for(let i = 0; i < contentCard.length; i++){
		let contentTxt = contentCard[i].dataset.content;
		if(contentTxt) {
			let bodyEl = document.createElement('div');
			bodyEl.innerHTML = contentTxt;
			let res = bodyEl.textContent;
			let smallContent;
			// let maxChar = contentCard[i].offsetWidth / 2;
			maxChar = 300;
			smallContent = res.length > maxChar ? res.slice(0,maxChar)+'...' : res;
			contentCard[i].innerHTML = smallContent;
		}
	}
// CARD CONTENT OPEN MODAL BUTTON

function openModalRelax() {
	let modalWindow = document.querySelector('.modalToOpen');
	let thisContainer = this.parentElement.parentElement;
	let indicators = modalWindow.querySelector('.carousel-indicators');
	indicators.innerHTML = '';

	let relaxTitleTxt = thisContainer.querySelector('.relax-title').dataset.day;
	let relaxTitle = document.createTextNode(relaxTitleTxt);
	let modalTitleTxt = thisContainer.querySelector('.relax-title').dataset.title;
	let relaxModalTitle = document.createTextNode(modalTitleTxt);
	let relaxContent = thisContainer.querySelector('.relax-content').dataset.content;
	let relaxImg = thisContainer.querySelector('.relax-img-container img').dataset.img;
	let modalImg = relaxImg.split(',');

	let modalTitle = modalWindow.querySelector('.modal-title');
	modalTitle.innerHTML = '';
	modalTitle.appendChild(relaxTitle);

	let modalSecondTitle = modalWindow.querySelector('.modal-second-title');
	modalSecondTitle.innerHTML = '';
	modalSecondTitle.appendChild(relaxModalTitle);

	let modalContent = modalWindow.querySelector('.modal-content-wrap p');
	modalContent.innerHTML = '';
	modalContent.innerHTML = relaxContent;

	// CREATE CAROUSEL
	let modalCarousel = modalWindow.querySelector('.carousel-inner');
	modalCarousel.innerHTML = '';
	for(let i = 1; i < modalImg.length; i++){

		let carouselItem = document.createElement('div');
		let active = i === 1 ? 'active' : '';
		carouselItem.setAttribute('class','carousel-item slider-fullscreen-image '+active);
		carouselItem.setAttribute('data-bg-video-slide','false');
		carouselItem.setAttribute('style', 'background-image:url('+modalImg[0]+'/'+modalImg[i]+')');

		let containerSlide = document.createElement('div');
		containerSlide.setAttribute('class','container container-slide');

		let imageWrapper = document.createElement('div');
		imageWrapper.setAttribute('class','image_wrapper');

		let thisImg = document.createElement('img');
		thisImg.setAttribute('src', modalImg[0]+'/'+modalImg[i]);

		imageWrapper.appendChild(thisImg);
		containerSlide.appendChild(imageWrapper);
		carouselItem.appendChild(containerSlide);

		modalCarousel.appendChild(carouselItem);

		// CREATE CONTROL BUTTONS carousel
		if(i-1 < modalImg.length-1){
			let navLi = document.createElement('li');
			navLi.setAttribute('data-target','#modalWindowSlider-l');
			navLi.setAttribute('data-slide-to',i-1);
			if(i-1 === 0){
				navLi.setAttribute('class','active');
			}
			indicators.appendChild(navLi);
		}
	}
	this.setAttribute('data-target','#modalWindowSlider');
}






// ============================================================================== ROOM SECTION



$.ajax({
	cache: false,
	type: "GET",
	url: "includes/request.php",
	processData: true,
	data: {request:'pricerooms'},
	success: function(res) {
		let price = $.parseJSON(res);
		let roomSelectButton8 = document.querySelector('.room-select-title-wrap.room-8');
		let roomSelectButton10 = document.querySelector('.room-select-title-wrap.room-10');
		let roomSelectText8 = document.querySelector('.room-select-title.room-8');
		let roomSelectText10 = document.querySelector('.room-select-title.room-10');
		let roomSelectName8 = document.querySelectorAll('.room-select-name.room-8');
		let roomSelectName10 = document.querySelectorAll('.room-select-name.room-10');

		let first = firstDate(price);
		let dateName8 = roomSelectName8[first].dataset.date;
		let dateId8 = roomSelectName8[first].dataset.id;
		roomSelectText8.innerHTML = dateName8;
		viewData(dateId8,'room8');

		let dateName10 = roomSelectName10[first].dataset.date;
		let dateId10 = roomSelectName10[first].dataset.id;
		roomSelectText10.innerHTML = dateName10;
		viewData(dateId10,'room10');

		roomSelectButton8.addEventListener('click', () => hideShow('room8'), false);
		roomSelectButton10.addEventListener('click', () => hideShow('room10'), false);

		for(let i = 0; i < first; i++){
			roomSelectName8[i].parentNode.parentNode.removeChild(roomSelectName8[i].parentNode);
			roomSelectName10[i].parentNode.parentNode.removeChild(roomSelectName10[i].parentNode);
		}

		for(let i = first; i< roomSelectName8.length; i++){
			roomSelectName8[i].addEventListener('mouseover', ()=>{
				let dateId = roomSelectName8[i].dataset.id;
				let dateName = roomSelectName8[i].dataset.date;
				if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {

				} else {
					let txtCelebration = roomSelectName8[i].dataset.celebration;
					if(txtCelebration){
						let divCelebration = roomSelectName8[i].parentNode.querySelector('div');
						divCelebration.innerHTML= txtCelebration;
						if(divCelebration.classList.contains('celebration-modal-hide')){
							divCelebration.classList.remove('celebration-modal-hide');
							divCelebration.classList.add('celebration-modal-show');
						} else {
							divCelebration.classList.remove('celebration-modal-show');
							divCelebration.classList.add('celebration-modal-hide');
						}
					}
				}
				roomSelectText8.innerHTML = dateName;
				viewData(dateId,'room8');
			},false);
			if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {

			} else {
				roomSelectName8[i].addEventListener('click', ()=>{
					let dateName = roomSelectName8[i].dataset.date;
					roomSelectText8.innerHTML = dateName;
					hideShow('room8');
				},false);
			}
		}
		for(let i = first; i< roomSelectName8.length; i++){
			if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
				roomSelectName8[i].addEventListener('click', ()=>{
					let txtCelebration = roomSelectName8[i].dataset.celebration;
					if(txtCelebration){
						let divCelebration = roomSelectName8[i].parentNode.querySelector('div');
						if(divCelebration.classList.contains('celebration-modal-hide')){
							divCelebration.innerHTML= '';
							divCelebration.classList.remove('celebration-modal-hide');
							divCelebration.classList.add('celebration-modal-show');
							divCelebration.innerHTML= txtCelebration;
						} else {
							divCelebration.innerHTML= '';
							divCelebration.classList.remove('celebration-modal-show');
							divCelebration.classList.add('celebration-modal-hide');
						}
					}
				},false);
			} else {
				roomSelectName8[i].addEventListener('mouseout', ()=>{
					let txtCelebration = roomSelectName8[i].dataset.celebration;
					if(txtCelebration){
						let divCelebration = roomSelectName8[i].parentNode.querySelector('div');
						divCelebration.innerHTML= '';
						if(divCelebration.classList.contains('celebration-modal-hide')){
							divCelebration.classList.remove('celebration-modal-hide');
							divCelebration.classList.add('celebration-modal-show');
						} else {
							divCelebration.classList.remove('celebration-modal-show');
							divCelebration.classList.add('celebration-modal-hide');
						}
					}
				},false);
			}
		}


		for(let i = first; i< roomSelectName10.length; i++){
			roomSelectName10[i].addEventListener('mouseover', ()=>{
				let dateId = roomSelectName10[i].dataset.id;
				let dateName = roomSelectName10[i].dataset.date;
				if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {

				} else {
					let txtCelebration = roomSelectName10[i].dataset.celebration;
					if(txtCelebration){
						let divCelebration = roomSelectName10[i].parentNode.querySelector('div');
						divCelebration.innerHTML= txtCelebration;
						if(divCelebration.classList.contains('celebration-modal-hide')){
							divCelebration.classList.remove('celebration-modal-hide');
							divCelebration.classList.add('celebration-modal-show');
						} else {
							divCelebration.classList.remove('celebration-modal-show');
							divCelebration.classList.add('celebration-modal-hide');
						}
					}
				}
				roomSelectText10.innerHTML = dateName;
				viewData(dateId,'room10');
			},false);
			if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {

			} else {
				roomSelectName10[i].addEventListener('click', ()=>{
					let dateName = roomSelectName10[i].dataset.date;
					roomSelectText10.innerHTML = dateName;
					hideShow('room10');
				},false);
			}
		}

		for(let i = first; i< roomSelectName10.length; i++){
			if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
				roomSelectName10[i].addEventListener('click', ()=>{
					let txtCelebration = roomSelectName10[i].dataset.celebration;
					if(txtCelebration){
						let divCelebration = roomSelectName10[i].parentNode.querySelector('div');
						if(divCelebration.classList.contains('celebration-modal-hide')){
							divCelebration.innerHTML= '';
							divCelebration.classList.remove('celebration-modal-hide');
							divCelebration.classList.add('celebration-modal-show');
							divCelebration.innerHTML= txtCelebration;
						} else {
							divCelebration.innerHTML= '';
							divCelebration.classList.remove('celebration-modal-show');
							divCelebration.classList.add('celebration-modal-hide');
						}
					}
				},false);
			} else {
				roomSelectName10[i].addEventListener('mouseout', ()=>{
					let txtCelebration = roomSelectName10[i].dataset.celebration;
					if(txtCelebration){
						let divCelebration = roomSelectName10[i].parentNode.querySelector('div');
						divCelebration.innerHTML= '';
						if(divCelebration.classList.contains('celebration-modal-hide')){
							divCelebration.classList.remove('celebration-modal-hide');
							divCelebration.classList.add('celebration-modal-show');
						} else {
							divCelebration.classList.remove('celebration-modal-show');
							divCelebration.classList.add('celebration-modal-hide');
						}
					}
				},false);
			}
		}
	}
});

function viewData (dateId, type){
	let roomResPrice;
	if(type === 'room8'){
		roomResPrice = document.querySelectorAll('.room-res-price.room-8');
	} else {
		roomResPrice = document.querySelectorAll('.room-res-price.room-10');
	}
	for(let i =0; i < roomResPrice.length; i++){
		roomResPrice[i].style.display = 'none';
	}
	let priceToShow = document.querySelector('#'+dateId);
	priceToShow.style.display = "flex";
};

function hideShow (type) {
	let thisSelect;
	if(type === 'room8'){
		thisSelect = document.querySelector('.room-select-container ul.room-8');
	} else {
		thisSelect = document.querySelector('.room-select-container ul.room-10');
	}
	if(thisSelect.classList.contains('room-select-hide')){
		thisSelect.classList.remove('room-select-hide');
		thisSelect.classList.add('room-select-show');
		thisSelect.style.overflowY = 'auto';
	} else {
		thisSelect.classList.remove('room-select-show');
		thisSelect.classList.add('room-select-hide');
		thisSelect.style.overflowY = 'hidden';
	}
}



function firstDate (price) {
	let firstDay8 = false;
	for(let i = 0; i< price.length; i++){
		let firstDay = price[i].roomsDate8.split('-');
		let partDate = firstDay[0].split('/');
		let help = partDate[2];
		partDate[2] = partDate[0];
		partDate[0] = help;
		partDate[0] = partDate[0].trim();
		partDate[1] = partDate[1].trim();
		partDate[2] = partDate[2].trim();
		firstDay[0] = partDate.join('-');
		let day8 = new Date(firstDay[0]);
		let today = new Date();
		if(!firstDay8){
			if(today<day8){
				firstDay8 = i;
			}
		} else {
			return firstDay8;
		}
	}
}

// ================================================================================ NO INCLUDE SECTION

let noIncludeButton = document.querySelector('#noInclude');
let spoller = document.querySelector('#noIncludeSpoller');
let noIncludeIco = document.querySelector('.noIncludeIco');


noIncludeButton.addEventListener('click', () => {
	if(spoller.classList.contains('spoller-hide')){
		spoller.classList.remove('spoller-hide');
		spoller.classList.add('spoller-show');
		noIncludeIco.classList.remove('fa-plus');
		noIncludeIco.classList.add('fa-minus');
	} else {
		spoller.classList.remove('spoller-show');
		spoller.classList.add('spoller-hide');
		noIncludeIco.classList.remove('fa-minus');
		noIncludeIco.classList.add('fa-plus');
	}
}, false);

// TOP TEL SPOLLER

let topSpallerButton = document.querySelector('#topTel');
let topSpaller = document.querySelector('#topTelSpaller');

topSpallerButton.addEventListener('click', () => {

	if(topSpaller.classList.contains('top-spaller-hide')){
		topSpaller.classList.remove('top-spaller-hide');
		topSpaller.classList.add('top-spaller-show');
	} else {
		topSpaller.classList.remove('top-spaller-show');
		topSpaller.classList.add('top-spaller-hide');
	}

}, false);







// MENU WITH PRICE AND DATE SPOLLER
