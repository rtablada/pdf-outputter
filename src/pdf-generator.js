if (process.argv.length < 4) {
	process.exit(1);
}

var file = require('fs');
var phantomWrap = require('phantom');
var inPath = "file://localhost"+file.realpathSync(process.argv[2]);
var outPath =
	file.existsSync(process.argv[3]) ?
	file.realpathSync(process.argv[3]) :
	process.argv[3];


phantomWrap.create(function (phantom) {
	phantom.createPage(function (page) {
		page.open(inPath, function (status) {
			if (status !== 'success') {
				console.log('Unable to load the address!');
				process.exit(1);
			} else {
				page.render(outPath);
				process.exit(0);
			}
		});
	});
});
