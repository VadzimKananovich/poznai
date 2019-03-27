class FormElements{
	constructor(){

	}

	// ===========================================================================
	//                                 CREATE FORM ELEMENTS
	// ===========================================================================
	createFormGroup(set){
		let group = document.createElement('div');
		group.className = 'form-group';
		if(set.hasOwnProperty('label')){
			let label = document.createElement('label');
			label.appendChild(document.createTextNode(set.label));
			group.appendChild(label);
		}
		let input;
		if(!set.hasOwnProperty('textarea')){
			input = document.createElement('input');
		} else {
			input = document.__createTextarea(set.textarea);
		}
		input.type = set.type;
		input.name = set.id;
		input.id = set.id;
		if(set.hasOwnProperty('placeholder')){
			input.placeholder = set.placeholder;
		}
		if(set.hasOwnProperty('required') && set.required){
			input.required = 'true';
		}
		if(set.hasOwnProperty('value')){
			input.value = set.value;
		}
		group.appendChild(input);
		if(set.hasOwnProperty('small-text')){
			let small = document.createElement('small');
			small.className = 'form-text text-muted';
			small.appendChild(document.createTextNode(set['small-text']));
			group.appendChild(small);
		}
		return group;
	}
	__createTextarea(set){

	}



	// ===========================================================================
	//                                 CREATE SELECT
	// ===========================================================================
	createSelect(set){
		let row = document.createElement('div');
		row.className = 'row';
		let selectCol = document.createElement('div');
		selectCol.className = 'col-md-9';
		let btnCol = document.createElement('div');
		btnCol.className = 'col-md-3 option-btn-wrap';
		let select = document.createElement('select');
		select.className = 'form-control mrt-1 mrb-1';
		select.id = set.menuId;
		set.items.forEach(item => select.appendChild(this.createOption(item)));
		if(set.hasOwnProperty('callBack')){
			select.addEventListener('change',set.callBack);
		}
		selectCol.appendChild(select);
		let addBtn = this.createBtn({
			'text':'<i class="fas fa-plus-circle"></i>',
			'title':'Добавить раздел',
			'class':'btn btn-success',
			'dataset':{'event':select.value},
			'onclick': this.dispatchCustomEvent.bind(this,{'name':'editOption','target':select,'detail':{
				'action':'add'
			}})
		});
		let renBtn = this.createBtn({
			'text':'<i class="fas fa-file-signature"></i>',
			'title':'Переименовать раздел',
			'class':'btn btn-success',
			'dataset':{'event':select.value},
			'onclick': this.dispatchCustomEvent.bind(this,{'name':'editOption','target':select,'detail':{
				'action':'rename'
			}})
		});
		let delBtn = this.createBtn({
			'text':'<i class="fas fa-trash-alt"></i>',
			'title':'Удалить раздел',
			'class':'btn btn-danger',
			'dataset':{'event':select.value},
			'onclick': this.dispatchCustomEvent.bind(this,{'name':'editOption','target':select,'detail':{
				'action':'delete'
			}})
		});
		if(window.localStorage.getItem(set.menuId)){
			select.value = window.localStorage.getItem(set.menuId);
		} else {
			window.localStorage.setItem(set.menuId,select.value);
		}
		select.addEventListener('change',()=>{
			addBtn.dataset.event = select.value;
			renBtn.dataset.event = select.value;
			delBtn.dataset.event = select.value;
			window.localStorage.setItem(set.menuId,select.value);
		});
		btnCol.appendChild(addBtn);
		btnCol.appendChild(renBtn);
		btnCol.appendChild(delBtn);
		row.appendChild(selectCol);
		row.appendChild(btnCol);
		return row;
	}

	createOption(set){
		let option = document.createElement('option');
		if(set.hasOwnProperty('value')){
			option.value = set.value;
		} else if(set.hasOwnProperty('menuKey')){
			option.value = set.menuKey;
		}
		if(set.hasOwnProperty('dataset')){
			for(let key in set.dataset){
				option.dataset[key] = set.dataset[key];
			}
		}
		if(set.hasOwnProperty('menuKey')){
			option.innerHTML = set.menuKey;
		}
		return option;
	}

	dispatchCustomEvent(set,e){
		set.detail.value = e.currentTarget.dataset.event;
		let ev = new CustomEvent(set.name,{detail:set.detail,bubbles:true});
		set.target.dispatchEvent(ev);
	}


	// ===========================================================================
	//                                 CREATE BUTTONS
	// ===========================================================================
	createBtn(set){
		let btn = document.createElement('button');
		btn.type = set.type;
		btn.innerHTML = set.text;
		if(set.hasOwnProperty('class')){
			btn.className = set.class;
		}
		if(set.hasOwnProperty('title')){
			btn.title = set.title;
		}
		if(set.hasOwnProperty('width')){
			btn.style.width = set.width;
		}
		if(set.hasOwnProperty('dataset')){
			for(let key in set.dataset){
				btn.dataset[key] = set.dataset[key];
			}
		}
		if(set.hasOwnProperty('onclick')){
			btn.addEventListener('click',(e)=>{
				set.onclick(e);
			});
		}
		return btn;
	}
	createSelect(set){
		let select = document.createElement('select');
		select.className = 'form-control';
		set.forEach(item=>{
			select.appendChild(this.createOption({
				'value':item.id,
				'menuKey':item.value
			}));
		});
		return select;
	}
	createCheckBox(set){
		let wrap = document.createDocumentFragment();
		set.forEach(item=>{
			let row = document.createElement('div');
			row.className = 'form-check form-check-inline';
			let input = document.createElement('input');
			input.className = 'form-check-input';
			input.type = 'checkbox';
			input.id = item.id;
			input.value = item.value;
			if(item.checked){
				input.setAttribute('checked','true');
			}
			let label = document.createElement('label');
			label.className = 'form-check-label';
			label.setAttribute('for',item.id);
			label.appendChild(document.createTextNode(item.label));
			row.appendChild(input);
			row.appendChild(label);
			wrap.appendChild(row);
		});
		return wrap;
	}
}
