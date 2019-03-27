class Table{
	constructor(path){
		this.path = path ? path : '';
		this.formElements = new FormElements;
		this.buttons = new Buttons;
		this.rows = [];
		this.createTable();
	}
	createTable(){
		this.wrapper = document.createElement('div');
		this.wrapper.className = 'row';
		let col = document.createElement('div');
		col.className = 'col-md-12 pdt-2';
		this.container = document.createElement('table');
		this.container.setAttribute('style','width:100%;');
		col.appendChild(this.container);
		this.wrapper.appendChild(col);
	}

	createHead(set){
		this.head = document.createElement('thead');
		let tr = document.createElement('tr');
		tr.appendChild(this.createTxtCol({'center':true, 'scope':'col','type':'th','text':'#'}));
		if(set.constructor === Array){
			for(let i = 0; i < set.length; i++){
				tr.appendChild(this.createTxtCol({'center':true, 'scope':'col','type':'th','text':set[i]}));
			}
		}
		if(set.constructor === Object){
			for(let key in set){
				tr.appendChild(this.createTxtCol({'center':true, 'scope':'col','type':'th','text':set[key]}));
			}
		}
		tr.appendChild(this.createTxtCol({'center':true, 'scope':'col','type':'th','text':'#'}));
		this.head.appendChild(tr);
		return this.head
	}


	createBody(){
		this.body = document.createElement('tbody');
		return this.body;
	}

	createRow(item,i,set,empty){
		let tr = document.createElement('tr');
		tr.dataset.id = i;
		tr.className = set.type === 'normal' || 'list' ? 'table-row' : 'table-row modal-table';
		tr.appendChild(this.createTxtCol({'scope':'row','type':'th','text': i+1}));
		this.rows.push({});
		if(item.constructor === Object){
			tr.appendChild(this.createObjectCols(item,set,i,empty));
		} else {
			tr.appendChild(this.createStringCols(item,set,i,empty));
		}
		let height = set.rowHeight ? set.rowHeight : 'auto';
		tr.setAttribute('style',`height:${height}; overflow:hidden;`);
		this.rows[this.rows.length-1].tr = tr;
		let setBtns = this.createBtnCol({'buttons': set.rowControl ? set.rowControl : ['upBtn','downBtn','delBtn'],'id':i});
		tr.appendChild(setBtns);
		this.rows[this.rows.length-1]['_setBtns'] = setBtns;
		return tr;
	}

	createObjectCols(item,set,i,empty){
		let wrap = document.createDocumentFragment();
		for(let key in item){
			let col;
			if(set.items[key]){
				let typeCol = this.getTypeCol(set,key);
				switch(typeCol){
					case 'text':
					col = this.createText(set.type,empty ? '' : item[key]);
					wrap.appendChild(col);
					break;
					case 'singleImg':
					col = this.createSingleImg(item,set,empty ? '' : item[key]);
					wrap.appendChild(col);
					break;
					case 'sliderImg':
					col = this.createSliderImg(item.imgPath,empty ? '' : item[key]);
					wrap.appendChild(col);
					break;
					case 'dateMultiRange':
					col = this.createDateMultiRangeCol(empty ? '' : item[key]);
					wrap.appendChild(col);
					break;
					case 'operator':
					col = this.createOperatorCol(empty ? '' : item[key],i);
					wrap.appendChild(col);
					break;
					case 'messenger':
					col = this.createMessengerCol(empty ? '' : item[key],i);
					wrap.appendChild(col);
					break;
					case 'social':
					col = this.createSocialCol(empty ? '' : item[key],i);
					wrap.appendChild(col);
					break;
				}
			}
			this.rows[this.rows.length-1][key] = col;
		}
		return wrap;
	}

	createStringCols(item,set,i,empty){
		let typeCol = this.getTypeCol(set);
		let col = document.createDocumentFragment();
		switch(typeCol){
			case 'text':
			col = this.createText(set.type,empty ? '' : item);
			break;
			case 'singleImg':
			col = this.createSingleImg(item,set,empty ? '' : item);
			break;
			case 'sliderImg':
			col = this.createSliderImg(set.type,empty ? '' : item);
			break;
			case 'dateMultiRange':
			col = this.createDateMultiRangeCol(empty ? '' : item[key]);
			break
		}
		this.rows[this.rows.length-1]['_listItem'] = col;
		return col;
	}

	getTypeCol(set,key){
		if(set.hasOwnProperty('text') && key ? set.text.includes(key) : set.text){
			return 'text';
		}
		if(set.hasOwnProperty('singleImg') && key ? set.singleImg.includes(key) : set.singleImg){
			return 'singleImg';
		}
		if(set.hasOwnProperty('sliderImg') && key ? set.sliderImg.includes(key) : set.sliderImg){
			return 'sliderImg';
		}
		if(set.hasOwnProperty('dateMultiRange') && key ? set.dateMultiRange.includes(key) : set.dateMultiRange){
			return 'dateMultiRange';
		}
		if(set.hasOwnProperty('messenger') && key ? set.messenger.includes(key) : set.messenger){
			return 'messenger';
		}
		if(set.hasOwnProperty('operator') && key ? set.operator.includes(key) : set.operator){
			return 'operator';
		}
		if(set.hasOwnProperty('messenger') && key ? set.messenger.includes(key) : set.messenger){
			return 'messenger';
		}
		if(set.hasOwnProperty('social') && key ? set.social.includes(key) : set.social){
			return 'social';
		}
	}





	// ===========================================================================
	//                                 CREATE COL
	// ===========================================================================


	createText(type,item){
		let editable = type === 'normal' || 'list' ? true : false;
		let editArray = type === 'normal' || 'list' ? true : false;
		return this.createTxtCol({
			'type':'td',
			'text': item,
			'editable':editable,
			'editArray':editArray
		});
	}
	createSingleImg(item,set,imgName){
		let path = '../'+this.path+this.createFormatPath(item[set['imgPath']])+imgName.replace('/','');
		return this.createSingleImgCol({
			'src': path,
			'width':'300',
			'height':'230',
			'center':true
		});
	}
	createSliderImg(path,item){
		path = this.createFormatPath(path);
		let col = document.createElement('td');
		col.width = '300px';
		let sliderWrap = document.createElement('div');
		sliderWrap.className = 'table-slider';
		let slider = document.createElement('div');
		slider.className = 'owl-carousel owl-theme';
		slider.setAttribute('style','width:300px; overflow:hidden;');
		let openSlider = document.createElement('div');
		openSlider.className = 'open-img img-modal-open';
		sliderWrap.appendChild(openSlider);
		if(item){
			item.forEach((item,i,arr)=>{
				let imgWrap = document.createElement('div');
				imgWrap.className = 'item';
				let img = new Image();
				img.src = '../'+this.path+path+item;
				imgWrap.appendChild(img);
				slider.appendChild(imgWrap);
			});
		}
		sliderWrap.appendChild(slider);
		col.appendChild(sliderWrap);
		this.initSlider(slider);
		return col;
	}
	initSlider(slider){
		$(slider).owlCarousel({
			nav: false,
			slideSpeed : 300,
			paginationSpeed : 400,
			items:1,
			autoplay:true
		});
	}
	createDateMultiRangeCol(value){
		let td = document.createElement('td');
		let p = document.createElement('p');
		p.className = 'date-range-col';
		let input = document.createElement('textarea');
		input.setAttribute('style','min-width:300px; min-height: 100px;');
		input.value = value;
		p.appendChild(input);
		td.appendChild(p);
		return td;
	}
	createOperatorCol(value){
		let td = document.createElement('td');
		let div = document.createElement('div');
		div.className = 'operator-col form-group';
		let select = this.formElements.createSelect([
			{'value':'Velcom','id':'velcom'},
			{'value':'Mts','id':'mts'},
			{'value':'Life','id':'life'},
			{'value':'Городской','id':'urban'},
			{'value':'Email (для skype)','id':'email'},
			{'value':'Имя в skype','id':'skypeName'}
		]);
		select.value = value;
		div.appendChild(select);
		td.appendChild(div);
		return td;
	}
	createMessengerCol(value,i){
		let td = document.createElement('td');
		let div = document.createElement('div');
		div.className = 'messenger-col form-group';
		div.appendChild(this.formElements.createCheckBox([
			{'label':'WhatsApp','value':'whatsapp','id':'whatsapp'+i,'checked': value.indexOf('whatsapp') > -1 ? true : false},
			{'label':'Viber','value':'viber','id':'viber'+i,'checked': value.indexOf('viber') > -1 ? true : false},
			{'label':'Skype','value':'skype','id':'skype'+i,'checked': value.indexOf('skype') > -1 ? true : false}
		]));
		td.appendChild(div);
		return td;
	}
	createSocialCol(value,i){
		let td = document.createElement('td');
		let div = document.createElement('div');
		div.className = 'social-col form-group';
		let select = this.formElements.createSelect([
			{'value':'ВКонтакте','id':'vk'},
			{'value':'Instagram','id':'in'},
			{'value':'Одноклассники','id':'ok'},
			{'value':'Facebook','id':'fb'},
			{'value':'Youtube','id':'yt'},
		]);
		select.value = value;
		div.appendChild(select);
		td.appendChild(div);
		return td;
	}

	createTxtCol(set){
		let col = document.createElement(set.type);
		let p = document.createElement('p');
		p.className = 'col-txt-content';
		if(set.hasOwnProperty('center') && set.center){
			p.classList.add('text-center');
		}
		if(set.hasOwnProperty('scope')){
			col.scope = set.scope;
		}
		if(set.hasOwnProperty('editable') && set.editable){
			p.setAttribute('contenteditable','true');
			p.classList.add('editable-txt');
		}
		p.innerHTML = set.text;
		col.appendChild(p);
		return col;
	}
	createBtnCol(set){
		let td = document.createElement('td');
		td.width = '100px';
		let btnGroup = this.buttons.btnGroup(set.buttons);
		td.appendChild(btnGroup);
		return td;
	}
	createSingleImgCol(set){
		let col = document.createElement('td');
		col.width = '300px';
		let wrap = document.createElement('div');
		wrap.className = 'single-img-col';
		let openModal = document.createElement('div');
		openModal.className = 'img-modal-open';
		wrap.appendChild(openModal);
		if(set.src){
			let img = new Image();
			if(set.src){
				img.src = set.src;
			}
			img.style.maxWidth = set.hasOwnProperty('width') ? set.width+'px' : 'auto';
			img.style.maxHeight = set.hasOwnProperty('height') ? set.height+'px' : 'auto';
			img.style.marginBottom = '15px';
			wrap.appendChild(img);
		}
		col.appendChild(wrap);
		return col;
	}





	createFormatPath(path){
		if(path){
			let clearePath = path.replace(/\s/g,'');
			let splitPath = clearePath.split('/');
			let filterPath = splitPath.filter((item)=>item);
			let joinPath = filterPath.join('/')+'/';
			return joinPath;
		} else {
			return path;
		}
	}

}
