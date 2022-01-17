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

  mounted() {
    $("[data-toggle='sidebar']").click(function () {
      var body = $("body"),
        w = $(window);

      if (w.outerWidth() <= 1024) {
        body.removeClass("search-show search-gone");
        if (body.hasClass("sidebar-gone")) {
          body.removeClass("sidebar-gone");
          body.addClass("sidebar-show");
        } else {
          body.addClass("sidebar-gone");
          body.removeClass("sidebar-show");
        }

        update_sidebar_nicescroll();
      } else {
        body.removeClass("search-show search-gone");
        if (body.hasClass("sidebar-mini")) {
          toggle_sidebar_mini(false);
        } else {
          toggle_sidebar_mini(true);
        }
      }

      return false;
    });
  },
};
</script>
