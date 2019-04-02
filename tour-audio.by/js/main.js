class Header{
  constructor(selector){
    this.getItems(selector);
    this.cutDesc();
    this.init();
  }
  getItems(selector){
    this.container = document.querySelector(selector);
    this.desc = this.container.querySelectorAll('.carousel-content');
    this.btn = this.container.querySelectorAll('.read-more-btn');

    this.modal = document.querySelector('#readMoreModal');
    this.modalTitle = this.modal.querySelector('.modal-title');
    this.modalCaption = this.modal.querySelector('.modal-caption');
    this.modalSlogan = this.modal.querySelector('.modal-slogan');
    this.modalText = this.modal.querySelector('.modal-text');
  }
  cutDesc(item,desc){
    this.desc.forEach((item,i) => {
      let desc = item.textContent;
      if(desc.length > 400){
        let subDesc = desc.substring(0,400);
        let lastSpace = subDesc.lastIndexOf(' ');
        item.innerHTML = subDesc.substring(0,lastSpace) + ' ...';
      }
    });
  }
  init(){
    this.getDates('includes/request.php?action=get_json&path='+encodeURIComponent('../JSON/header.json'))
    .then(this.insertDates.bind(this))
  }
  insertDates(res){
    if(res){
      let dates = JSON.parse(res);
      this.slider = dates.slider;
      this.initBtn();
    } else {
      console.error('Your file is empty or damaged');
    }
  }
  initBtn(){
    this.btn.forEach(item=>{
      item.addEventListener('click',this.initModal.bind(this,Number(item.dataset.key)));
    });
  }
  initModal(key){
    key = Number(key);
    this.modalTitle.innerHTML = this.strip_tags(this.slider[key].title + ' ' + this.slider[key].for);
    let img = new Image();
    let path = this.createFormatPath(this.slider[key].imgPath);
    img.src = path+this.slider[key].img;
    this.modalCaption.innerHTML = '';
    this.modalCaption.appendChild(img);
    this.modalSlogan.innerHTML = this.slider[key].slogan;
    this.modalText.innerHTML = this.slider[key].desc;
    $(this.modal).modal();
  }
  strip_tags(txt){
    let div = document.createElement('div');
    div.innerHTML = txt;
    return div.textContent;
  }
  createFormatPath(path){
		if(path){
			let clearePath = path.replace(/\s/g,'');
			let splitPath = clearePath.split('/');
			let filterPath = splitPath.filter((item)=>item);
			let joinPath = filterPath.join('/')+'/';
			return joinPath;
		} else {
			return path;
		}
	}
  getDates(url) {
    this.http = new XMLHttpRequest();
    this.http.open('GET',url);
    this.http.send();
    return new Promise(this.writeDates.bind(this));
  }
  writeDates(resolve,reject){
    this.http.onreadystatechange = ()=>{
      if(this.http.readyState === 4 && this.http.status === 200){
        resolve(this.http.responseText);
      }
    }
  }

}


//==========================================
// MOBAILE MENU
//=========================================
"use strict";
jQuery(document).ready(function ($) {
  $('#navbar-menu').find('a[href*="#"]:not([href="#"])').click(function () {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: (target.offset().top - 0)
        }, 1000);
        if ($('.navbar-toggle').css('display') != 'none') {
          $(this).parents('.container').find(".navbar-toggle").trigger("click");
        }
        return false;
      }
    }
  });

  $(window).load(function () {
    $("#loading").fadeOut(500);
  });
});
