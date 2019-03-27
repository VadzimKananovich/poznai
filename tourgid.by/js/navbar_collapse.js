class NavbarCollapse{
  constructor(set){
    this.initDefaultSet();
    this.initSet(set);
    this.getItems();
    this.initElements();
    this.resizeEvent();
    this.init();
  }
  initDefaultSet(){
    this.set = {
      'container':'.head-nav',
      'menu':'#topMenu',
      'openBtn':'.drop-down-btn',
      'closeBtn':'.close-btn',
      'collapseClass':'collapse',
      'navBtn':'.nav-menu-link',
      'animateNav':'fadeInRight',
      'breakPoint': 700,
      'transition': .3,
      'menuDisplay':'flex',
      'openBtnDisplay':'flex'
    };
  }
  initSet(set){
    for(let key in set){
      this.set[key] = set[key];
    }
  }
  getItems(){
    this.menu = document.querySelector(this.set.menu);
    this.container = document.querySelector(this.set.container) || this.menu.parentNode;
    this.openBtn = document.querySelector(this.set.openBtn);
    this.closeBtn = document.querySelector(this.set.closeBtn);
    this.navBtn = document.querySelectorAll(this.set.navBtn);
  }

  initElements(){
    if(this.set.animateNav){
      this.navBtn.forEach(btn=>{
        if(!btn.classList.contains('animated')){
          btn.classList.add('animated');
          btn.style.opacity = '0';
        }
      })
    }
    this.openBtn.addEventListener('click',this.initOpenBtn.bind(this));
    this.closeBtn.addEventListener('click',this.initCloseBtn.bind(this));
    this.navBtn.forEach(item=>item.addEventListener('click',this.initCloseBtn.bind(this)));
  }

  resizeEvent(){
    window.addEventListener('resize',this.init.bind(this));
  }

  init(){
    this.width = window.innerWidth;
    if(this.width <= this.set.breakPoint) {
      this.applyDefaultStyle();
      this.addCollapse();
    } else {
      this.removeDefaultStyle();
      this.removeCollapse();
    }
  }

  applyDefaultStyle(){
    this.openBtn.style.display = this.set.openBtnDisplay;
    document.body.appendChild(this.menu);
    this.menu.style.display = 'none';
    this.menu.style.transition = this.set.transition+'s';
    this.menu.style.opacity = '0';
  }

  removeDefaultStyle(){
    this.openBtn.removeAttribute('style');
    this.container.appendChild(this.menu);
    this.menu.removeAttribute('style');
    this.navBtn.forEach(btn=>{
      btn.removeAttribute('style');
      let copy = btn.cloneNode(true);
      btn.parentNode.replaceChild(copy,btn);
    });
  }

  initOpenBtn(){
    this.menu.style.display = this.set.menuDisplay;
    setTimeout(()=>{
      this.menu.style.opacity = '1';
      this.navBtn.forEach(btn=>{
        btn.classList.add(this.set.animateNav);
        btn.style.opacity = '1';
      });
    },0);
  }

  initCloseBtn(){
    this.menu.style.opacity = '0';
    setTimeout(()=>{
      this.menu.style.display = 'none';
    },(this.set.transition * 1000));
  }


  addCollapse(){
    if(!document.body.classList.contains(this.set.collapseClass)){
      document.body.classList.add(this.set.collapseClass);
    }
  }
  removeCollapse(){
    if(document.body.classList.contains(this.set.collapseClass)){
      document.body.classList.remove(this.set.collapseClass);
    }
  }
}
