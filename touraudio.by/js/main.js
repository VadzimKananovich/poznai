//=============================================================================== SEND comment




if(location.search.indexOf('sendcomment') > -1){
	window.location.href = location.pathname+'#sendcomment';
}

//============================================================================== MENU
// CREATE MENU ELEMENTS
let section = document.querySelectorAll('.menu-section');
for(let i =0; i <section.length; i++) {
	let active;
	i === 0 ? active = 'active' : active = '';
	if (!section[i].dataset.type || section[i].dataset.type === 'landpage'){
		createElementMenu(`#${section[i].id}`, section[i].dataset.menuico, section[i].dataset.menuname,active);
	}
}
const buy = document.querySelector('#buy');
// if(!buy){
// 	createElementMenu('?page=shop','fas fa-shopping-cart','Магазин','active-purple replace');
// }


function createElementMenu (href,menuico,menuname,addclass='') {
	let menuContainer = document.querySelector('.top-menu');
	let li = document.createElement('li');
	li.setAttribute('class','top-menu-name');
	let a = document.createElement('a');
	a.setAttribute('href', `${href}`);
	a.setAttribute('class', 'top-menu-link'+' '+addclass);
	a.dataset.href = href;

	let iFa = document.createElement('i');
	iFa.setAttribute('class',`${menuico}`);
	let span = document.createElement('span');
	let txtSpan = document.createTextNode(`${menuname}`);
	span.appendChild(txtSpan);
	a.appendChild(iFa);
	a.appendChild(span);
	li.appendChild(a);
	menuContainer.appendChild(li);
}



//============================================================================== ON SCROLL ANIMATION
const navHeight = document.querySelector('nav').offsetHeight;
const toTop = document.querySelector('#toTop');
const navButton = document.querySelectorAll('.top-menu-link');
const infoContent = document.querySelector('.info-content-border');
const complectItem = document.querySelectorAll('.complect-item');




function innerEffects () {
	const showFromBottom = document.querySelectorAll('.show-from-bottom');
	const showFromTop = document.querySelectorAll('.show-from-top');
	const showFromLeft = document.querySelectorAll('.show-from-left');
	const showFromRight = document.querySelectorAll('.show-from-right');
	for(let i = 0; i < showFromBottom.length; i++){
		showEffect('bottom',showFromBottom[i]);
	}

	for(let i = 0; i < showFromTop.length; i++){
		showEffect('top',showFromTop[i]);
	}
	for(let i = 0; i < showFromLeft.length; i++){
		showEffect('left', showFromLeft[i]);
	}
	for(let i = 0; i < showFromRight.length; i++){
		showEffect('right', showFromRight[i]);
	}
}

function showEffect (from,el){
	let height = el.offsetHeight;
	let width = el.offsetWidth;
	let position = el.getBoundingClientRect().top + 100;
	let childEl = el.querySelector('span:only-child');
	let timer = 0;
	if(el.dataset.timer){
		timer = el.dataset.timer * 100;
	}
	switch(from){
		case 'top':
		if(window.innerHeight > position){
			if(!childEl.hasAttribute('style')){
				childEl.setAttribute('style',`top: -${height}px;`);
				setTimeout(()=>{
					childEl.setAttribute('style','top:0; opacity:1;');
				},timer);
			}
		}
		break;
		case 'bottom':
		if(window.innerHeight > position){
			if(!childEl.hasAttribute('style')){
				childEl.setAttribute('style',`top: ${height}px;`);
				setTimeout(()=>{
					childEl.setAttribute('style','top:0; opacity:1;');
				},timer);
			}
		}
		break;
		case 'left':
		if(window.innerHeight > position){
			if(!childEl.hasAttribute('style')){
				childEl.setAttribute('style',`left: -${width}px;`);
				setTimeout(()=>{
					childEl.setAttribute('style','left:0; opacity:1;');
				},timer);
			}
		}
		break;
		case 'right':
		if(window.innerHeight > position){
			if(!childEl.hasAttribute('style')){
				childEl.setAttribute('style',`left: ${width}px;`);
				setTimeout(()=>{
					childEl.setAttribute('style','left:0; opacity:1;');
				},timer);
			}
		}
		break;
	}
}

document.addEventListener('scroll', () => {
	innerEffects();
	// SET NAV BUTTON ACTIVE
	for(let i = 0; i < navButton.length; i++ ){
		if(!navButton[i].classList.contains('replace')){
			let sectionId = navButton[i].dataset.href;
			if(sectionId.indexOf('/') === -1 && sectionId.indexOf('?') === -1 ){
				if(window.pageYOffset >= document.querySelector(`${sectionId}`).offsetTop){
					if(!navButton[i].classList.contains('active')) {
						navButton[i].classList.add('active');
					}
				}	else {
					if(navButton[i].classList.contains('active')){
						navButton[i].classList.remove('active');
					}
				}
				if(window.pageYOffset > document.querySelector(`${sectionId}`).offsetTop + document.querySelector(`${sectionId}`).offsetHeight - navHeight){
					if(navButton[i].classList.contains('active')){
						navButton[i].classList.remove('active');
					}
				}
			}
		}
	}

	// TO TOP BUTTON SHOW/HIDE
	if(window.pageYOffset > 500){
		if(!toTop.classList.contains('toTop-show')){
			toTop.classList.add('toTop-show');
		}
	} else {
		if(toTop.classList.contains('toTop-show')){
			toTop.classList.remove('toTop-show');
		}
	}

	if(infoContent){

		if(window.innerHeight > infoContent.getBoundingClientRect().top + 100){
			if(!infoContent.classList.contains('show-from-center')){
				infoContent.classList.add('show-from-center');
			}
		}
	}
	for(let i = 0; i < complectItem.length; i++){
		if(window.innerHeight > complectItem[i].getBoundingClientRect().top + 100){
			if(!complectItem[i].classList.contains('show-from-right')){
				complectItem[i].classList.add('show-from-right');
			}
		}
	}

});


