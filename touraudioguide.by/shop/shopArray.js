class ShopArray {
	constructor(products){
		this.seriesArray = this.createSeries(products);
		this.array = this.createCategory(this.seriesArray);
	}
	createSeries(products) {
		let seriesArray = [];
		for(let i = 0; i < products.length; i++){
			let gettedSeries = products[i].series;
			let series = gettedSeries.split(',');
			for(let j = 0; j < series.length; j++){
				let checkIfExist = 0;
				for(let count = 0; count < seriesArray.length; count++){
					if(seriesArray[count].indexOf(series[j]) > -1){
						checkIfExist++
					}
				}
				if(!checkIfExist){
					let newArray = [series[j],[]];
					seriesArray.push(newArray);
				}
			}
		}
		for(let i = 0; i < products.length; i++){
			let series = products[i].series.split(',');
			for(let j = 0; j < series.length; j++){
				for(let count = 0; count < seriesArray.length; count++){
					if(seriesArray[count][0] === series[j]){
						seriesArray[count][1].push(products[i]);
					}
				}
			}
		}
		return seriesArray;
	}
	createCategory(array){
		let result = [];
		for(let i = 0; i < array.length; i++){
			let newArray = [array[i][0]];
			let categories = [];
			for(let j = 0; j < array[i][1].length; j++){
				let checkIfExist = 0;
				for(let count = 0; count < categories.length; count++){
					if(categories[count].indexOf(array[i][1][j].category) > -1){
						checkIfExist++;
					}
				}
				if(!checkIfExist){
					let newArray = [array[i][1][j].category,[]];
					categories.push(newArray);
				}
			}
			for(let j = 0; j < array[i][1].length; j++){
				for(let count = 0; count < categories.length; count++){
					if(categories[count][0] === array[i][1][j].category){
						categories[count][1].push(array[i][1][j]);
						if(!categories[count][2]){
							categories[count][2] = array[i][1][j].icoClass;
						}
					}
				}
			}
			newArray.push(categories);
			result.push(newArray);
		}
		return result;
	}
	createArray(products) {
		let array = [];
		for(let i = 0; i < products.length; i++){
			let type = products[i].category;
			if(!array.includes(type)){
				array.push(type);
			}
		}
		for(let i = 0; i < array.length; i++){
			let row = [array[i],[]];
			array[i] = row;
		}
		for(let i = 0; i < products.length; i++){
			for(let j = 0; j < array.length; j++){
				if(array[j][0] === products[i].category){
					delete products[i].category;
					array[j][1].push(products[i]);
					array[j][2] = Number(products[i].orderBy);
					array[j][3] = products[i].icoClass;
				}
			}
		}
		return array;
	}
}
