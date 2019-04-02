class LandPageMenu{
  constructor(selector,margin){
    this.calcMargin(margin,selector);
    this.init(selector);
  }
  calcMargin(margin,selector){
    if(!margin){
      let nav = document.querySelector(selector);
      this.margin = nav.offsetHeight + 10;
    } else {
      this.margin = margin;
    }
  }
  init(selector){
    this.selector = selector;
    window.addEventListener('load',(()=>{
      this.getNavElements();
      this.getSections();
      this.initActive();
      this.initNav();
    }).bind(this));
  }
  initNav(){
    this.navItems.forEach((item,i)=>{
      item.addEventListener('click',((i,e)=>{
        e.preventDefault();
        window.scrollTo(0,this.sections[i] - this.margin);
      }).bind(this,i));
    });
  }
  getNavElements(){
    this.container = document.querySelector(this.selector);
    this.navItems = this.container.querySelectorAll('.nav-land');
  }
  getSections(){
    this.sections = [];
    for(let i = 0; i < this.navItems.length; i++){
      let key = this.navItems[i].dataset.menu;
      let element = document.querySelector('#'+key);
      if(element){
        this.sections.push(element.getBoundingClientRect().top + window.scrollY);
      }
    }
  }
  initActive(){
    this.calcNextStep();
    window.addEventListener('scroll',this.calcNextStep.bind(this));
  }
  calcNextStep(){
    for(let i = 0; i < this.sections.length; i++){
      if(window.pageYOffset >= this.sections[i]+this.margin+10 && this.sections[i+1] ? window.pageYOffset < this.sections[i+1]-this.margin-10 : true){
        this.changeActive(i);
        return;
      }
    }
  }
  changeActive(i){
    this.navItems.forEach((item)=>{
      if(item.classList.contains('active')){
        item.classList.remove('active');
      }
    });
    if(!this.navItems[i].classList.contains('active')){
      this.navItems[i].classList.add('active');
    }
  }
}
