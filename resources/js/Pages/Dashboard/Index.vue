<template>
  <section class="section">
    <div class="section-header">
      <inertia-link :href="this.route('speciality.index')">
        <h1>Spesialis</h1>
      </inertia-link>
    </div>
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Table Spesialis</h4>
              <div class="card-header-action">
                <button class="btn btn-sm btn-primary"></button>
              </div>
            </div>
            <div class="card-body">
              <h1>Selamat Datang, Admin</h1>
              {{ $page.props.auth.user }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- /.modal -->
</template>
<script>
import MasterLayout from "@/Layouts/Master";

export default {
  layout: MasterLayout,
};
</script>