// MENU HAMBURGER
jQuery(function($){
	$('nav button').on('click', function() {
		$(this).toggleClass('is-active');
	});
});

let menuButton = document.querySelector('.menu-hamburger');
let menu = document.querySelector('.top-menu');

let itemMenu = document.querySelectorAll('.top-menu-name');
let itemMenuCount = 0;

for(let i =0; i<itemMenu.length; i++){
	itemMenuCount = itemMenuCount + 45;
}
menuButton.addEventListener('click', () => {
	menu.hasAttribute('style') ? menu.removeAttribute('style') : menu.setAttribute('style', `height: ${itemMenuCount}px;`);
}, false);




//============================================================================== MODAL

let modalButton = document.querySelectorAll('.openModal');
let modalWindow = document.querySelector('#modalContact');

// if(modalWindow){
	let modalTitle = modalWindow.querySelector('.modal-title');
	let modalForm = modalWindow.querySelector('form');
	let modalFormUrl = modalForm.action.split('?');
// }

for (let i = 0; i < modalButton.length; i++ ){
	modalButton[i].addEventListener('click', ()=> {
		let typeAction = modalButton[i].dataset.type;
		let typeModal = modalButton[i].dataset.modal;
		switch(typeAction){
			case 'left':
			if(modalWindow.classList.contains('modal-show-right')) {
				modalWindow.classList.remove('modal-show-right');
			}
			if(!modalWindow.classList.contains('modal-show-left')) {
				modalWindow.classList.add('modal-show-left');
			}
			break;
			case 'right':
			if(modalWindow.classList.contains('modal-show-left')) {
				modalWindow.classList.remove('modal-show-left');
			}
			if(!modalWindow.classList.contains('modal-show-right')) {
				modalWindow.classList.add('modal-show-right');
			}
			break;
		}
		switch(typeModal){
			case 'rent':
			modalTitle.innerHTML = 'Арендовать радиогид';
			modalForm.setAttribute('action', modalFormUrl[0]+'?action=send&modal=rent');
			break;
			case 'buy':
			modalTitle.innerHTML = 'Купить радиогид';
			modalForm.setAttribute('action', modalFormUrl[0]+'?action=send&modal=buy');
			break;
		}
	});
}

// SEND EMAL modal
let modal = {
	create: function (text) {
		let bg = document.createElement('div');
		bg.setAttribute('class','modal-hide');
		let modalConfirm = document.createElement('div');
		modalConfirm.setAttribute('id','modalConfirm');
		modalConfirm.setAttribute('class','modal-confirm');
		let modalContent = document.createElement('div');
		modalContent.setAttribute('class','modal-content-wrap');
		let h6 = document.createElement('h6');
		h6.setAttribute('class', 'modal-title');
		h6.innerHTML = text;
		let closeButton = document.createElement('div');
		closeButton.classList.add('modal-close');
		modalContent.appendChild(h6);
		modalContent.appendChild(closeButton);
		modalConfirm.appendChild(modalContent);
		bg.appendChild(modalConfirm);
		document.body.appendChild(bg);
		this.src = bg;
		this.showHide();
		this.src.addEventListener('click', (e)=>{
			if(e.target === e.currentTarget || e.target.classList.contains('modal-close')){
				modal.showHide();
			}
		});
	},
	showHide: function () {
		if(this.src.classList.contains('modal-hide')){
			this.src.style.opacity = 0;
			this.src.classList.remove('modal-hide');
			this.src.classList.add('modal-show');
			this.src.style.opacity = 1;
			document.body.style.overflow='hidden';
		} else {
			this.src.style.opacity = 0;
			setTimeout(()=>{
				this.src.classList.remove('modal-show');
				this.src.classList.add('modal-hide');
				document.body.style.overflow='auto';
			},300);
		}
	}
}



let localHash = window.location.hash;
if(localHash === '#sended'){
	modal.create('Ваше сообщение успешно отпралено!');
}
if(localHash === '#sendeRequest'){
	modal.create('Ваше заявка успешно отпралена!<br>В ближайшее время с вами свяжется наш менеджер');
}
if(localHash === '#rentConfirm'){
	modal.create('Ваше заявка по аренде оборудования успешно отпралена!<br>В ближайшее время с вами свяжется наш менеджер');
}
if(localHash === '#buyConfirm'){
	modal.create('Ваше заявка по покупке оборудования успешно отпралена!<br>В ближайшее время с вами свяжется наш менеджер');
}
if(localHash === '#sendcomment'){
	modal.create('Благодарим вас за отзыв');
}
// REMOVE LOCATION HASH
function removeLocationHash(){
	setTimeout(()=>{
		var noHashURL = window.location.href.split('#');
		window.history.replaceState('', document.title, noHashURL[0]);
	},0);

}
window.addEventListener("popstate", function(event){
	removeLocationHash();
});
window.addEventListener("hashchange", function(event){
	// event.preventDefault();
	removeLocationHash();
});
window.addEventListener("load", function(){
	removeLocationHash();
});
