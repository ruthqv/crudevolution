import Vue from 'vue'
import VueRouter from 'vue-router'
import CrudEvolution from '../views/CrudEvolution.vue'
import Crud from '../views/Crud.vue'

Vue.use(VueRouter)
export default new VueRouter({
  mode: 'history',

  routes: [  



        {
            path: '/crudevolution',
            name: 'crudevolution',
            component: CrudEvolution
        },

  
        {
            path: '/crud',
            name: 'crud',
            component: Crud
        }, 

    ],
});