class Admin extends CommonFunctions {
	constructor(set){
		super();
		this.buttons = new Buttons;
		this.getSet(set);
	}

	getSet(set){
		if(set.constructor === Object){
			this.initAdmin(set);
		} else {
			this.sendRequest({
				'method':'GET',
				'url':set[0]+'?action=get_json&path='+encodeURIComponent(set[1])
			}).then(((res)=>{
				this.initAdmin(JSON.parse(res));
			}).bind(this));
		}
	}

	initAdmin(set){
		this.set = set;
		this.path = this.set.curr_path ? this.set.curr_path : '';
		this.wrapper = document.querySelector(set.container);
		this.init();
	}

	init(){
		this.container = document.createElement('div');
		this.container.className = 'admin-container';
		this.wrapper.appendChild(this.container);
		let initialize = this.set.initialize;
		if(this.set.writeSet){
			let path = this.set.writeSet;
			delete this.set.writeSet;
			if(this.set.initialize){
				delete this.set.initialize;
			}
			this.writeJsonRequest(this.saveAlert.bind(this),path,this.set);
		}
		if(initialize){
			this.sendRequest({
				'method':'POST',
				'url':this.set.request_file+'?action=write_json&path='+encodeURIComponent(this.set.json),
				'dates':'file='+JSON.stringify(initialize)
			}).then(this.getObject.bind(this));
		} else {
			this.getObject();
		}
	}
	getObject(fun){
		this.addLoader();
		this.sendRequest({
			'method':'GET',
			'url':this.set.request_file+'?action=get_json&path='+encodeURIComponent(this.set.json)
		}).then(((res)=>{
			this.writeDates(res,fun);
			// if(fun) fun();
		}).bind(this));
	}

	writeDates(obj,fun = false){
		let scroll = window.scrollY;
		this.container.innerHTML = '';
		if(obj !== 'rewrite'){
			this.json = JSON.parse(obj);
		}
		if(this.set.jsonTitle){
			this.container.appendChild(this.createJsonTitle());
		};
		if(this.set.hasOwnProperty('items')){
			this.objectsElWrap = document.createElement('div');
			this.objectsElWrap.className = 'object-el-wrap';
			this.insertObjectItems(this.set.items);
			this.container.appendChild(this.objectsElWrap);
			this.objectsElWrap.appendChild(this.createAddRecord());
		}
		this.insertTables();
		this.buttons.saveBtn();
		setTimeout((()=>{
			window.scrollTo(0,scroll);
			// if(fun) fun();
			this.toggleLoader();
		}).bind(this),0);
	}

	createJsonTitle(){
		let h3 = document.createElement('h3');
		h3.innerHTML = this.set.jsonTitle;
		h3.className = 'admin-json-title';
		return h3;
	}
	insertTables(){
		this.tables = {};
		if(this.set.hasOwnProperty('table')){
			if(this.set.table.constructor === Array){
				this.set.table.forEach(item=>{
					this.tables[item] = new TableSet({
						'set':this.set,
						'tableSet':this.set[item],
						'json':this.json,
						'container':this.container,
						'writeDates':this.writeDates.bind(this),
						'getObject':this.getObject.bind(this)
					});
				});
			} else {
				this.tables[this.set.table.array] = new TableSet({
					'set':this.set,
					'tableSet':this.set.table,
					'json':this.json,
					'container':this.container,
					'writeDates':this.writeDates.bind(this),
					'getObject':this.getObject.bind(this)
				});
			}
		}
	}

