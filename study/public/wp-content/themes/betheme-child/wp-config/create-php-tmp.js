// 创建 php 模版
const fs = require('fs')
const fsExtra = require('fs-extra')
const mkdirp = require('mkdirp')
const path = require('path')
const utils = require('./utils.js')
const projectRoot = path.resolve(__dirname, '../')

const name = process.argv[2]
const cssPath = ''
const argv = require('yargs')
	.options('f', {
	  alias: 'file', // 别名
	  demand: true, //必填项
	  describe: 'Please enter the file name',
	  type: 'string'
	})
	.usage('Usage npm run create [options]')
	.example('npn run create p01-home')
	.help('h')
	.alias('h', 'help')
	.argv

var pageFiles = argv._
argv.file ? pageFiles.unshift(argv.file) : pageFiles;
if (pageFiles.length === 0) {
  console.log('Please enter the file name')
  console.log('Usage npn run create p01-home')
  return;
}

pageFiles = utils.unique(pageFiles)

function createPhpFile (name) {
	let details = name.indexOf('details') > -1 ? ' Template Post Type: post, page, product ,portfolio' : '';
	let tmp = `<?php
/**
 * Template Name: MML-${name}
 * ${details}
 * @package Betheme
 * @author Muffin Group
 */

get_header();
?>`;

	let empty = '\n\n\n\n<!-- Please write the HTML code here -->\n\n\n\n';
	let tmpFt = `${empty}<?php get_footer();\n\n
// Omit Closing PHP Tags\n\n`;
	tmp = tmp + tmpFt
	let filePath = `${projectRoot}/templates/${name}.php`
	fs.writeFileSync(filePath, tmp)
  console.log('create '+ name +'.php file success')
}

function creatrSassFile (name) {
	let filePath = `${projectRoot}/src/sass/pages/${name}.scss`
	fs.writeFileSync(filePath, '')
  console.log('create '+ name +'.scss file success')
}

function updateMainScss (str) {
	let filePath = `${projectRoot}/src/sass/main.scss`
	let mainCont = fs.readFileSync(filePath)
	fs.writeFileSync(filePath, mainCont + str)
	console.log('write scss file success')
}

let str = ''
pageFiles.forEach(function(name, index){
  createPhpFile(name)
  creatrSassFile(name)
  str += `@import "pages/${name}";\n`
})

updateMainScss(str)


