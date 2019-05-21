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
      meta: {
        requiresAuth: true
      },
      children: [
        {
          path: '/listaCliente',
          name: 'listaCliente',
          component: KListaCliente,
          meta: {
            requiresAuth: true
          }
        },
        {
          path: '/cadClientes',
          name: 'cadClientes',
          component: KCadCliente,
          meta: {
            requiresAuth: true
          }
        }
      ]
    }
  ]
})


router.beforeEach((to, routeFrom, next) => {
  const data = LocalStorage.get("SESSION_KABUM") || {token: ''};
  const requiresAuth = to.matched.some(record => record.meta.requiresAuth);

  if(requiresAuth && !data.token) {
    next('/');
  } else if(requiresAuth && data.token) {
    next();
  } else {
    next();
  }
})


export default router
