class PriceRooms{
  constructor(selector){
    this.getElements(selector);
  }
  getElements(selector){
    this.container = document.querySelector(selector);
    this.table = this.container.querySelector('.rooms-price-table');
    this.dayBtn9 = this.container.querySelector('#dayBtn9');
    this.dayBtn8 = this.container.querySelector('#dayBtn8');
    this.dropDown9 = this.container.querySelector('#dropDown9');
    this.dropDown8 = this.container.querySelector('#dropDown8');
    this.getDollar();
    this.getRooms();
    this.getMenu();
    this.insertFirstDate();
  }
  getDollar (){
    let wrap = this.container.querySelector('#dolarContainer');
    this.dolar = Number(wrap.dataset.dolar);
  }
  getRooms(){
    this.room9days = this.container.querySelectorAll('.room9day');
    this.room8days = this.container.querySelectorAll('.room8day');
  }
  getMenu(){
    this.day9Items = this.dropDown9.querySelectorAll('.dropdown-item');
    this.day8Items = this.dropDown8.querySelectorAll('.dropdown-item');
    this.initChangeItem();
  }
  initChangeItem(){
    for(let i = 0; i < this.day9Items.length; i++){
      this.day9Items[i].addEventListener('click',this.changePrice.bind(this,'room9',this.day9Items[i]));
      this.day9Items[i].addEventListener('mouseover',((e)=>{
        this.checkEvent(this.day9Items[i]);
        // this.changePrice('room9',this.day9Items[i]);
      }).bind(this));
    }
    for(let i = 0; i < this.day8Items.length; i++){
      this.day8Items[i].addEventListener('click',this.changePrice.bind(this,'room8',this.day8Items[i]));
      this.day8Items[i].addEventListener('mouseover',((e)=>{
        this.checkEvent(this.day8Items[i]);
        // this.changePrice('room8',this.day8Items[i]);
      }).bind(this));
    }
  }

  changePrice(type,item){
    let room1 = Number(item.dataset['1room']);
    let lux2 = Number(item.dataset['2lux']);
    let room2 = Number(item.dataset['2room']);
    let econom3 = Number(item.dataset['3econom']);
    let family4 = Number(item.dataset['4family']);
    let econom23 = Number(item.dataset['23econom']);
    this.changePriceTable(type,room1,lux2,room2,econom3,family4,econom23);
    this.changeBtn(type,item.textContent);
  }
  changePriceTable(type,room1,lux2,room2,econom3,family4,econom23){
    let container = type === 'room9' ? this.room9days : this.room8days;
    for(let i = 0; i < container.length; i++){
      if(container[i].classList.contains('room1')) container[i].innerHTML = room1;  // this.around_price(room1 / this.dolar,type);
      if(container[i].classList.contains('lux2')) container[i].innerHTML = lux2; // this.around_price(lux2 / this.dolar,type);
      if(container[i].classList.contains('room2')) container[i].innerHTML = room2; // this.around_price(room2 / this.dolar,type);
      if(container[i].classList.contains('econom3')) container[i].innerHTML = econom3; // this.around_price(econom3 / this.dolar,type);
      if(container[i].classList.contains('family4')) container[i].innerHTML = family4; // this.around_price(family4 / this.dolar,type);
      if(container[i].classList.contains('econom23')) container[i].innerHTML = econom23; // this.around_price(econom23 / this.dolar,type);
    }
  }
  around_price(n,type){
    // return type === 'room8' ? Math.round(n) :  Math.round(n) +5;
  }
  changeBtn(type,txt){
    let btn = type === 'room9' ? this.dayBtn9 : this.dayBtn8;
    btn.innerHTML = txt;
  }
  checkEvent(item){
    if(item.dataset.offer){
      $(item).popover({
        'animation':true,
        'content':item.dataset.offer,
        'title':'Специальное предложение!',
        'trigger':'hover'
      });
    }
  }
  insertFirstDate(){
    this.dayBtn9.innerHTML = this.day9Items[0].textContent;
    this.dayBtn8.innerHTML = this.day8Items[0].textContent;
    this.changePrice('room9',this.day9Items[0]);
    this.changePrice('room8',this.day8Items[0]);
  }
}
