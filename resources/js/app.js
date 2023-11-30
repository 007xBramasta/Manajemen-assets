import { createApp } from 'vue'
import router from './src/router/router.js'
import App from './src/App.vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/js/bootstrap.bundle.js'

createApp(App).use(router).mount('#app')
