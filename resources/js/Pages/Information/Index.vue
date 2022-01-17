<template>
  <section class="section">
    <div class="section-header">
      <inertia-link :href="this.route('facility.index')">
        <h1>Fasilitas</h1>
      </inertia-link>
    </div>
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Table Fasilitas</h4>

              <div class="mr-2 card-header-form">
                <form>
                  <div class="input-group">
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Search"
                      v-model="params.search"
                    />
                    <div class="input-group-btn">
                      <button class="btn btn-primary">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="card-header-action">
                <inertia-link
                  href="facility/create"
                  class="btn btn-primary"
                  as="button"
                  >Tambah Data</inertia-link
                >
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Description</th>
                      <th scope="col">Gambar</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="row in facilities.data" :key="row.id">
                      <td>{{ row.id }}</td>
                      <td>{{ row.description }}</td>
                      <td>
                        <img
                          v-if="row.image"
                          class="mb-3"
                          style="width: 50px; height: 50px; object-fit: cover"
                          :src="row.image"
                          alt="Avatar"
                        />
                        <img
                          v-else
                          class="mb-3"
                          style="width: 50px"
                          src="/assets/img/avatar/avatar-1.png"
                          alt="Avatar"
                        />
                      </td>
                      <td>
                        <inertia-link
                          :href="route('facility.edit', { facility: row.id })"
                          class="mr-2 btn btn-primary"
                          ><i class="fas fa-edit"></i
                        ></inertia-link>
                        <inertia-link
                          href=""
                          @click.prevent="deleteUser(row.id)"
                          class="btn btn-danger"
                          ><i class="fas fa-trash"></i
                        ></inertia-link>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <pagination class="mt-6" :links="facilities.links" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import MasterLayout from "@/Layouts/Master";
import Pagination from "@/Components/Pagination";
export default {
  layout: MasterLayout,
  components: {
    Pagination,
  },
  props: {
    facilities: Object,
  },
  data() {
    return {
      params: {
        search: null,
      },
    };
  },
  methods: {
    deleteUser(id) {
      this.$swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          this.$inertia.delete("facility/" + id);
          this.$swal("Deleted!", "Your file has been deleted.", "success");
        }
      });
    },
  },
  watch: {
    // Event Listener ketika value object param terjadi perubahan
    params: {
      handler() {
        this.$inertia.get(this.route("facility.index"), this.params, {
          replace: true,
          preserveState: true,
        });
      },
      deep: true,
    },
  },
};
</script>
