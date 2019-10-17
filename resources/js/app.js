import Vue from 'vue';
import VueMaterial from 'vue-material';
import Toasted from 'vue-toasted';
import 'vue-material/dist/vue-material.min.css';
import 'vue-material/dist/theme/default.css';

import App from './components/App';

Vue.use(VueMaterial);
Vue.use(Toasted, {
    theme: 'toasted-primary',
    position: 'top-right',
    duration : 5000
});

const app = new Vue({
    el: '#app',
    components: { App },
});
