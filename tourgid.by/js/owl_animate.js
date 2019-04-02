class OwlAnimate {
  constructor(set){
    this.initDefaultSet();
    this.initPassedSet(set);
    this.init();
  }

  initDefaultSet(){
    this.set = {
      'container':'.owl-carousel',
      'animate':
      false,
      // {
      //   // 'items':['.like-h1','p'],
      //   // 'animateCss':['fadeIn','bounceIn'],
      //   '0':{
      //     'items':['.like-h1','p'],
      //     'animateCss':['fadeIn','bounceIn']
      //   },
      //   'nth-2':{
      //     'items':['.like-h1','p'],
      //     'animateCss':['fadeInRight','fadeInUp']
      //   },
      //   'nth-7':{
      //     'items':['.like-h1','p'],
      //     'animateCss':['fadeInDown','fadeOnDownBig']
      //   }
      // },
      'item':'.item',
      'owlSet': false
    }
  }
  initPassedSet(set) {
    for(let key in set){
      this.set[key] = set[key]
    }
  }

  init(){
    this.getItems();
    this.initCarousel();
    if(this.set.animate){
      this.getCarouselItems();
      this.initAnimate();
    }
  }

  getItems() {
    this.owl = {};
    this.owl.container = document.querySelector(this.set.container);
    this.owl.items = [];
    let items = this.owl.container.querySelectorAll(this.set.item);
    items.forEach(item=>this.owl.items.push(item));
    if(this.set.animate){
      this.getAnimateItems();
    }
  }


  getAnimateItems(){
    this.animate = [];
    let animateKeys = Object.keys(this.set.animate);
    animateKeys.forEach((key,i)=>{
      if(Number(key) || Number(key) === 0){
        this.animate[Number(key)] = {};
        this.animate[Number(key)].container = this.owl.items[Number(key)];
        this.animate[Number(key)].container.dataset.owlId = Number(key);
        this.animate[Number(key)].animateCss = this.set.animate[key].animateCss || this.set.animate.animateCss || [];
        let items = this.set.animate[key].items || this.set.animate.items || [];
        this.animate[Number(key)].items = [];
        items.forEach((selector,i) => {
          let element = this.owl.items[Number(key)].querySelector(selector);
          element.classList.add('animated');
          element.dataset.owlAnimate = this.animate[Number(key)].animateCss[i];
          this.animate[Number(key)].items.push(element);
        });
      } else {
        if(key.includes('nth-')) {
          let nthKey = key.replace('nth-','');
          if(Number(nthKey)){
            this.owl.items.forEach((item,i)=>{
              if((i+1) % Number(nthKey) === 0){
                this.animate[i] = {};
                this.animate[i].container = this.owl.items[i];
                this.animate[i].container.dataset.owlId = i;
                this.animate[i].animateCss = this.set.animate[key].animateCss || this.set.animate.animateCss || [];
                let items = this.set.animate[key].items || this.set.animate.items || [];
                this.animate[i].items = [];
                items.forEach((selector,itemI) => {
                  let element = item.querySelector(selector);
                  element.classList.add('animated');
                  element.dataset.owlAnimate = this.animate[i].animateCss[itemI];
                  this.animate[i].items.push(element);
                });
              }
            });
          }
        }
      }
    });
  }

  initCarousel(){
    if(this.set.owlSet){
      this.carousel = $(this.owl.container).owlCarousel(this.set.owlSet);
    } else {
      this.carousel = $(this.owl.container).owlCarousel();
    }
  }

  getCarouselItems(){
    this.owlItems = this.owl.container.querySelectorAll(this.set.item);
  }

  initAnimate(){
    this.carousel.on('changed.owl.carousel',(e)=>{
      this.removeAnimationClass();
      setTimeout(this.checkAnimation.bind(this,e),0);
    });
  }

  removeAnimationClass(){
    this.animate.forEach(item=>{
      item.items.forEach(el=>{
        if(el.dataset.owlAnimate && el.classList.contains(el.dataset.owlAnimate)){
          el.classList.remove(el.dataset.owlAnimate);
        }
      })
    })
  }

  checkAnimation(e){
    let index = e.item.index;
    let res = [];

    if(this.set.owlSet){
      if(this.set.owlSet.items){
        for(let i = 0; i < this.set.owlSet.items; i++){
          res.push(this.owlItems[i+index]);
        }
      } else {
        res.push(this.owlItems[index]);
      }
    } else {
      res.push(this.owlItems[index]);
    }
    res.forEach((item,i)=>{
      if(item.dataset.owlId){
        let animateItems = this.animate[Number(item.dataset.owlId)].items;
        animateItems.forEach(item=>{
          if(!item.classList.contains(item.dataset.owlAnimate)){
            item.classList.add(item.dataset.owlAnimate);
          }
        })
      }
    });
  }


}
