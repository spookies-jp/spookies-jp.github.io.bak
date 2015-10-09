module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        typescript: {
            compile: {
                src: ['ts/*.ts'],
                dest: 'js',
                options: {
                    base_path: 'ts',
                }
            },
        },
        compass: {
            prod: {
                options: {
                    config: 'config.rb',
                    environment: 'production',
                    outputStyle: 'compressed'
                }
            },
            dev: {
                options: {
                    config: 'config.rb',
                    environment: 'development',
                    outputStyle: 'expanded'
                }
            }
        },
        watch: {
            styles: {
                files: ['scss/*.scss'],
                tasks: ['compass:dev']
            },
            scripts: {
                files: ['ts/*.ts'],
                tasks: ['typescript']
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-typescript');

    grunt.registerTask('compile', ['typescript:compile', 'compass:prod']);
};
