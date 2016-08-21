Vue.component('example', {
    template: '<h1>{{ msg }}</h1>',
    data: function () {
    }
});
const app = new Vue({
    el: 'body',
    data: {
        msg: 'qwrq'
    }
});
