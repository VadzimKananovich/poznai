class JSONconnect {
	constructor(user,password,host='jsdb/includes/bd_request.php'){
		this.user = {'name':user,'password':password,'host':host};
		this.http = new XMLHttpRequest();
	}

	connect(){
		const url = this.user.host+'?action=connect';
		this.http.open('POST', url, true);
		this.http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		let res = 'user='+this.user.name+'&password='+this.user.password;
		this.http.send(res);
		return new Promise(this.connectRes.bind(this));
	}
	connectRes(resolve,reject){
		this.http.onreadystatechange=()=>{
			if(this.http.readyState === 4 && this.http.status === 200){
				this.state = this.http.responseText;
				this.answer =  '';
				resolve();
			}
		}
	}

	disconnect(){
		const url = this.user.host+'?action=disconnect';
		this.http.open('POST', url, true);
		this.http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		let res = 'user='+this.user.name;
		this.http.send(res);
		return new Promise(this.disconnectRes.bind(this));
	}
	disconnectRes(resolve,reject){
		this.http.onreadystatechange=()=>{
			if(this.http.readyState === 4 && this.http.status === 200){
				this.state = this.http.responseText;
				this.answer =  '';
				resolve();
			}
		}
	}


	newbd(bd){
		const url = this.user.host+'?action=createbd&name='+bd;
		this.http.open('POST', url,true);
		this.http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		let res = 'user='+this.user.name;
		this.http.send(res);
		return new Promise(this.newbdRes.bind(this));
	}
	newbdRes(resolve,reject){
		this.http.onreadystatechange=()=>{
			if(this.http.readyState === 4 && this.http.status === 200){
				this.answer =  this.http.responseText;
				resolve();
			}
		}
	}


	openbd(bd){
		const url = this.user.host+'?action=openbd&bd='+bd;
		this.http.open('POST', url,true);
		this.http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		let res = 'user='+this.user.name;
		this.http.send(res);
		return new Promise(this.openbdRes.bind(this,bd));
	}
	openbdRes(bd,resolve,reject){
		this.http.onreadystatechange=()=>{
			if(this.http.readyState === 4 && this.http.status === 200){
				let res = this.http.responseText;
				if(res !== 'empty' && res !== 'noexist'){
					this.bd = {};
					this.bd[bd] = JSON.parse(res);
					this.answer =  `bd ${bd} is opened`;
				}
				if(res === 'empty'){
					this.answer = `bd ${bd} is empty`;
				}
				if(res === 'noexist'){
					this.answer = `bd ${bd} doesn't exist`;
				}
				resolve();
			}
		}
	}


	removebd(bd){
		const url = this.user.host+'?action=removebd&bd='+bd;
		this.http.open('POST', url,true);
		this.http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		let res = 'user='+this.user.name;
		this.http.send(res);
		return new Promise(this.removebdRes.bind(this,bd));
	}
	removebdRes(bd,resolve,reject){
		this.http.onreadystatechange=()=>{
			if(this.http.readyState === 4 && this.http.status === 200){
				let res = this.http.responseText;
				if(res === 'noexist'){
					this.answer =	`bd ${bd} doesn't exist`;
				}
				if(res === 'removed'){
					this.answer =	`bd ${bd} removed`;
				}
				resolve();
			}
		}
	}


	newtable(bd,table){
		const url = this.user.host+'?action=createtable&bd='+bd+'&table='+table;
		this.http.open('POST', url,true);
		this.http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		let res = 'user='+this.user.name;
		this.http.send(res);
		return new Promise(this.newtableRes.bind(this));
	}
	newtableRes(resolve,reject){
		this.http.onreadystatechange=()=>{
			if(this.http.readyState === 4 && this.http.status === 200){
				this.answer =  this.http.responseText;
				resolve();
			}
		}
	}


	removetable(bd,table){
		const url = this.user.host+'?action=removetable&bd='+bd+'&table='+table;
		this.http.open('POST', url,true);
		this.http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		let res = 'user='+this.user.name;
		this.http.send(res);
		return new Promise(this.removetableRes.bind(this));
	}
	removetableRes(resolve,reject){
		this.http.onreadystatechange=()=>{
			if(this.http.readyState === 4 && this.http.status === 200){
				this.answer =  this.http.responseText;
				resolve();
			}
		}
	}


	opentable(bd,table){
		const url = this.user.host+'?action=opentable&bd='+bd+'&table='+table;
		this.http.open('POST', url,true);
		this.http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		let res = 'user='+this.user.name;
		this.http.send(res);
		return new Promise(this.opentableRes.bind(this,bd,table));
	}
	opentableRes(bd,table,resolve,reject){
		this.http.onreadystatechange=()=>{
			if(this.http.readyState === 4 && this.http.status === 200){
				let res = this.http.responseText;
				if(res !== 'empty' && res !== 'noexist'){
					this.bd = {};
					this.bd[bd] = {};
					this.bd[bd][table] = JSON.parse(res);
					this.answer =  `the table ${table} of bd ${bd} is opened`;
				}
				if(res === 'empty'){
					this.answer = `bd ${bd} is empty`;
				}
				if(res === 'noexist'){
					this.answer = `bd ${bd} doesn't exist`;
				}
				resolve();
			}
		}
	}


	printbd(){
		const url = this.user.host+'?action=printbd';
		this.http.open('POST', url,true);
		this.http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		let res = 'user='+this.user.name;
		this.http.send(res);
		return new Promise(this.printbdRes.bind(this));
	}
	printbdRes(resolve,reject){
		this.http.onreadystatechange=()=>{
			if(this.http.readyState === 4 && this.http.status === 200){
				let res = this.http.responseText;
				if(res !== 'no bd' && res !== ''){
					this.allbd = JSON.parse(res);
				} else {
					this.allbd = res;
				}
				this.answer =  '';
				resolve();
			}
		}
	}


	write(bd,table,object){
		const url = this.user.host+'?action=write&bd='+bd+'&table='+table;
		this.http.open('POST', url, true);
		this.http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		let res = 'object='+JSON.stringify(object)+'&user='+this.user.name;
		this.http.send(res);
		return new Promise(this.writeRes.bind(this));
	}
	writeRes(resolve,reject){
		this.http.onreadystatechange=()=>{
			if(this.http.readyState === 4 && this.http.status === 200){
				this.answer =  this.http.responseText;
				resolve();
			}
		}
	}


	scanDir(dir){
		let urlDir = encodeURIComponent(dir);
		const url = this.user.host+'?action=scandir&dir='+urlDir;
		this.http.open('POST', url, true);
		this.http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		let res = 'user='+this.user.name;
		this.http.send(res);
		return new Promise(this.scanDirRes.bind(this));
	}
	scanDirRes(resolve,reject){
		this.http.onreadystatechange=()=>{
			if(this.http.readyState === 4 && this.http.status === 200){
				this.resScan =  JSON.parse(this.http.responseText);
				resolve();
			}
		}
	}


	addRecord(db,table,object){
		let record = JSON.stringify(object);
		const url = this.user.host+'?action=opentable&bd='+db+'&table='+table;
		this.http.open('POST', url, true);
		this.http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		let res = 'user='+this.user.name;
		this.http.send(res);
		this.dates = {'db':db,'table':table,'object':object};
		return new Promise(this.checkRecord.bind(this));
	}
	checkRecord(resolve,reject){
		this.http.onreadystatechange=()=>{
			if(this.http.readyState === 4 && this.http.status === 200){
				let res =  JSON.parse(this.http.responseText);

				if(res.constructor === Array){
					let newObject = {};
					for(let key in res[0]){
						newObject[key] = 'NULL';
					}
					for(let key in newObject){
						if(this.dates.object.hasOwnProperty(key)){
							newObject[key] = this.dates.object[key];
						}
					}
					res.push(newObject);
					let xhttp = new XMLHttpRequest();
					let url = this.user.host+'?action=write&bd='+this.dates.db+'&table='+this.dates.table;
					xhttp.open('POST', url, true);
					xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
					let send = 'object='+JSON.stringify(res)+'&user='+this.user.name;
					xhttp.send(send);
					xhttp.onreadystatechange=()=>{
						if(xhttp.readyState === 4 && xhttp.status === 200){
							this.answer =  xhttp.responseText;
							resolve();
						}
					}
				}
			}
		}
	}

}
