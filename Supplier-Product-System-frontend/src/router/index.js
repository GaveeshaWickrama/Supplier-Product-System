import { createRouter, createWebHistory } from 'vue-router'
import SupplierList from '@/components/SupplierList.vue'
import AddSupplier from '@/components/AddSupplier.vue'
import EditSupplier from '@/components/EditSupplier.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'SupplierList',
      component: SupplierList,
    },
    {
      path: '/add_supplier',
      name: 'AddSupplier',
      component: AddSupplier,
    },
    {
      path: '/supplier/edit/:id?',
      name: 'EditSupplier',
      component: EditSupplier,
    },
  ],
})

export default router
