import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import KLogin from '../components/KLogin'
import KDashboard from '../components/KDashboard'
import KListaCliente from '../components/KListaCliente'
import KCadCliente from '../components/KCadCliente'
import LocalStorage from '../utils/LocalStorage'

const router = new Router({
  mode: 'history',
  routes: [
    {
      path: "/",
      name: "login",
      component: KLogin
    },
    {
      path: "/painel",
      name: "painel",
      component: KDashboard,
      children: [
        {
          path: '/listaCliente',
          name: 'listaCliente',
          component: KListaCliente
        },
        {
          path: '/cadClientes',
          name: 'cadClientes',
          component: KCadCliente
        }
      ]
    }
  ]
})
const data = LocalStorage.get("SESSION_KABUM") || {token: ''};

router.beforeEach((routeTo, routeFrom, next) => {
    if(routeTo.name != 'login') {
      if(!data.token) {
          next('/')
      } else {
          next();
      }
    }
    next()
})


export default router
