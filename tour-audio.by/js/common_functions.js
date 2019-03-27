
// ===========================================================================
//                            COMMON FUNCTIONS
// ===========================================================================

class CommonFunctions{
  constructor(){

  }
  createElement(el,conf){
    let item = document.createElement(el);
    if(conf && conf.constructor === Object){
      for(let key in conf){
        item.setAttribute(key,conf[key]);
      }
    } else if (conf){
      item.className = conf;
    }
    return item;
  }
  appendChild(el,child){
    if(child.contructor === Array){
      child.forEach(item=>el.appendChild(item));
    }
    if(child.constructor === String){
      el.appendChild(child);
    }
  }

  addPreload(el){
    let preload = this.createElement('div','test-preload');
    el.appendChild(preload);
  }

  removePreload(el){
    let preload = el.querySelector('.test-preload');
    if(preload){
      preload.parentNode.removeChild(preload);
    }
  }


  animate(set){
    set.item.classList.add(set.class);
    setTimeout(()=>{
      set.item.parentNode.removeChild(set.item);
    },set.time);
  }

  toggleClass(el,cl){
    if(el.classList.contains(cl)){
      el.classList.remove(cl);
    } else {
      el.classList.add(cl);
    }
  }

  isJSON(str) {
    try {
      JSON.parse(str);
    } catch (e) {
      return false;
    }
    return true;
  }

  createTelephoneNumber(set){
    let num = set.num.replace(/\s/g,'');
    num = num.replace(/[^\w\s]/gi, '');
    switch(set.location){
      case 'ru':
      return this.createRuNum(num);
      break;
    }
  }
  createRuNum(num){
    let pref = num.substring(0,1);
    let code = num.substring(1,4);
    let firstPart = num.substring(4,7);
    let secondPart = num.substring(7,9);
    let thirdPart = num.substring(9,11);
    return '+'+pref+'-'+code+'-'+firstPart+'-'+secondPart+'-'+thirdPart;
  }

}
