module.exports = function (grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON("package.json"),
		sass: {
			dist: {
				files: {
					"assets/css/styles.css": "assets/scss/styles.scss",
				},
			},
		},
		cssmin: {
			dist: {
				files: {
					"assets/css/styles.min.css": "assets/css/styles.css",
				},
			},
		},
		uglify: {
			options: {
				mangle: false,
			},
			my_target: {
				files: {
					"assets/js/scripts.min.js": [
						"assets/js/vendor.js",
						"assets/js/main.js",
					],
				},
			},
		},
		watch: {
			css: {
				files: "**/*.scss",
				tasks: ["sass"],
				options: {
					livereload: true,
				},
			},
			php: {
				files: ["**/*.php"],
				options: {
					livereload: true,
				},
			},
		},
	});
	grunt.loadNpmTasks("grunt-contrib-sass");
	grunt.loadNpmTasks("grunt-contrib-watch");
	grunt.loadNpmTasks("grunt-contrib-cssmin");
	grunt.loadNpmTasks("grunt-contrib-uglify");
	grunt.registerTask("default", ["watch"]);
};
