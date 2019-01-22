#README

## npm start
npm start 是一个复合命令，执行它之后，它会同时启动 dev 和 dev2命令， dev 命令是用来编译 scss 文件的， dev2 是用来编译 es6 代码的。 想写 es6 代码的同学在 src/js 目录下创建js文件编写 es6 的代码，启动 npm start 命令。es6 源码会编译生成到 dist/js 文件夹下。 我们只需要在页面中引用 dits/js 文件下的 js 即可。


## npm run create
执行 npm run create page1 page2 page3 会生成默认的 php、scss 文件（php文件名、scss 文件名是一致的），并且会把 scss 文件自动引入到 main.scss 文件中。 可以在项目开始的使用一次性的把所有需要的页面建好，这样在开发的时候就不需要在去建文件了。 
如果输入的名称中包含 details 这个词，会自动加入“ Template Post Type: post, page, product ,portfolio ” php模版语句，在选择商品详情页的时候就可以选择自定义的模版了。


## npm run createImg
目前我们开发的时候是需要去把设计的切图复制到 dist/img 目录下的，有时候设计切图的命名有大小写还有空格的情况。我们还需要去修改对应的文件名，这个比较繁琐，我们可以把切图全部复制到 img-slice 文件夹中， 如何执行 npm run createImg， 它会自动的帮你修改文件名，并且复制到 dist/img 目录下； 并且还会生成一份文件名清单，需要图片的时候只要去文件名清单复制对应的路径就可以了。
这个命令只在开始项目开发的时候执行一次就可以了，后续有新增的图片，可以直接放到 dist/img 目录下，不需要再次执行这个命令。或者每次有新增的图片都放在 src/img-slice 下，然后执行这个命令。

## npm run phpRouter

相对路径替换为动态路径