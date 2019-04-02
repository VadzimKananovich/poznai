class BackToTop {

  constructor(set) {
    this.initDefaultSet();
    this.initSet(set);
    this.createBtn();
    this.init();
  }

  initDefaultSet(){
    this.set = {
      'style':'blue',
      'title':'Вверх',
      'transition': .3,
      'offset': 300
    }
  }
  initSet(set){
    for(let key in set){
      this.set[key] = set[key];
    }
  }
  createBtn(){
    switch(this.set.style){
      case 'blue': this.createBlueBtn();
      break;
    }
  }

  createBlueBtn(){
    let a = document.createElement('a');
    a.setAttribute('style', 'position: fixed; bottom: 10px; right: 15px; box-shadow: 0 0 3px #000; border-radius: 5px; width: 45px; height: 45px; display: none; font-size: 25px; color: #fff; background-color: #00c2ff; z-index: 1000; overflow: hidden; transition: '+this.set.transition+'s; opacity: 0; transform: translateY(100px);');
    a.classList.add('back-to-top');
    a.href = '#';
    a.title = this.set.title;

    let wrap = document.createElement('span');
    wrap.setAttribute('style','transition: '+this.set.transition+'s; display: block;');

    let firstI = document.createElement('i');
    firstI.className = 'fas fa-arrow-up';
    firstI.setAttribute('style','width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;');

    let secondI = document.createElement('i');
    secondI.className = 'fas fa-arrow-up';
    secondI.setAttribute('style','width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;');

    wrap.appendChild(firstI);
    wrap.appendChild(secondI);
    a.appendChild(wrap);
    this.btn = a;


    this.wrap = wrap;
    this.initBtn();
  }
  initBtn(){
    this.btn.addEventListener('mouseover',()=>{
      this.wrap.style.transform = 'translateY(-45px)';
    });
    this.btn.addEventListener('mouseout',()=>{
      this.wrap.style.transform = 'translateY(0)';
    });
  }

  init(){
    document.body.appendChild(this.btn);
    window.addEventListener('scroll',()=>{
      if(window.scrollY > this.set.offset){
        this.showBtn();
      } else {
        this.hideBtn();
      }
    });
  }

  showBtn(){
    this.btn.style.display = 'block';
    setTimeout(()=>{
      this.btn.style.opacity = '1';
      this.btn.style.transform = 'translateY(0)';
    });
  }

  hideBtn(){
    this.btn.style.opacity = 0;
    this.btn.style.transform = 'translateY(100px)';
    setTimeout(()=>{
      this.btn.style.display = 'none';
    },(this.set.transition * 1000));
  }

  destroy(){
    this.btn.parentNode.removeChild(this.btn);
  }
}
