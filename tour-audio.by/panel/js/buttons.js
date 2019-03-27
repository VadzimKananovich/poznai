"use strict"

class Buttons{
  constructor(){

  }

  btnGroup(set){
    let wrap = document.createElement('div');
    wrap.className = 'btn-group';
    if(set && set.constructor === Array){
      set.forEach(item => {
        if(item.constructor === Object){
          let set = item.set ? item.set : {};
          if(item.button && this[item.button]) wrap.appendChild(this[item.button](item));
        } else {
          if(this[item]) wrap.appendChild(this[item]());
        }
      });
    }
    return wrap;
  }

  confirmBtn(set={}){
    let setClass = set.class ? ' ' + set.class : '';
    let setText = set.text ? '<span>'+set.text+'</span>' : '';
    return this.createButton({
      'type': set.type ? set.type : 'button',
      'id': set.id ? set.id : false,
      'title': set.title ? set.title : 'подтвердить',
      'class' : 'confirm-btn' + setClass,
      'dataset': set.dataset ? set.dataset : false,
      'text': '<i class="fas fa-check"></i>' + setText,
      'onclick': set.onclick ? set.onclick : false
    });
  }
  delBtn(set={}){
    let setClass = set.class ? ' ' + set.class : '';
    let setText = set.text ? '<span>'+set.text+'</span>' : '';
    return this.createButton({
      'type': set.type ? set.type : 'button',
      'id': set.id ? set.id : false,
      'title': set.title ? set.title : 'удалить',
      'class' : 'del-btn' + setClass,
      'dataset': set.dataset ? set.dataset : false,
      'text': '<i class="fas fa-trash-alt"></i>' + setText,
      'onclick': set.onclick ? set.onclick : false
    });
  }
  changeBtn(set={}){
    let setClass = set.class ? ' ' + set.class : '';
    let setText = set.text ? '<span>'+set.text+'</span>' : '';
    return this.createButton({
      'type': set.type ? set.type : 'button',
      'id': set.id ? set.id : false,
      'title': set.title ? set.title : 'заменить',
      'class' : 'change-btn' + setClass,
      'dataset': set.dataset ? set.dataset : false,
      'text': '<i class="fas fa-retweet"></i>' + setText,
      'onclick': set.onclick ? set.onclick : false
    });
  }
  uploadBtn(set={}){
    let setClass = set.class ? ' ' + set.class : '';
    let setText = set.text ? '<span>'+set.text+'</span>' : '';
    return this.createButton({
      'type': set.type ? set.type : 'button',
      'id': set.id ? set.id : false,
      'title': set.title ? set.title : 'загрузить',
      'class' : 'upload-btn' + setClass,
      'dataset': set.dataset ? set.dataset : false,
      'text': '<i class="fas fa-cloud-upload-alt"></i>' + setText,
      'onclick': set.onclick ? set.onclick : false
    });
  }
  cancelBtn(set={}){
    let setClass = set.class ? ' ' + set.class : '';
    let setText = set.text ? '<span>'+set.text+'</span>' : '';
    return this.createButton({
      'type': set.type ? set.type : 'button',
      'id': set.id ? set.id : false,
      'title': set.title ? set.title : 'отменить',
      'class' : 'cancel-btn' + setClass,
      'dataset': set.dataset ? set.dataset : false,
      'text': '<i class="fas fa-ban"></i>' + setText,
      'onclick': set.onclick ? set.onclick : false
    });
  }
  closeBtn(set={}){
    let setClass = set.class ? ' ' + set.class : '';
    let setText = set.text ? '<span>'+set.text+'</span>' : '';
    return this.createButton({
      'type': set.type ? set.type : 'button',
      'id': set.id ? set.id : false,
      'title': set.title ? set.title : 'закрыть',
      'class' : 'close-btn' + setClass,
      'dataset': set.dataset ? set.dataset : false,
      'text': '<i class="fas fa-times"></i>' + setText,
      'onclick': set.onclick ? set.onclick : false
    });
  }
  upBtn(set={}){
    let setClass = set.class ? ' ' + set.class : '';
    let setText = set.text ? '<span>'+set.text+'</span>' : '';
    return this.createButton({
      'type': set.type ? set.type : 'button',
      'id': set.id ? set.id : false,
      'title': set.title ? set.title : 'поднять',
      'class' : 'up-btn' + setClass,
      'dataset': set.dataset ? set.dataset : false,
      'text': '<i class="fas fa-sort-up"></i>' + setText,
      'onclick': set.onclick ? set.onclick : false
    });
  }
  downBtn(set={}){
    let setClass = set.class ? ' ' + set.class : '';
    let setText = set.text ? '<span>'+set.text+'</span>' : '';
    return this.createButton({
      'type': set.type ? set.type : 'button',
      'id': set.id ? set.id : false,
      'title': set.title ? set.title : 'опустить',
      'class' : 'down-btn' + setClass,
      'dataset': set.dataset ? set.dataset : false,
      'text': '<i class="fas fa-sort-down"></i>' + setText,
      'onclick': set.onclick ? set.onclick : false
    });
  }
  saveBtn(set={}){
    let setClass = set.class ? ' ' + set.class : '';
    let setText = set.text ? '<span>'+set.text+'</span>' : '';
    return this.createButton({
      'type': set.type ? set.type : 'button',
      'id': set.id ? set.id : false,
      'title': set.title ? set.title : 'сохранить',
      'class' : 'save-btn' + setClass,
      'dataset': set.dataset ? set.dataset : false,
      'text': '<i class="fas fa-save"></i>' + setText,
      'onclick': set.onclick ? set.onclick : false
    });
  }
  addBtn(set={}){
    let setClass = set.class ? ' ' + set.class : '';
    let setText = set.text ? '<span>'+set.text+'</span>' : '';
    return this.createButton({
      'type': set.type ? set.type : 'button',
      'id': set.id ? set.id : false,
      'title': set.title ? set.title : 'добавить',
      'class' : 'add-btn' + setClass,
      'dataset': set.dataset ? set.dataset : false,
      'text': '<i class="fas fa-plus"></i>' + setText,
      'onclick': set.onclick ? set.onclick : false
    });
  }
  submitBtn(set={}){
    let setClass = set.class ? ' ' + set.class : '';
    let setText = set.text ? '<span>'+set.text+'</span>' : '';
    return this.createButton({
      'type': set.type ? set.type : 'button',
      'id': set.id ? set.id : false,
      'title': set.title ? set.title : 'отправить',
      'class' : 'submit-btn' + setClass,
      'dataset': set.dataset ? set.dataset : false,
      'text': '<i class="fas fa-share-square"></i>' + setText,
      'onclick': set.onclick ? set.onclick : false
    });
  }

  createButton(set={}){
    let btn = document.createElement('button');
    btn.type = set.type ? set.type : 'button';
    if(set.id) btn.id = set.id;
    if(set.title) btn.title = set.title;
    btn.type = set.type ? set.type : 'button';
    if(set.dataset){
      for(let key in set.dataset){
        btn.dataset[key] = set.dataset[key];
      }
    }
    if(set.text) btn.innerHTML = set.text;
    if(set.class) btn.className = set.class;
    btn.classList.add('btn');
    if(set.onclick) btn.onclick = set.onclick;
    return btn
  }
}
