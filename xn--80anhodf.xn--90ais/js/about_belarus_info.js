class AboutBelarusInfo{
	constructor(header=false){
		this.header = header;
		this.http = new XMLHttpRequest();
		this.url = header ? 'includes/request.php?action=about_belarus_info&section=header' : 'includes/request.php?action=about_belarus_info&section=about';
	}
	init(){
		this.http.open('GET',this.url,true);
		this.http.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		this.http.send();
		return new Promise(this.sendRequest.bind(this));
	}
	sendRequest(resolve,reject){
		this.http.onreadystatechange = ()=>{
			if(this.http.readyState === 4 && this.http.status === 200){
				let result = this.createObject(this.http.responseText);
				resolve(result);
			}
		}
	}
	createObject(res){
		let object = JSON.parse(res);
		if(this.header){
			return this.createObjectHeader(object);
		} else {
			return object;
		}
	}

	createObjectHeader(object){
		let result = [];
		for(let key in object){
			let index = object[key].order_key
			result[index] = {};
			let image = new Image();
			image.src = object[key].img;
			result[index].desc = object[key].desc;
			result[index].img = image;
			result[index].name = object[key].name;
		}
		return result.filter(item=>item);
	}

	createObjectAboutBelarus(object){
		let info = object._info[0];
		let result = [];
		for(let key in info){
			if(object.hasOwnProperty(key)){
				for(let i = 0; i < object[key].length; i++){
					let imageName = object[key][i][0];
					let imageSrc = object[key][i][1];
					if(info[key].img.hasOwnProperty(imageName)){
						let img = new Image();
						img.src = imageSrc;
						info[key].img[imageName].file = img;
						info[key].img[imageName].fileName = imageName;
					}
				}
			}
			info[key].key = key;
			let index = Number(info[key].order_key);
			delete info[key].order_key;
			result[index] = info[key];
		}
		return result;
	}
}
