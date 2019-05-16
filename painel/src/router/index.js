import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import KLogin from '../components/KLogin'
import KDashboard from '../components/KDashboard'
import KListaCliente from '../components/KListaCliente'
import KCadCliente from '../components/KCadCliente'

export default new Router({
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
