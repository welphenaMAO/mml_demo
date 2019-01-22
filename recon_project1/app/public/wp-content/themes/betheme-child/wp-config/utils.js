const path = require('path');
const glob = require('glob');

exports.getEntry = function (globPath, pathDir) {
  var files = '';
  var p = path.resolve();
  var entries = {},
  entry, dirname, basename, pathname, extname, tmp;
  glob.sync(path.join(p, globPath)).forEach(function (entry) {
    basename = path.basename(entry, path.extname(entry));
    tmp = entry.split('/').splice(-3);
    //pathname = tmp.splice(0, 1) + '/' + basename; // 正确输出文件路径
    //entries[pathname] = entry;
    entries[basename] = entry;
  });
  return entries;
}


exports.unique = function(arr) {
  var n = []
  for(var i = 0; i < arr.length; i++) {
    if (n.indexOf(arr[i]) === -1) n.unshift(arr[i])
  }
  return n
}