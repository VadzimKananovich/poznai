class GetTours{
	constructor(type){
		this.type = type;
	}

	init(){
		this.http= new XMLHttpRequest();
		switch(this.type){
			case 'belarus': this.url = 'includes/request.php?action=get_tours_info&section=belarus';
			break;
			case 'belarus_pref': this.url = 'includes/request.php?action=get_tours_info&section=belarus_pref';
			break;
			case 'foreigners': this.url = 'includes/request.php?action=get_tours_info&section=foreigners';
			break;
			case 'foreigners_pref': this.url = 'includes/request.php?action=get_tours_info&section=foreigners_pref';
			break;
		}
		this.http.open('GET',this.url);
		if(this.url){
			this.http.send();
		}
		return new Promise(this.getDates.bind(this));
	}

	getDates(resolve,reject){
		this.http.onreadystatechange = ()=>{
			if(this.http.readyState === 4 && this.http.status === 200){
				resolve(JSON.parse(this.http.responseText));
			}
		}
	}
}