	insertObjectItems(set){
		for(let key in set){
			if(key === 'text'){
				for(let txtKey in set[key]){
					if(this.json.hasOwnProperty(txtKey)) this.objectsElWrap.appendChild(this.createObjectText(txtKey,set[key][txtKey]));
				}
			} else {
				if(this.json.hasOwnProperty(set[key])){
					if(key === 'title') this.objectsElWrap.appendChild(this.createObjectTitle(set[key]));
					if(key === 'sub_title') this.objectsElWrap.appendChild(this.createObjectSubTitle(set[key]));
				}
			}
		}
	}
	createAddRecord(){
		let wrap = document.createElement('div');
		wrap.className = 'add-admin-row';
		let wrapBtn = document.createElement('btn');
		wrapBtn.className = 'admin-btn-wrap';

		if(this.set.developer){
			let addRow = this.createAddRecordRow();
			let addBtn = this.buttons.addBtn();
			wrapBtn.appendChild(addBtn);
			wrap.appendChild(addRow);
			this.initAddRecordBtn(addBtn,addRow);
		}

		let saveBtn = this.buttons.saveBtn();
		wrapBtn.appendChild(saveBtn);
		wrap.appendChild(wrapBtn);
		this.initSaveObjectBtn(saveBtn);
		return wrap;
	}

	initSaveObjectBtn(btn){
		btn.addEventListener('click',(e)=>{
			this.writeJsonRequest(this.saveAlert.bind(this));
		});
	}

	initAddRecordBtn(btn,row){
		let keyInput = row.querySelector('#addRowKey');
		let valueInput = row.querySelector('#addRowValue');
		btn.addEventListener('click',((e)=>{
			if(!this.json.hasOwnProperty(keyInput.value)){
				this.addLoader();
				this.json[keyInput.value]=valueInput.value;
				this.sendRequest({
					'method':'POST',
					'url':this.set.request_file+'?action=write_json&path='+encodeURIComponent(this.set.json),
					'dates':'file='+JSON.stringify(this.json)
				}).then((()=>{
					this.toggleLoader();
				}).bind(this));
			} else {
				console.log('this key just exist');
			}
		}).bind(this,keyInput,valueInput));
	}
	createAddRecordRow(){
		let wrap = document.createElement('div');
		wrap.className = 'input-elements';
		wrap.appendChild(this.formElements.createFormGroup({
			'type':'text',
			'small-text':'',
			'id':'addRowKey',
			'placeholder':'Ключ в объекте',
			'required':'true'
		}));
		wrap.appendChild(this.formElements.createFormGroup({
			'type':'text',
			'small-text':'',
			'id':'addRowValue',
			'placeholder':'Первое значение',
			'required':'true'
		}));
		return wrap;
	}
	createObjectText(key,value){
		let wrap = document.createElement('div');
		wrap.className = 'admin-txt-row';
		let pValue = document.createElement('p');
		pValue.className = 'admin-txt-value';
		pValue.innerHTML = value;
		wrap.appendChild(pValue);
		let p = document.createElement('p');
		p.className = 'txt-content mrb-3 editable-txt';
		p.innerHTML = this.json[key];
		let btn = this.buttons.delBtn();
		this.initDelRecordObject(btn,key);
		// p.appendChild(btn);
		wrap.appendChild(p);
		wrap.appendChild(btn);
		this.initEditObject(p,key);
		return wrap;
	}
	initDelRecordObject(delBtn,key){
		let modal = this.modal.confirmDel();
		let modalBtn = modal.querySelector('.confirm-btn');
		modalBtn.addEventListener('click',((e)=>{
			if(this.json.hasOwnProperty(key)){
				this.addLoader();
				delete this.json[key];
				this.writeJsonRequest();
			}
		}).bind(this,key));
		delBtn.addEventListener('click',()=>$(modal).modal());
	}

	createObjectTitle(key){
		let p = document.createElement('p');
		p.className = 'section-title mrb-3 mrt-1 editable-txt';
		p.innerHTML = this.json[key];
		this.initEditObject(p,key);
		return p;
	}
	createObjectSubTitle(key){
		let p = document.createElement('p');
		p.className = 'section-sub-title mrb-3 editable-txt';
		p.innerHTML = this.json[key];
		this.initEditObject(p,key);
		return p;
	}
	initEditObject(item,key){
		item.setAttribute('contenteditable','true');
		item.addEventListener('keydown',(e)=>{
			setTimeout(()=>{
				this.json[key] = this.cleareText(item.outerHTML,'paragraf');
			},0);
		});
	}

}
