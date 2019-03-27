class JSONconnect{
	constructor(url){
		this.url = url ? 'includes/proxy_request.php?url='+url : 'jsdb/includes/request.php';
		this.http = new XMLHttpRequest();
		this.init();

	}
	init(){
		this.action = [
			'create_folder',
			'get_info',
			'open_folder',
			'delete_folder',
			'rename_folder',

			'create_json',
			'open_json',
			'delete_json',
			'rename_json',
			'json_push',
			'delete_from_json',
			'get_all_info',

			'scan_dir',
			'get_all_img'
		];
		this.error = [
			'folder just exist',
			'folder is empty',
			'folder does not exist',
			'not enough impudent arguments',
			'FATAL ERROR ON SERVER',
			'json file with this name just exist',
			'json file does not exist',
			'',
			''
		];
		this.confirm = [
			'the folder has been removed',
			'the folder has been renamed',
			'the folder has been created',
			'the info are in object json',
			'the json file has been created',
			'the json file has been removed',
			'the object has been added'
		];
	}

	/*====================================================
	FUNCTION CREATE FOLDER
	=====================================================*/
	create_folder(folder){
		if(!folder){
			throw this.error[3];
			return;
		}
		this._PARAM = {'folder':folder};
		return new Promise(this._CREATE_FOLDER.bind(this));
	}
	_CREATE_FOLDER(resolve,reject){
		let res = new Promise(this.request.bind(this,0));
		res.then((result)=>{
			if(result === 'folder exist'){
				throw this.error[0];
				resolve();
				return;
			}
			console.log(this.confirm[2]);
			resolve();
		});
	}

	/*====================================================
	FUNCTION GET _INFO FILE
	=====================================================*/
	get_info(folder=''){
		this._PARAM = {'folder':folder};
		return new Promise(this._GET_INFO.bind(this));
	}
	_GET_INFO(resolve,reject){
		let res = new Promise(this.request.bind(this,1));
		res.then((result)=>{
			if(!this.json){
				this.json = {};
			}
			if(result === 'no exist'){
				throw this.error[2];
				resolve();
				return;
			}
			let info = result === 'empty' ? this.error[1] : JSON.parse(result);
			if(this._PARAM.folder){
				this.json[this._PARAM.folder] = {};
				this.json[this._PARAM.folder]._info = info;
			} else {
				this.json._info = info;
			}
			console.log(this.confirm[3]);
			resolve();
		})
	}

	/*====================================================
	FUNCTION OPEN FOLDER
	=====================================================*/
	open_folder(folder=''){
		this._PARAM = {'folder':folder};
		return new Promise(this._OPEN_FOLDER.bind(this));
	}
	_OPEN_FOLDER(resolve,reject){
		let res =  new Promise(this.request.bind(this,2));
		res.then((result)=>{
			if(!this.json){
				this.json = {};
			}
			if(this._PARAM.folder){
				this.json[this._PARAM.folder] = JSON.parse(result);
			} else {
				this.json = JSON.parse(result);
			}
			resolve();
		});
	}

	/*====================================================
	FUNCTION DELETE FOLDER
	=====================================================*/
	delete_folder(folder=''){
		this._PARAM = {'folder':folder};
		return new Promise(this._DELETE_FOLDER.bind(this));
	}
	_DELETE_FOLDER(resolve,reject){
		let res = new Promise(this.request.bind(this,3));
		res.then((result)=>{
			switch(result){
				case 'no exist': throw this.error[2];
				break;
				case 'removed': console.log(this.confirm[0]);
				break;
			}
		})
	}

	/*====================================================
	FUNCTION RENEAME FOLDER
	=====================================================*/
	rename_folder(folder,newFolder){
		if(!folder || !newFolder){
			throw this.error[3];
			return;
		}
		this._PARAM = {'folder':folder,'newFolder':newFolder};
		return new Promise(this._RENAME_FOLDER.bind(this));
	}
	_RENAME_FOLDER(resolve,reject){
		let res = new Promise(this.request.bind(this,4));
		res.then((res)=>{
			switch(res){
				case 'no exist': throw this.error[2];
				break;
				case 'folder just exist': throw this.error[0];
				break;
				case 'fatal error': throw this.error[4];
				break;
				case 'renamed': console.log(this.confirm[1]);
				break;
			}
			resolve();
		});
	}

	/*====================================================
	FUNCTION CREATE JSON FILE
	=====================================================*/
	create_json(folder,name,object=''){
		if(!name || !folder){
			console.log(this.error[3]);
			return;
		}
		this._PARAM = {'folder':folder,'name':name, 'object':object};
		return new Promise(this._CREATE_JSON.bind(this));
	}
	_CREATE_JSON(resolve,reject){
		let res = new Promise(this.request.bind(this,5));
		res.then((result)=>{
			switch(result){
				case 'file exist': throw this.error[5];
				break;
				case 'json is created': console.log(this.confirm[4]);
				break;
			}
			resolve();
		});
	}

	/*====================================================
	FUNCTION OPEN JSON FILE
	=====================================================*/
	open_json(folder,name){
		if(!folder || !name){
			throw this.error[3];
			return;
		}
		this._PARAM = {'folder':folder,'name':name};
		return new Promise(this._OPEN_JSON.bind(this));
	}
	_OPEN_JSON(resolve,reject){
		let res = new Promise(this.request.bind(this,6));
		res.then((result)=>{
			if(result === 'no folder'){
				throw this.error[2];
				resolve();
				return;
			}
			if(result === 'no json'){
				throw this.error[6];
				resolve();
				return;
			}
			if(!this.json){
				this.json = {};
			}
			if(!this.json[this._PARAM.folder]){
				this.json[this._PARAM.folder] = {};
			}
			this.json[this._PARAM.folder][this._PARAM.name] =  JSON.parse(result);
			resolve();
		})
	}

	/*====================================================
	FUNCTION DLETE JSON FILE
	=====================================================*/
	delete_json(folder,name){
		if(!folder || !name){
			throw this.error[3];
			return;
		}
		this._PARAM = {'folder':folder,'name':name};
		return new Promise(this._DELETE_JSON.bind(this));
	}
	_DELETE_JSON(resolve,reject){
		let res = new Promise(this.request.bind(this,7));
		res.then((result)=>{
			switch(result){
				case 'no folder': throw this.error[2];
				break;
				case 'no json': throw this.error[6];
				break;
				case 'json deleted': console.log(this.confirm[5]);
				break;
			}
			resolve();
		});
	}

	/*====================================================
	FUNCTION ADD RECORD TO JSON FILE
	=====================================================*/
	json_push(folder,name,object){
		if(!folder || !name || !object){
			throw this.error[3];
			return;
		}
		this._PARAM = {'folder':folder,'name':name,'object':object};
		return new Promise(this._JSON_PUSH.bind(this));
	}
	_JSON_PUSH(resolve,reject){
		let res = new Promise(this.request.bind(this,9));
		res.then((result)=>{
			switch(result){
				case 'no folder': throw this.error[2];
				break;
				case 'no json': throw this.error[6];
				break;
				case 'no object': throw this.error[3];
				break;
				case 'object is added': console.log(this.confirm[6]);
			}
			resolve();
		})
	}

	/*====================================================
	FUNCTION DELETE RECORD FROM JSON FILE
	=====================================================*/
	delete_from_json(folder,name,item){
		if(!folder || !name || !item && item != 0){
			throw this.error[3];
			return;
		}
		this._PARAM = {'folder':folder,'name':name,'item':item};
		return new Promise(this._DELETE_FROM_JSON.bind(this));
	}
	_DELETE_FROM_JSON(resolve,reject){
		let res = new Promise(this.request.bind(this,10));
		res.then((result)=>{
			console.log(result);
		});
	}


	/*====================================================
	FUNCTION DELETE RECORD FROM JSON FILE
	=====================================================*/
	get_all_info(){
		this._PARAM = {};
		return new Promise(this._GET_ALL_INFO.bind(this));
	}
	_GET_ALL_INFO(resolve,reject){
		let res = new Promise(this.request.bind(this,11));
		res.then((result)=>{
			this.all_info = JSON.parse(result);
			resolve();
		})
	}


	/*====================================================
	SEND REQUEST TO SERVER
	=====================================================*/
	request(action,resolve,reject){
		let url = this.url+'?action='+this.action[action];
		this.http.open('POST',url,true);
		this.http.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		let param = 'param='+JSON.stringify(this._PARAM);
		this.http.send(param);
		let request = new Promise(this.requestRes.bind(this));
		request.then((res)=>{
			resolve(res);
		});
	}
	requestRes(resolve,reject){
		this.http.onreadystatechange = ()=>{
			if(this.http.readyState === 4 && this.http.status === 200){
				resolve(this.http.responseText);
			}
		}
	}
}
