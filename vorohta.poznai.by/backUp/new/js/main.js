let roomSelectButton8 = document.querySelector('.room-select-title-wrap.room-8');
let roomSelectButton10 = document.querySelector('.room-select-title-wrap.room-10');
let roomSelectText8 = document.querySelector('.room-select-title.room-8');
let roomSelectText10 = document.querySelector('.room-select-title.room-10');
let roomSelectName8 = document.querySelectorAll('.room-select-name.room-8');
let roomSelectName10 = document.querySelectorAll('.room-select-name.room-10');
// let roomSelect8 = document.querySelector('.room-select-container ul.room-8');
// let roomSelect10 = document.querySelector('.room-select-container ul.room-10');
// let roomResPrice8 = document.querySelectorAll('.room-res-price.room-8');
// let roomResPrice10 = document.querySelectorAll('.room-res-price.room-10');


roomSelectButton8.addEventListener('click', () => hideShow('room8'), false);
roomSelectButton10.addEventListener('click', () => hideShow('room10'), false);


for(let i = 0; i< roomSelectName8.length; i++){
	roomSelectName8[i].addEventListener('mouseover', ()=>{
		let dateId = roomSelectName8[i].dataset.id;
		let dateName = roomSelectName8[i].dataset.date;
		roomSelectText8.innerHTML = dateName;
		viewData(dateId,'room8');
	},false);
	roomSelectName8[i].addEventListener('click', ()=>{
		let dateName = roomSelectName8[i].dataset.date;
		roomSelectText8.innerHTML = dateName;
		hideShow('room8');
	},false);
}
for(let i = 0; i< roomSelectName10.length; i++){
	roomSelectName10[i].addEventListener('mouseover', ()=>{
		let dateId = roomSelectName10[i].dataset.id;
		let dateName = roomSelectName10[i].dataset.date;
		roomSelectText10.innerHTML = dateName;
		viewData(dateId,'room10');
	},false);
	roomSelectName10[i].addEventListener('click', ()=>{
		let dateName = roomSelectName10[i].dataset.date;
		roomSelectText10.innerHTML = dateName;
		hideShow('room10');
	},false);
}


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
