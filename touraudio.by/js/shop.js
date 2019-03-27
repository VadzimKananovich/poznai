//
// let shop = window.location.search.indexOf('shop') != -1 ? true : false;
//
// function createShopArray(products){
// 	let array = [];
// 	for(let i = 0; i < products.length; i++){
// 		let type = products[i].ruType;
// 		if(!array.includes(type)){
// 			array.push(type);
// 		}
// 	}
// 	for(let i = 0; i < array.length; i++){
// 		let row = [array[i],[]];
// 		array[i] = row;
// 	}
// 	for(let i = 0; i < products.length; i++){
// 		for(let j = 0; j < array.length; j++){
// 			if(array[j][0] === products[i].ruType){
// 				delete products[i].ruType;
// 				array[j][2] = Number(products[i].order);
// 				array[j][1].push(products[i]);
// 			}
// 		}
// 	}
// 	return array;
// }
//
// function ShopElements (containerId) {
// 	this.container = document.querySelector(`#${containerId}`);
// 	this.createElements();
// }
//
// ShopElements.prototype = {
// 	createElements: function () {
// 		this.createMenu();
// 		this.createWrapper();
// 		this.createButtonsContainer();
// 	},
// 	createMenu: function () {
// 		let menuDiv = document.createElement('div');
// 		menuDiv.classList.add('buy-menu');
//
// 		// let sortContainer = document.createElement('div');
// 		// sortContainer.classList.add('sort-container');
// 		//
// 		// let optionSort = document.createElement('option');
//
// 		this.container.appendChild(menuDiv);
// 		this.menu = menuDiv;
// 	},
// 	createWrapper: function () {
// 		let wrapper = document.createElement('div');
// 		wrapper.classList.add('buy-wrapper');
// 		this.container.appendChild(wrapper);
// 		this.wrapper = wrapper;
// 	},
// 	createButtonsContainer: function () {
// 		let leftDiv = document.createElement('div');
// 		let iLeftDiv = document.createElement('i');
// 		let containerResult = document.createElement('div');
// 		let rightDiv = document.createElement('div');
// 		let iRightDiv = document.createElement('i');
// 		leftDiv.classList.add('buy-left');
// 		leftDiv.classList.add('disable');
// 		iLeftDiv.className = 'fas fa-angle-left';
// 		leftDiv.appendChild(iLeftDiv);
// 		containerResult.classList.add('buy-content');
// 		rightDiv.classList.add('buy-right');
// 		iRightDiv.className = 'fas fa-angle-right';
// 		rightDiv.appendChild(iRightDiv);
// 		this.wrapper.appendChild(leftDiv);
// 		this.wrapper.appendChild(containerResult);
// 		this.wrapper.appendChild(rightDiv);
// 		this.leftNav = leftDiv;
// 		this.containerResult = containerResult;
// 		this.rightNav = rightDiv;
// 	}
// }
// ShopElements.prototype.constructor = ShopElements;
//
//
//
// function Result(containerId, object) {
// 	ShopElements.call(this,containerId);
// 	this.object = object;
// 	this.arrayComplect = [];
// 	this.createResult();
// }
//
// Result.prototype = Object.assign(Object.create(ShopElements.prototype), {
//
// 	createResult: function () {
// 		let resContainer = document.createElement('div');
// 		resContainer.classList.add('complect-row-wrap');
// 		this.countComplect = 0;
// 		for(let i = 0; i < this.object.length; i++){
// 			let complect = this.createComplect(this.object[i], i);
// 			resContainer.appendChild(complect);
// 			this.countComplect++;
// 		}
// 		console.log(this.container);
// 		this.containerResult.appendChild(resContainer);
// 		this.resContainer = resContainer;
// 	},
//
// 	createComplect: function (complect,id) {
// 		let complectResult = document.createElement('div');
// 		complectResult.classList.add('complect-result');
// 		complectResult.dataset.id = id;
//
// 		let complectTitle = document.createElement('h3');
// 		let txtTitle = document.createTextNode(complect[0]);
// 		complectTitle.appendChild(txtTitle);
// 		complectTitle.classList.add('complect-title');
// 		complectResult.appendChild(complectTitle);
//
//
// 		for(let j = 0; j < complect[1].length; j++){
// 			let article = this.printArticle(complect[1][j]);
// 			complectResult.appendChild(article);
// 		}
// 		this.arrayComplect.push(complectResult);
// 		return complectResult;
//
// 	},
//
// 	printArticle: function (article){
// 		complectRow = document.createElement('div');
// 		if(article.id){
// 			complectRow.dataset.itemid = article.id;
// 		}
// 		complectRow.classList.add('complect-row');
//
// 		let complectRowFig = document.createElement('div');
// 		complectRowFig.classList.add('complect-row-fig');
// 		let articleName = document.createElement('h5');
// 		let txtArticleName = document.createTextNode(article.name);
// 		articleName.appendChild(txtArticleName);
//
// 		let itemImg = document.createElement('img');
// 		itemImg.setAttribute('src',article.img);
// 		itemImg.setAttribute('alt',article.name);
// 		complectRowFig.appendChild(articleName);
// 		complectRowFig.appendChild(itemImg);
//
// 		let complectRowDesc = document.createElement('div');
// 		complectRowDesc.classList.add('complect-row-desc');
// 		let complectRowDescP = document.createElement('p');
// 		let complectRowText = document.createTextNode(article.desc);
// 		complectRowDescP.appendChild(complectRowText);
// 		complectRowDesc.appendChild(complectRowDescP);
//
// 		complectRow.appendChild(complectRowFig);
// 		complectRow.appendChild(complectRowDesc);
// 		return complectRow;
// 	},
//
// 	createRow: function () {
// 		let row = document.createElement('div');
// 		row.classList.add('buy-res-row');
// 	}
//
// });
// Result.prototype.constructor = Result;
//
//
//
//
// function Shop (containerId, object) {
// 	Result.call(this,containerId, object);
// 	this.id = 0;
// 	this.width = this.containerResult.offsetWidth;
// 	this.position = 0;
// 	this.clickButtons();
//
// }
//
// Shop.prototype = Object.assign(Object.create(Result.prototype), {
// 	clickButtons: function () {
// 		this.wrapper.addEventListener('click', (e)=> {
// 			if(e.target === this.leftNav || e.target === this.leftNav.firstElementChild){
// 				if(this.id >=0){
// 					this.disableItem(this.leftNav);
// 				} else {
// 					this.unableItem(this.leftNav);
// 					this.unableItem(this.rightNav);
// 					this.id++;
// 				}
// 				this.changeComplect();
// 			}
// 			if(e.target === this.rightNav || e.target === this.rightNav.firstElementChild){
// 				if(this.id > -this.countComplect+1){
// 					this.unableItem(this.rightNav);
// 					this.unableItem(this.leftNav);
// 					this.id--;
// 				} else {
// 					this.disableItem(this.rightNav);
// 				}
// 				this.changeComplect();
// 			}
// 		});
// 		this.fixButtons();
// 	},
// 	changeComplect: function () {
// 		this.position = this.width * this.id;
// 		this.resContainer.setAttribute('style',`transform: translateX(${this.position}px);`);
// 		let height = this.arrayComplect[-this.id].offsetHeight;
// 		this.resContainer.style.height = `${height}px`;
// 	},
// 	fixButtons: function () {
// 		document.addEventListener ('scroll', ()=>{
// 			let offset = this.containerResult.getBoundingClientRect();
// 			if(offset.top <= 0 && offset.height >= window.pageYOffset - offset.bottom){
// 				this.leftNav.style.position = 'fixed';
// 				this.rightNav.style.position = 'fixed';
// 				this.leftNav.style.bottom = 'auto';
// 				this.rightNav.style.bottom = 'auto';
// 				this.leftNav.style.top = '0'+'px';
// 				this.rightNav.style.top = '0'+'px';
// 			} else {
// 				this.leftNav.style.position = 'absolute';
// 				this.rightNav.style.position = 'absolute';
// 				this.leftNav.style.bottom = 'auto';
// 				this.rightNav.style.bottom = 'auto';
// 			}
// 			if(offset.height < window.pageYOffset - offset.bottom){
// 				this.leftNav.style.top = 'auto';
// 				this.rightNav.style.top = 'auto';
// 				this.leftNav.style.bottom = '0'+'px';
// 				this.rightNav.style.bottom = '0'+'px';
// 			}
// 		})
// 	},
// 	disableItem: function (item){
// 		if(!item.classList.contains('disable')){
// 			item.classList.add('disable');
// 		}
// 	},
// 	unableItem: function(item){
// 		if(item.classList.contains('disable')){
// 			item.classList.remove('disable');
// 		}
// 	}
// });
//
// Shop.prototype.constructor = Shop;
