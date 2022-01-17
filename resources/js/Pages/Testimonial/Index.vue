<template>
  <section class="section">
    <div class="section-header">
      <inertia-link :href="this.route('testimonial.index')">
        <h1>Testimonial</h1>
      </inertia-link>
    </div>
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Table Testimonial</h4>

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
                  href="testimonial/create"
                  class="btn btn-primary"
                  as="button"
                  >Tambah Data</inertia-link
                >
              </div>
            </div>
            <div class="card-body">
              <div v-if="$page.props.flash.message" class="alert alert-success">
                {{ $page.props.flash.message }}
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Pekerjaan</th>
                      <th scope="col">Testimonial</th>
                      <th scope="col">Photo</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="row in testimonials.data" :key="row.id">
                      <td>{{ row.id }}</td>
                      <td>{{ row.name }}</td>
                      <td>{{ row.job }}</td>
                      <td>{{ row.testimonial }}</td>
                      <td>
                        <img
                          v-if="row.photo"
                          class="mb-3"
                          style="width: 50px; height: 50px; object-fit: cover"
                          :src="row.photo"
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
                          :href="
                            route('testimonial.edit', { testimonial: row.id })
                          "
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
                <pagination class="mt-6" :links="testimonials.links" />
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
    testimonials: Object,
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
          this.$inertia.delete("testimonial/" + id);
          this.$swal("Deleted!", "Your file has been deleted.", "success");
        }
      });
    },
  },
  watch: {
    // Event Listener ketika value object param terjadi perubahan
    params: {
      handler() {
        this.$inertia.get(this.route("testimonial.index"), this.params, {
          replace: true,
          preserveState: true,
        });
      },
      deep: true,
    },
  },
};
</script>
