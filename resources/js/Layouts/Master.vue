<template>
  <div class="main-wrapper">
    <div class="navbar-bg"></div>
    <navbar-layout></navbar-layout>
    <div class="main-sidebar">
      <sidebar-layout></sidebar-layout>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <slot />
    </div>
    <footer-layout></footer-layout>
  </div>
</template>
<script>
import FooterLayout from "@/Layouts/Footer";
import NavbarLayout from "@/Layouts/Navbar";
import SidebarLayout from "@/Layouts/Sidebar";
import { Head } from "@inertiajs/inertia-vue3";

export default {
  components: {
    FooterLayout,
    NavbarLayout,
    SidebarLayout,
  },
};
</script>