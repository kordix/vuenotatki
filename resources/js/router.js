
import Vue from 'vue'
import VueRouter from 'vue-router'

import linki from './components/Linki.vue'
import obrazki from './components/Obrazki.vue'



//import panel from './components/panel/Panel'



Vue.use(VueRouter)
export default new VueRouter({
    mode:'history',
    base:'obrazki',
    routes:[
        // {
        //     path:'/linki',
        //     component: linki
        // },
        {
            path:'/obrazki',
            component: obrazki
        },
        {
            path:'/',
            component: obrazki
        },
        {
            path:'',
            component: obrazki
        },
        {
            path:'/asdf',
            component: obrazki
        }
        // {
        //     path:'/all',
        //     component: linki
        // },
    ]
})