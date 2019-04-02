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
