class ApplyAos{
  constructor(set){
    this.initDefaultSet();
    this.initSet(set);
    this.getElements();
    this.init();
  }
  initDefaultSet(){
    this.set = {
      //   'items':[
      //     '.section-title',
      //     '.sub-title',
      //     '.about-product .section-img',
      //     '.about-product .section-content',
      //     '.about-product .reverse .img',
      //     '.about-product .reverse .section-content'
      //   ],
      //   'animate':[
      //     'fade-down',
      //     'fade-up',
      //     'fade-right',
      //     'fade-left',
      //     'fade-left',
      //     'fade-right'
      //   ],
      //   'set':[
      //     {
      //       'delay':1000
      //     }
      //   ],
      //   'globalSet':{
      //     'duration': 1000
      //   }
    }
  }

  initSet(set){
    for(let key in set){
      this.set[key] = set[key];
    }
  }

  getElements(){
    this.aosEl = [];
    if(this.set.items){
      this.set.items.forEach((selector,i)=>{
        let items= document.querySelectorAll(selector);
        items.forEach(item=>this.applyAttributes(item,i));
        this.aosEl.push(items);
      });
    }
  }

  applyAttributes(item,i){
    if(this.set.animate){
      if(this.set.animate[i]){
        item.dataset.aos = this.set.animate[i];
      }
    }
    if(this.set.set){
      if(this.set.set[i]){
        let currSet = this.set.set[i];
        for(let key in currSet){
          switch(key){
            case 'duration': item.dataset.aosDuration = currSet[key];
            break;
            case 'easing': item.dataset.aosEasing = currSet[key];
            break;
            case 'offset': item.dataset.aosOffset = currSet[key];
            break;
            case 'anchor': item.dataset.aosAnchor = currSet[key];
            break;
            case 'delay': item.dataset.aosDelay = currSet[key];
            break;
            case 'anchorPlacement': item.dataset.aosAnchorPlacement = currSet[key];
            break;
          }
        }
      }
    }
  }

  init(){
    window.addEventListener('load',()=>{
      if(this.set.globalSet){
        AOS.init(this.set.globalSet);
      } else {
        AOS.init();
      }
    });
  }
}
