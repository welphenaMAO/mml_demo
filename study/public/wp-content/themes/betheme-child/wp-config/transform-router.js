const axios = require('axios');
const path = require('path');
const fs = require('fs')
let pages = []
const tplPaths = [
	path.resolve(__dirname, '../', 'header.php'),
	path.resolve(__dirname, '../', 'footer.php')
]
const tplPath = path.resolve(__dirname, '../', 'templates/') // 默认模版路径

function eachTpl (tplPath) {
	let dirs = fs.readdirSync(tplPath)
	for (var i = 0; i < dirs.length; i++) {
		let stat = fs.statSync(tplPath + '/' + dirs[i])
		if (stat.isDirectory()) {
			eachTpl(path.join(tplPath, dirs[i]))
		} else {
			tplPaths.push(path.join(tplPath, dirs[i]))
		}
	}
}

eachTpl(tplPath)

function eachPages (pages) {
	for (let i = 0; i < pages.length; i++) {
		let reg = new RegExp(`href="/${pages[i].name}(/)?"`)
		for (let j = 0; j < tplPaths.length; j++) {
			let itemCont = fs.readFileSync(tplPaths[j]);
			let link = `href="<?php echo get_permalink(${pages[i].ID}); ?>"`;
			itemCont = itemCont.toString().replace(reg, link)
			fs.writeFileSync(tplPaths[j], itemCont)
		}
	}
}

axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
axios.defaults.headers.post['X-Requested-With'] = 'XMLHttpRequest';

axios.post('http://atnjtech.mml.local/wp-common/page.php').then(function (response) {
  pages = response.data
  eachPages(pages)
}).catch(function (error) {
  console.log(error);
});
