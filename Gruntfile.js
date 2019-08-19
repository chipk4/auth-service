module.exports = function (grunt) {
    require('load-grunt-tasks')(grunt)
    const artifactDir = './target'
    const buildDir = artifactDir + '/tmp'
    grunt.file.mkdir(buildDir)
    grunt.initConfig
    const objConfig = {
        'apidoc': require('./grunt_tasks/apidoc/apidoc.js')(artifactDir)
        }
    grunt.config.merge(objConfig)
    grunt.registerTask('dev', [
        'apidoc'
    ])
}
