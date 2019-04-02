class Counter {

  constructor(set){
    this.initDefaultSet();
    this.initPassedSet(set);
    this.getItems();
    this.createCounter();
    this.init();
  }

  initDefaultSet(){
    this.set = {
      'item':'.counter',
      'delay': 500,
      'time': 0,
      'max': false,
      'min': false,
      'step':1
    };
  }

  initPassedSet(set){
    for(let key in set){
      this.set[key] = set[key];
    }
  }

  getItems(){
    this.items = document.querySelectorAll(this.set.item);
  }

  createCounter(){
    this.counter = [];
    this.items.forEach(item=>{
      this.counter.push({
        'el': item,
        'offset': (item.getBoundingClientRect().y + window.scrollY - window.innerHeight),
        'max': this.set.max || Number(item.textContent) || 0,
        'curr': this.set.min || 0,
        'animate': false,
        'delay': Number(item.dataset.counterDelay) || this.set.delay,
        'time': Number(item.dataset.counterTime) || this.set.time,
        'step': Number(item.dataset.counterStep) || this.set.step
      });
      item.innerHTML = '';
    });
  }


  init(){

    window.addEventListener('scroll',()=>{
      this.counter.forEach(count=>{
        if(window.scrollY >= count.offset && !count.animate){
          this.animateCount(count);
        }
        if(window.scrollY < count.offset){
          count.curr = 0;
          count.el.innerHTML = this.set.min || 0;
          count.animate = false;
        }
      });
    });
  }

  animateCount(count){
    count.animate = true;
    count.timeOutFunction = setTimeout(()=>{
      count.intervalFunction = setInterval(()=>{
        if(count.curr < count.max){
          count.curr += count.step;
          count.el.innerHTML = count.curr;
        } else {
          clearInterval(count.intervalFunction);
        }
      },count.time);
    },count.delay);
  }
}
