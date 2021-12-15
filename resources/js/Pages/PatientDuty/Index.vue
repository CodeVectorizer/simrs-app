<template>
  <section class="section">
    <div class="section-header">
      <inertia-link :href="this.route('duty.index')">
        <h1>Kewajiban Pasien</h1>
      </inertia-link>
    </div>
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Kewajiban Pasien</h4>
              <div class="card-header-form mr-2">
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
                <button class="btn btn-sm btn-primary" @click="openModal()">
                  Tambah Data
                </button>
              </div>
            </div>
            <div class="card-body">
              <div v-if="$page.props.flash.message" class="alert alert-primary">
                {{ $page.props.flash.message }}
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Kewajiban Pasien</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(row, index) in patientduties.data"
                      :key="row.id"
                    >
                      <td>{{ index + 1 }}</td>
                      <td>{{ row.patient_duty }}</td>
                      <td>
                        <button @click="edit(row)" class="btn btn-success mr-1">
                          <i class="fas fa-edit"></i>
                        </button>
                        <button
                          @click.prevent="deleteRow(row.id)"
                          class="btn btn-danger"
                        >
                          <i class="fas fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <pagination class="mt-6" :links="patientduties.links" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="modal" id="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" v-html="modalTitle"></h4>
        </div>
        <div>
          <div class="modal-body">
            <div class="form-group">
              <label for="duty">Kewajiban Pasien</label>
              <input
                class="form-control"
                v-model="form.patient_duty"
                required
                id="duty"
              />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" @click="closeModal()">
              Close
            </button>
            <button
              type="submit"
              class="btn btn-primary"
              v-show="!editMode"
              @click="save(form)"
            >
              Save
            </button>
            <button
              type="submit"
              class="btn btn-primary"
              v-show="editMode"
              @click="update(form)"
            >
              Update
            </button>
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
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
    patientduties: Object,
  },
  data() {
    return {
      editMode: false,
      modalTitle: "Tambah Data",
      form: {
        patient_duty: null,
      },
      params: {
        search: null,
      },
    };
  },
  methods: {
    openModal: function () {
      this.reset();
      this.editMode = false;
      this.modalTitle = "Tambah Data";
      $("#modal").modal("show");
    },
    closeModal: function () {
      $("#modal").modal("hide");
    },
    reset: function () {
      this.form = {
        patient_duty: null,
      };
    },
    save: function (data) {
      this.$inertia.post(this.route("duty.store"), data);
      this.editMode = false;
      this.reset();
      this.closeModal();
    },
    edit: function (data) {
      this.openModal();
      this.editMode = true;
      this.form = Object.assign({}, data);
      this.modalTitle = "Update Data";
    },
    update: function (data) {
      this.$inertia.patch(this.route("duty.update", { id: data.id }), data);
      this.reset();
      this.closeModal();
    },
    deleteRow(data) {
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
          this.$inertia.delete("/duty/" + data);
          this.$swal("Deleted!", "Your file has been deleted.", "success");
        }
      });
    },
  },
  watch: {
    // Event Listener ketika value object param terjadi perubahan
    params: {
      handler() {
        this.$inertia.get(this.route("duty.index"), this.params, {
          replace: true,
          preserveState: true,
        });
      },
      deep: true,
    },
  },
};
</script>