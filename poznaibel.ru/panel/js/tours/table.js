class Table{
	constructor(type){
		this.type = type;
		this.init();
	}
	init(){
		this.createHeader();
		this.createBody();
	}
	createHeader(){
		let thead = document.createElement('thead');
		let tr = document.createElement('tr');
		thead.appendChild(tr);
		tr.appendChild(this.createTH('#'));
		if(this.type === 'belarus_pref' || this.type === 'foreigners_pref'){
			tr.appendChild(this.createTH('Дата'));
		}
		tr.appendChild(this.createTH('Заголовок'));
		// tr.appendChild(this.createTH('Краткое описание'));
		// tr.appendChild(this.createTH('Стоимость'));
		// tr.appendChild(this.createTH('Валюта'));
		// tr.appendChild(this.createTH('Маршрут'));
		// tr.appendChild(this.createTH('Продолжительность'));
		// tr.appendChild(this.createTH('Программа тура'));
		// tr.appendChild(this.createTH('Основные места'));
		tr.appendChild(this.createTH('Картинки'));
		tr.appendChild(this.createTH('#'));
		tr.appendChild(this.createTH('#'));
		this.head = thead;
	}
	createTH(txt){
		let th = document.createElement('th');
		th.setAttribute('scope','col');
		th.appendChild(document.createTextNode(txt));
		return th;
	}

	createBody(){
		this.body = document.createElement('tbody');
	}

}
