export class AnimateNav{

  constructor(set){
    this.initDefaultSet();
    this.initSet(set);
    this.getElements();
    this.init();
  }

  initDefaultSet(){
    this.set = {
      'nav':'nav',
      'offset': 100,
      'className': 'animate-nav'
    }
  }

  initSet(set){
    for(let key in set){
      this.set[key] = set[key];
    }
  }

  getElements(){
    this.nav = document.querySelector(this.set.nav);
  }

  init(){
    window.addEventListener('scroll',()=>{
      if(window.scrollY > this.set.offset){
        this.addAnimateNav();
      } else {
        this.removeAnimateNav();
      }
    });
  }

  addAnimateNav(){
    if(!this.nav.classList.contains(this.set.className)){
      this.nav.classList.add(this.set.className);
    }
  }
  removeAnimateNav(){
    if(this.nav.classList.contains(this.set.className)){
      this.nav.classList.remove(this.set.className);
    }
  }
}


export class LandNav{
  constructor(set){
    this.initDefaultSet();
    this.initSet(set);
    this.getElements();
    this.init();
  }
  initDefaultSet(){
    this.set = {
      'nav':'nav',
      'links':'a',
      'activeClass':'active',
      'offset':100
    }
  }
  initSet(set){
    for(let key in set){
      this.set[key] = set[key];
    }
  }
  getElements(){
    this.nav = document.querySelector(this.set.nav);
    this.links = document.querySelectorAll(this.set.links);
    this.items = [];
    this.links.forEach(link=>{
      let section = document.querySelector(link.getAttribute('href'));
      this.items.push({
        'section': section,
        'top': (section.getBoundingClientRect().y + window.scrollY - this.set.offset),
      });
    });
  }
  init(){
    window.addEventListener('scroll',this.scrollWindow.bind(this));
    this.links.forEach(link=>{
      link.addEventListener('click',this.initLink.bind(this,link));
    });
  }
  scrollWindow(){
    this.items.forEach((item,i)=>{
      if(window.scrollY > item.top){
        this.removeAllActiveClass();
        this.addActive(this.links[i]);
      }
      if(window.scrollY < this.items[0].top){
        this.removeAllActiveClass();
      }
    })
  }
  initLink(link,e){
    e.preventDefault();
    let item = document.querySelector(link.getAttribute('href'));
    item.scrollIntoView(true);
    this.removeAllActiveClass();
    this.addActive(link);
  }
  removeAllActiveClass(){
    this.links.forEach(link=>{
      if(link.classList.contains(this.set.activeClass)){
        link.classList.remove(this.set.activeClass);
      }
    });
  }
  addActive(link){
    if(!link.classList.contains(this.set.activeClass)){
      link.classList.add(this.set.activeClass);
    }
  }
}
