<template>
    <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
            <div class="sidebar-brand-text mx-3">Admin</div>
        </a>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item" v-for="menu in menus" :key="menu.id">
            <template v-if="menu.parent_id === null || activeMenus.includes(menu.id)">
                <a class="collapse-item text-white" href="#" @click.prevent="toggleMenu(menu.id)">
                    <span>{{ menu.name }}</span>
                </a>
                <ul class="list-group list-unstyled" v-if="activeMenus.includes(menu.id)">
                    <li class="nav-item ml-4" v-for="child in menus.filter(item => item.parent_id === menu.id)"
                        :key="child.id">
                        <a class="collapse-item text-white" href="#">{{ child.name }}</a>
                    </li>
                </ul>
            </template>
        </li>
        <hr class="sidebar-divider d-none d-md-block">
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
</template>
  
<script>
import axios from 'axios';

export default {
    data() {
        return {
            menus: [],
            activeMenus: [], // Thêm activeMenus vào trong data()
        };
    },
    methods: {
        toggleMenu(menuId) {
            if (this.activeMenus.includes(menuId)) {
                this.activeMenus = this.activeMenus.filter(id => id !== menuId);
            } else {
                this.activeMenus.push(menuId);
            }
        },
        toggleSidebar() {
            document.body.classList.toggle('sidebar-toggled');
            document.querySelector('.sidebar').classList.toggle('toggled');
            if (document.querySelector('.sidebar').classList.contains('toggled')) {
                document.querySelectorAll('.sidebar .collapse').forEach((el) => {
                    el.classList.remove('show');
                });
            }
        },
    },
    created() {
        axios.get('/menus').then(response => {
            this.menus = response.data;
        });
    },
    mounted() {
        document.getElementById('sidebarToggle').addEventListener('click', this.toggleSidebar);
    },
};

</script>
  