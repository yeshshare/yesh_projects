/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');




window.Vue = require('vue').default;


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('teste', require('./components/teste.vue').default);
Vue.component('app', require('./components/App.vue').default);
Vue.component('message.messages', require('./components/message/messages').default);
Vue.component('message.message', require('./components/message/message').default);
Vue.component('project.main', require('./components/projects/main').default);
Vue.component('project.overview', require('./components/projects/overview').default);
Vue.component('project.calendar', require('./components/projects/calendar').default);
Vue.component('task.main', require('./components/task/main').default);
Vue.component('task.overview', require('./components/task/overview').default);
Vue.component('task.list', require('./components/task/list').default);
Vue.component('task.board', require('./components/task/board').default);
Vue.component('task.timeline', require('./components/task/timeline').default);
Vue.component('task.calendar', require('./components/task/calendar').default);
Vue.component('task.workflow', require('./components/task/workflow').default);
Vue.component('task.dashboard', require('./components/task/dashboard').default);
Vue.component('task.file', require('./components/task/file').default);
Vue.component('task.test', require('./components/task/test').default);
Vue.component('navbar.project', require('./components/navbar/project').default);
Vue.component('utils.editable', require('./components/utils/editable').default);
Vue.component('utils.editableTextArea', require('./components/utils/editableTextArea').default);
Vue.component('utils.timeline', require('./components/utils/timeline').default);
Vue.component('utils.dropdownlwi', require('./components/utils/dropdownlwi').default);
Vue.component('modals.statusProject', require('./components/modals/statusProject').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

/*
function test() {
    console.log("test common function")
}
export default test;
*/