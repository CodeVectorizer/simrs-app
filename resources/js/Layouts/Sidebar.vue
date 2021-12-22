<template>
  <div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <inertia-link href="index.html">SIMRS</inertia-link>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <inertia-link href="index.html">SIMRS</inertia-link>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="nav-item dropdown">
          <inertia-link href="#" class="nav-link has-dropdown"
            ><i class="fas fa-fire"></i><span>Dashboard</span></inertia-link
          >
          <ul class="dropdown-menu">
            <li class="">
              <inertia-link class="nav-link" href="/dashboard"
                >General Dashboard</inertia-link
              >
            </li>
          </ul>
        </li>
        <li class="menu-header">Master Data</li>
        <li class="nav-item dropdown">
          <a href="#" class="nav-link has-dropdown"
            ><i class="fas fa-fire"></i><span>Master</span></a
          >
          <ul class="dropdown-menu">
            <li :class="{ active: $page.component.startsWith('Speciality') }">
              <inertia-link
                class="nav-link"
                :href="this.route('speciality.index')"
                >Data Spesialis</inertia-link
              >
            </li>
            <li :class="{ active: $page.component.startsWith('Facility') }">
              <inertia-link
                class="nav-link"
                :href="this.route('facility.index')"
                >Data Fasilitas</inertia-link
              >
            </li>

            <li :class="{ active: $page.component.startsWith('Gallery') }">
              <inertia-link class="nav-link" :href="this.route('gallery.index')"
                >Data Galeri</inertia-link
              >
            </li>
            <li :class="{ active: $page.component.startsWith('Mitra') }">
              <inertia-link class="nav-link" :href="this.route('mitra.index')"
                >Data Mitra</inertia-link
              >
            </li>
            <li :class="{ active: $page.component.startsWith('Duty') }">
              <inertia-link class="nav-link" :href="this.route('duty.index')"
                >Data Kewajiban Pasien</inertia-link
              >
            </li>
            <li :class="{ active: $page.component.startsWith('Right') }">
              <inertia-link class="nav-link" :href="this.route('right.index')"
                >Data Hak Pasien</inertia-link
              >
            </li>
            <li :class="{ active: $page.component.startsWith('Video') }">
              <inertia-link class="nav-link" :href="this.route('video.index')"
                >Data Video</inertia-link
              >
            </li>
          </ul>
        </li>

        <li :class="{ active: $page.component.startsWith('Doctor') }">
          <inertia-link class="nav-link" :href="this.route('doctor.index')"
            ><i class="far fa-user"></i><span>Data Dokter</span></inertia-link
          >
        </li>
        <li :class="{ active: $page.component.startsWith('User') }">
          <inertia-link class="nav-link" :href="this.route('user.index')"
            ><i class="far fa-user"></i><span>Data User</span></inertia-link
          >
        </li>

        <li class="">
          <inertia-link class="nav-link" href="blank.html"
            ><i class="far fa-envelope"></i
            ><span>Data Pesan</span></inertia-link
          >
        </li>

        <li class="">
          <inertia-link class="nav-link" href="blank.html"
            ><i class="fas fa-exclamation"></i
            ><span>Laporan Permintaan</span></inertia-link
          >
        </li>

        <li class="menu-header">Data Berita</li>
        <li class="nav-item dropdown">
          <inertia-link href="#" class="nav-link has-dropdown"
            ><i class="fas fa-fire"></i><span>Berita</span></inertia-link
          >
          <ul class="dropdown-menu">
            <li :class="{ active: $page.component.startsWith('Post') }">
              <inertia-link class="nav-link" :href="this.route('post.index')"
                >Berita</inertia-link
              >
            </li>
            <li :class="{ active: $page.component.startsWith('Category') }">
              <inertia-link
                class="nav-link"
                preserve-state
                :href="this.route('category.index')"
                >Kategori</inertia-link
              >
            </li>
          </ul>
        </li>
      </ul>

      <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
        <inertia-link
          href="https://getstisla.com/docs"
          class="btn btn-primary btn-lg btn-block btn-icon-split"
        >
          <i class="fas fa-rocket"></i> Documentation
        </inertia-link>
      </div>
    </aside>
  </div>
</template>