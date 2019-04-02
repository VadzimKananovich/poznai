class TableSet extends CommonFunctions {
	constructor(conf){
		super();
		this.getConf(conf);
		this.table = new Table(this.path);
		this.buttons = new Buttons;
		this.init();
	}

	getConf(conf){
		this.set = conf.set;
		this.tableSet = conf.tableSet;
		this.path = this.set.curr_path ? this.set.curr_path : '';
		this.container = conf.container;
		this.json = conf.json;
		this.jsonTable = this.json[this.tableSet.array];
		this.writeDates = conf.writeDates;
		this.getObject = conf.getObject;
	}

	init(){
		this.insertTable();
		this.createFooter();
		this.initSetButtons();
	}

	insertTable(){
		this.table.container.appendChild(this.table.createHead(this.tableSet.items));
		this.table.container.appendChild(this.table.createBody());
		this.insertRows();
	}

	insertRows(empty){
		if(!empty){
			this.jsonTable.forEach((item,i) => {
				if(item.constructor === Object){
					let sorted = {};
					Object.keys(this.tableSet.items).forEach(key=>{
						sorted[key] = item[key];
					});
					for(let key in item){
						if(!sorted.hasOwnProperty(key)){
							sorted[key] = item[key];
						}
					}
					item = sorted;
				}
				this.table.body.appendChild(this.table.createRow(item,i,this.tableSet))
			});
			this.container.appendChild(this.table.container);
			this.initEditableContent(this.tableSet);
		} else {
			this.table.body.appendChild(this.table.createRow(
				this.jsonTable[0],
				this.table.rows.length,
				this.tableSet,
				true));
				this.initEditableContent(this.tableSet);
			}
			if(!empty && this.tableSet.tableTitle){
				this.table.head.insertBefore(this.createTableTitle(),this.table.head.lastChild);
			}
			this.table.container.insertBefore(this.createFooter(),this.table.body);
		}


		createTableTitle(){
			let tr = document.createElement('tr');
			let th = document.createElement('th');
			// let allCols = this.table.rows[0].tr.childElementCount;
			let allCols = this.table.head.lastChild.childElementCount;
			th.setAttribute('colspan',allCols);
			let div = document.createElement('div');
			div.className = 'table-title';
			div.innerHTML = this.tableSet.tableTitle;
			th.appendChild(div);
			tr.appendChild(th);
			return tr;
		}
		insertEmptyRecord(){
			switch(this.tableSet.type){
				case 'normal': this.insertNormalEmptyRecord();
				break;
				case 'list': this.insertListEmptyRecord();
				break;
			}
		}
		initEditableContent(set){
			this.table.rows.forEach((item,i,arr)=>{
				for(let key in item){
					if(set.text){
						if(set.type === 'list' ? set.text && key === '_listItem' : set.text.includes(key)){
							this.setNormalText(item[key],i,key);
						}
					}
					if(set.singleImg){
						if(set.type === 'list' ? set.singleImg && key === '_listItem' : set.singleImg.includes(key)){
							this.setNormalSingleImg(item[key],i,key);
						}
					}
					if(set.sliderImg){
						if(set.type === 'list' ? set.sliderImg && key === '_listItem' : set.sliderImg.includes(key)){
							this.setNormalSliderImg(item[key],i,key);
						}
					}
					if(set.dateMultiRange){
						if(set.type === 'list' ? set.dateMultiRange && key === '_listItem' : set.dateMultiRange.includes(key)){
							this.setDateMultiRange(item[key],i,key);
						}
					}
					if(set.operator && set.operator.indexOf(key) > -1){
						this.setSelectCol(item[key],i,key);
					}
					if(set.messenger && set.messenger.indexOf(key) > -1){
						this.setMessengerCol(item[key],i,key);
					}
					if(set.social && set.social.indexOf(key) > -1){
						this.setSelectCol(item[key],i,key);
					}
				}
			});
		}
		setSelectCol(item,i,key){
			let select = item.querySelector('select');
			select.addEventListener('change',()=>this.jsonTable[i][key] = select.value);
		}
		setMessengerCol(item,i,key){
			let checkBox = item.querySelectorAll('input');
			let itemMod = this.jsonTable[i][key];
			for(let j = 0; j < checkBox.length; j++){
				checkBox[j].addEventListener('change',()=>{
					if(checkBox[j].checked && itemMod.indexOf(checkBox[j].value) === -1){
						itemMod.push(checkBox[j].value);
					}
					if(!checkBox[j].checked && itemMod.indexOf(checkBox[j].value) > -1){
						itemMod.splice(itemMod.indexOf(checkBox[j].value),1);
					}
				});
			}
		}


		setNormalText(item,i,key){
			let p = item.querySelector('.editable-txt');
			p.addEventListener('keydown',(e)=>{
				setTimeout(()=>{
					if(key === '_listItem'){
						this.jsonTable[i] = this.cleareText(p.outerHTML,'paragraf');
					} else {
						this.jsonTable[i][key] = this.cleareText(p.outerHTML,'paragraf');
					}
				},0);
			});
		}
		setNormalSingleImg(item,i,key){

			let uploadBtn = item.querySelector('.img-modal-open');
			let form = this.modal.singleImg.querySelector('form');

			uploadBtn.addEventListener('click',this.initNormalSingleImg.bind(this,item,i,key));
			// let col = document.createElement('div');
			// col.className = 'modal-slider-col';
			// let form = document.createElement('form');
			// form.className = 'dropzone';
			// form.setAttribute('method','post');
			// form.setAttribute('enctype','multipart/form-data');
			// form.setAttribute('style','margin:15px');
			// let formAction = this.path+'includes/request.php?action=upload_slider_img&path='+
			// encodeURIComponent(this.set.json)+
			// '&array='+this.tableSet.array+'&id='+i+
			// '&imgPath='+this.tableSet.imgPath+
			// '&key='+key+'&imgIndex='+iImg+
			// '&url='+encodeURIComponent(window.location.href);
			// form.action = formAction;
			// let input = document.createElement('input');
			// input.type = 'file';
			// input.name = 'setModalImgForm';
			// input.id = 'setModalImgForm';
			// form.appendChild(input);
			// form.appendChild(this.buttons.submitBtn({
			// 	'type':'submit'
			// }));
			// $(form).dropzone({
			// 	'paramName':'setModalImgForm',
			// 	'maxFiles':1
			// });
			// form.addEventListener('upload',this.finishUpload.bind(this,i,key,iImg,modal));
			// col.appendChild(form);
			// return col;
		}
		initNormalSingleImg(item,i,key){
			let modal = this.modal.normalModal();
			let modalBody = modal.querySelector('.modal-body');
			let action = this.path+'includes/request.php?action=set_single_img&path='
			+encodeURIComponent(this.set.json)+'&id='+i+'&array='+this.tableSet.array
			+'&imgPath='+this.tableSet.imgPath
			+'&key='+key+'&url='
			+encodeURIComponent(window.location.href);
			let form = document.createElement('form');
			form.className = 'dropzone';
			form.setAttribute('method','post');
			form.setAttribute('enctype','multipart/form-data');
			form.setAttribute('style','margin:15px');
			form.action = action;
			let input = document.createElement('input');
			input.type = 'file';
			input.name = 'setModalImgForm';
			input.id = 'setModalImgForm';
			form.appendChild(input);
			modalBody.appendChild(form);
			$(form).dropzone({
				'paramName':'imgFile',
				'maxFiles':1
			});
			let save = modal.querySelector('.save-btn');
			save.addEventListener('click',this.saveSingleImg.bind(this,modal));
			form.addEventListener('upload',this.uploadSingleImg.bind(this));
			$(modal).modal('show');
		}
		saveSingleImg(modal){
			$(modal).modal('hide');
		}
		uploadSingleImg(e){
			this.table = new Table;
			this.getObject();
			console.log(e.detail.img);
		}
		setNormalSliderImg(item,i,key){
			let btn = item.querySelector('.img-modal-open');
			btn.addEventListener('click',this.initModalSliderImg.bind(this,i,key,false));
		}
		setDateMultiRange(item,i,key){
			let text = item.querySelector('.date-range-col textarea');
			item.addEventListener('keydown',(e)=>{
				setTimeout(()=>{
					this.jsonTable[Number(i)][this.tableSet.dateMultiRange] = text.value;
				},0);
			});
			$((function() {
				moment.locale('ru');
				$(text).daterangepicker({
					opens: 'center',
					showOn:'down',
					autoUpdateInput: false,
					showDropdowns: true
				}, this.insertDateMultiRange.bind(this,text,i,key));
			}).bind(this));
		}
		insertDateMultiRange(text,i,key,start,end){
			let newDate = start.format('DD.MM.YYYY') + ' - ' + end.format('DD.MM.YYYY');
			let inputValue = text.value;
			if(inputValue.includes(newDate)){
				text.value = inputValue.replace(RegExp(newDate+'[^0-9]+'), "");
			} else {
				text.value += text.value ? ', ' : '';
				text.value += newDate;
			}
			this.jsonTable[Number(i)][this.tableSet.dateMultiRange] = text.value;
		}

		initModalSliderImg(i,key,existModal){
			let modal = existModal ? existModal : this.modal.normalModal();
			let modalBody = modal.querySelector('.modal-body');
			modalBody.innerHTML = '';
			let path = this.jsonTable[i].imgPath;
			path = this.table.createFormatPath(path);
			let images = this.jsonTable[i][key];
			if(images || images.length){
				images.forEach((itemImg,iImg,arr)=>{
					if(itemImg.constructor !== Object){
						let img = new Image();
						img.src = '../'+this.path+path+itemImg;
						img.style.width = '200px';
						img.style.height = '150px';
						modalBody.appendChild(this.createModalSliderRow(i,key,iImg,img,modal));
					}
				});
			}
			modalBody.appendChild(this.createModalSliderFoot(i,key,modal));
			if(!existModal){
				$(modal).modal();
			}
			this.initSaveSliderBtn(modal);
			this.initCloseSliderBtn(modal);
		}
		initSaveSliderBtn(modal){
			let btn = modal.querySelector('.save-btn');
			btn.addEventListener('click',(e)=>{
				this.save = true;
				if(this.deletedFiles){
					this.sendDel(this.deletedFiles);
					delete this.deletedFiles;
				}
				this.writeJsonRequest((()=>{
					$(modal).modal('hide');
					this.save=false;
				}).bind(this));
			});
		}

		sendDel(file){
			this.sendRequest({
				'method':'POST',
				'url':this.set.request_file+'?action=del_files',
				'dates':'file='+JSON.stringify(file),
				'fun':'sendDel'
			});
		}

		initCloseSliderBtn(modal){
			$(modal).on('hidden.bs.modal',this.refreshTable.bind(this));
		}
		refreshTable(){
			if(!this.save){
				this.table = new Table(this.path);
				this.getObject();
			}
		}
		createModalSliderRow(objIndex,key,iImg,img,modal){
			let row = document.createElement('div');
			row.className = 'modal-img-row pdb-1 mrb-1';
			row.setAttribute('style','display:flex; align-items:center; justify-content: space-around; border-bottom: 1px solid #e9ecef;')
			if(img === false){
				let imgIndex = this.jsonTable[objIndex][key].length;
				row.appendChild(this.createUploadSliderImgCol(objIndex,key,imgIndex));
			} else {
				let col = document.createElement('div');
				col.className = 'modal-img-col';
				col.appendChild(img);
				row.appendChild(col);
				row.appendChild(this.createUploadSliderImgCol(objIndex,key,iImg,modal));
				row.appendChild(this.createModalSetBtn(objIndex,key,iImg,modal));
			}
			return row;
		}
		createModalSetBtn(objIndex,key,iImg,modal){
			let col = document.createElement('div');
			col.className = 'modal-img-col';
			col.setAttribute('style','width: 100%; height: 100%; display:flex; align-items:center; justify-content:space-around');
			let delBtn = this.buttons.delBtn();
			col.appendChild(delBtn);
			this.initModalDelBtn(delBtn,objIndex,key,iImg,modal);
			let upBtn = this.buttons.upBtn();
			col.appendChild(upBtn);
			this.initModalUpBtn(upBtn,objIndex,key,iImg,modal);
			let downBtn = this.buttons.downBtn();
			col.appendChild(downBtn);
			col.setAttribute('style','width:150px');
			this.initModalDownBtn(downBtn,objIndex,key,iImg,modal);
			return col;
		}

		initModalDelBtn(btn,objIndex,key,iImg,modal){
			btn.addEventListener('click',(e)=>{
				let item = this.jsonTable[objIndex][key];
				if(!this.deletedFiles){
					this.deletedFiles = [];
				}
				let imgPath = this.set.imgPath ? this.table.createFormatPath(this.jsonTable[Number(objIndex)][this.set.imgPath]) : '';
				let del = imgPath+item.splice(iImg,1);
				this.deletedFiles.push(del);
				this.initModalSliderImg(objIndex,key,modal);
			});
		}
		initModalUpBtn(btn,objIndex,key,iImg,modal){
			btn.addEventListener('click',(e)=>{
				let item = this.jsonTable[objIndex][key];
				if(item[iImg-1]){
					let curr = item[iImg].constructor === Object ? this.copyAll(item[iImg]) : item[iImg];
					item[iImg] = item[iImg-1];
					item[iImg-1] = curr;
				}
				this.initModalSliderImg(objIndex,key,modal);
			});
		}
		initModalDownBtn(btn,objIndex,key,iImg,modal){
			btn.addEventListener('click',(e)=>{
				let item = this.jsonTable[objIndex][key];
				if(item[iImg+1]){
					let curr = item[iImg].constructor === Object ? this.copyAll(item[iImg]) : item[iImg];
					item[iImg] = item[iImg+1];
					item[iImg+1] = curr;
				}
				this.initModalSliderImg(objIndex,key,modal);
			});
		}
		createUploadSliderImgCol(i,key,iImg,modal){
			let col = document.createElement('div');
			col.className = 'modal-slider-col';
			let form = document.createElement('form');
			form.className = 'dropzone';
			form.setAttribute('method','post');
			form.setAttribute('enctype','multipart/form-data');
			form.setAttribute('style','margin:15px');
			let formAction = this.path+'includes/request.php?action=upload_slider_img&path='+
			encodeURIComponent(this.set.json)+
			'&array='+this.tableSet.array+'&id='+i+
			'&imgPath='+this.tableSet.imgPath+
			'&key='+key+'&imgIndex='+iImg+
			'&url='+encodeURIComponent(window.location.href);
			form.action = formAction;
			let input = document.createElement('input');
			input.type = 'file';
			input.name = 'setModalImgForm';
			input.id = 'setModalImgForm';
			form.appendChild(input);
			form.appendChild(this.buttons.submitBtn({
				'type':'submit'
			}));
			$(form).dropzone({
				'paramName':'setModalImgForm',
				'maxFiles':1
			});
			form.addEventListener('upload',this.finishUpload.bind(this,i,key,iImg,modal));
			col.appendChild(form);
			return col;
		}
		finishUpload(i,key,iImg,modal,e){
			let imgName = e.detail.img;
			this.table = new Table(this.path);
			this.getObject();
			this.jsonTable[Number(i)][key][Number(iImg)] = imgName;
			this.initModalSliderImg(i,key,modal);
		}

		createModalSliderFoot(i,key,modal){
			let div = document.createElement('div');
			let item = this.jsonTable[i][key];
			let form = document.createElement('form');
			form.className = 'dropzone';
			form.setAttribute('method','post');

			form.setAttribute('method','post');
			form.setAttribute('enctype','multipart/form-data');
			form.setAttribute('style','margin:15px');
			let formAction = this.path+'includes/request.php?action=upload_multi_slider_img&path='+
			encodeURIComponent(this.set.json)+
			'&array='+this.tableSet.array+'&id='+i+
			'&imgPath='+this.tableSet.imgPath+
			'&key='+key+'&imgIndex='+i+
			'&url='+encodeURIComponent(window.location.href);
			form.action = formAction;
			let input = document.createElement('input');
			input.type = 'file';
			input.name = 'setModalImgForm';
			input.id = 'setModalImgForm';
			form.appendChild(input);
			form.appendChild(this.buttons.submitBtn({
				'type':'submit'
			}));
			$(form).dropzone({
				'paramName':'setModalImgForm'
			});
			form.addEventListener('uploadedItems',this.checkUploadedItems.bind(this));
			form.addEventListener('upload',this.finishMultiUpload.bind(this,i,key,modal));
			div.appendChild(form);
			return div;
		}
		checkUploadedItems(e){
			if(!this.allImgItems){
				this.allImgItems = e.detail.img;
				this.countUploaded = [];
			}
		}
		finishMultiUpload(i,key,modal,e){
			this.countUploaded.push(e.detail.img);
			if(this.allImgItems === this.countUploaded.length){
				this.table = new Table(this.path);
				this.getObject();
				this.jsonTable[Number(i)][key] = this.jsonTable[Number(i)][key].concat(this.countUploaded);
				this.initModalSliderImg(i,key,modal);
				delete this.allImgItems;
				delete this.countUploaded;
			}
		}

		initSetButtons(empty){
			if(!empty){
				this.table.rows.forEach((item,i,arr)=>{
					let delBtn = item._setBtns.querySelector('.del-btn') || false;
					let upBtn = item._setBtns.querySelector('.up-btn') || false;
					let downBtn = item._setBtns.querySelector('.down-btn') || false;
					if (delBtn) delBtn.addEventListener('click',this.initDelRowBtn.bind(this,i));
					if (upBtn) upBtn.addEventListener('click',this.initUpRowBtn.bind(this,i));
					if (downBtn)	downBtn.addEventListener('click',this.initDownRowBtn.bind(this,i));
				});
			} else {
				let i = this.jsonTable.length-1;
				let item = this.table.rows[i];
				let delBtn = item._setBtns.querySelector('.del-btn') || false;
				let upBtn = item._setBtns.querySelector('.up-btn') || false;
				let downBtn = item._setBtns.querySelector('.down-btn') || false;
				if (delBtn) delBtn.addEventListener('click',this.initDelRowBtn.bind(this,i));
				if (upBtn) upBtn.addEventListener('click',this.initUpRowBtn.bind(this,i));
				if (downBtn)	downBtn.addEventListener('click',this.initDownRowBtn.bind(this,i));
			}
		}

		initDelRowBtn(i){
			if(!this.tableSet.social){
				if(this.table.rows.length > 1){
					this.deleteRecordModal(i);
				} else {
					console.log('you cant delete last record');
				}
			} else {
				this.deleteRecordModal(i);
			}
		}
		deleteRecordModal(i){
			let modal = this.modal.confirmDel();
			let confirm = modal.querySelector('.confirm-btn');
			confirm.addEventListener('click',this.deleteRecord.bind(this,i));
			$(modal).modal();
		}
		deleteRecord(i){
			this.jsonTable.splice(Number(i),1);
			this.writeJsonRequest();
		}
		initUpRowBtn(i){
			let table = this.jsonTable;
			if(table[i-1]){
				this.addLoader();
				let curr = this.set.type === 'normal' ? this.copyAll(table[i]) : table[i];
				table[i] = table[i-1];
				table[i-1] = curr;
				this.writeJsonRequest();
			}
		}
		initDownRowBtn(i){
			let table = this.jsonTable;
			if(table[i+1]){
				this.addLoader();
				let curr = this.set.type === 'normal' ? this.copyAll(table[i]) : table[i];
				table[i] = table[i+1];
				table[i+1] = curr;
				this.writeJsonRequest();
			}
		}
		copyAll(item){
			let curr = {};
			for(let key in item){
				curr[key] = item[key].constructor === Array ? item[key].slice(0) : item[key];
			}
			return curr;
		}


		createFooter(){
			let foot = document.createElement('tfoot');
			let tr = document.createElement('tr');
			let th = document.createElement('th');
			let wrap = document.createElement('div');
			wrap.className = 'table-foot';
			if(this.tableSet.tableControl) {
				if(this.tableSet.tableControl.indexOf('saveBtn') > -1){
					this.tableSet.tableControl[this.tableSet.tableControl.indexOf('saveBtn')] = {
						'button':'saveBtn',
						'onclick': this.initSaveBtn.bind(this)
					}
				}
				if(this.tableSet.tableControl.indexOf('addBtn') > -1){
					this.tableSet.tableControl[this.tableSet.tableControl.indexOf('addBtn')] = {
						'button':'addBtn',
						'onclick': this.initAddBtn.bind(this)
					}
				}
				wrap.appendChild(this.buttons.btnGroup(this.tableSet.tableControl));
			} else {
				let addBtn = this.buttons.addBtn({'onclick':this.initAddBtn.bind(this)});
				let saveBtn = this.buttons.saveBtn({'onclick':this.initSaveBtn.bind(this)});
				wrap.appendChild(addBtn);
				wrap.appendChild(saveBtn);
			}
			th.appendChild(wrap);
			// th.setAttribute('colspan',this.table.rows[0].tr.childNodes.length);
			th.setAttribute('colspan',this.table.head.lastChild.childElementCount);
			tr.appendChild(th);
			foot.appendChild(tr);
			return foot;
		}
		initAddBtn(){
			this.insertEmptyRecord();
			this.insertRows(this.set,true);
			this.initSetButtons(true);
			this.addLoader();
			this.writeJsonRequest();
		}
		initSaveBtn(){
			this.writeJsonRequest(this.saveAlert.bind(this));
		}
		insertNormalEmptyRecord(){
			this.jsonTable.push({});
			let newRecord = this.jsonTable[this.jsonTable.length-1];
			for(let key in this.jsonTable[0]){
				if(this.tableSet.messenger && this.tableSet.messenger.indexOf(key) > -1){
					newRecord[key] = [];
					continue;
				}
				if(this.tableSet.imgPath && this.tableSet.imgPath === key){
					if(this.tableSet.singleImg){
						newRecord[key] = this.jsonTable[0][this.tableSet.imgPath];
						continue;
					}
					if(this.tableSet.sliderImg){
						newRecord[key] = this.createPrevImgPath(this.jsonTable[0][this.tableSet.imgPath]);
						continue;
					}
				}
				newRecord[key] = '';
			}
		}
		createPrevImgPath(lastPath){
			lastPath = this.table.createFormatPath(lastPath);
			lastPath = lastPath.split('/');
			lastPath = lastPath.filter(item=>item);
			lastPath.splice(-1,1);
			lastPath = lastPath.join('/')+'/path'+this.jsonTable.length+'/';
			return lastPath;
		}
		insertListEmptyRecord(){
			this.jsonTable.push('');
		}



	}
