/*
1、遍历文件夹，拿到所有文件夹名称，转换成小写，并在 dist 创建对应文件夹
2、遍历文件夹里面的图片文件，将文件名统一修改为小写，并且去掉名称中的空格。拷贝到对应的文件夹中
*/
const fs = require('fs')
const path = require('path')
const mkdirpSync = require('mkdirp-sync')
const projectRoot = path.resolve(__dirname, '../')

const isImgSlice = fs.existsSync(projectRoot + '/src/images-slice')
if (!isImgSlice) {
	console.log('images-slice does not exist')
	return
}

if (!fs.existsSync(projectRoot + '/dist/images')) {
	mkdirpSync(projectRoot + '/dist/images', function(){})
}

let files = {}
let imgPaths = []
let alts = []
files[projectRoot + '/src/images-slice'] = projectRoot + '/dist/images'

function loopFiles (filePath) {
	let dirs = fs.readdirSync(filePath)
	for (var i = 0; i < dirs.length; i++) {
		let stat = fs.statSync(filePath + '/' + dirs[i])
		
		if (stat.isDirectory()) {
			let fileName = dirs[i].toLocaleLowerCase().replace(/[()（）|]/g, '').replace(/\s/g, '-')
			files[filePath + '/' + dirs[i]] = projectRoot + '/dist/images/' + fileName
			mkdirpSync(projectRoot + '/dist/images/' + fileName)
			loopFiles(filePath + '/' + dirs[i])
		}
		if (/\.(png|jpe?g|gif|svg)(\?.*)?$/.test(dirs[i])) {
			let newFile = files[filePath]
			alts.push(dirs[i].toLocaleLowerCase().replace(/[()（）|]/g, '').replace(/\.(jpg|jpeg|png|gif)/, ''))
			let newName = dirs[i].toLocaleLowerCase().replace(/[()（）|]/g, '').replace(/\s/g, '-')
			imgPaths.push((newFile + '/' + newName).replace((projectRoot + '/dist/images/'), ''))
			fs.copyFileSync(filePath + '/'+ dirs[i], newFile + '/' + newName);
		}
	}
}

function creatrImgPathsTxt (paths) {
	let cont = ''
	for (var i = 0; i < paths.length; i++) {
		// cont += paths[i] + '\r\n'
		cont += '<images src="/wp-content/themes/betheme-child/dist/images/'+ paths[i] +'" class="lazyload" alt="'+ alts[i] +'"/>' + '\r\n'
	}
	console.log(cont)
	let filePath = `${projectRoot}/src/img-slice/img-paths.html`
	fs.writeFileSync(filePath, cont)
  console.log('create images-paths.html file success')
}

loopFiles(projectRoot + '/src/images-slice')

creatrImgPathsTxt(imgPaths)



