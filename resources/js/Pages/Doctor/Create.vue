<template>
  <section class="section">
    <div class="section-header">
      <inertia-link :href="this.route('post.index')">
        <h1>Dokter</h1>
      </inertia-link>
    </div>
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Tambah Dokter</h4>
            </div>
            <div class="card-body">
              <form @submit.prevent="form.post(this.route('doctor.store'))">
                <div class="mb-3 form-group"></div>

                <div class="form-group">
                  <label>Name</label>
                  <input
                    name="name"
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.name }"
                    v-model="form.name"
                    required=""
                  />
                  <div v-if="form.errors.name" class="invalid-feedback">
                    {{ form.errors.name }}
                  </div>
                </div>
                <div class="form-group">
                  <label>Tentang Dokter</label>
                  <input
                    name="description"
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.description }"
                    v-model="form.description"
                    required=""
                  />
                  <div v-if="form.errors.description" class="invalid-feedback">
                    {{ form.errors.description }}
                  </div>
                </div>
                <div class="form-group">
                  <label>Avatar</label>
                  <progress
                    v-if="form.progress"
                    :value="form.progress.percentage"
                    max="100"
                  >
                    {{ form.progress.percentage }}%
                  </progress>
                  <div v-if="!src">
                    <img
                      class="mb-3"
                      style="width: 200px; height: 200px; object-fit: cover"
                      src="/assets/img/avatar/avatar-1.png"
                      alt="Default Avatar"
                    />
                  </div>
                  <div v-else>
                    <img
                      class="mb-3"
                      style="width: 200px"
                      :src="src"
                      alt="Avatar"
                    />
                  </div>
                  <input
                    type="file"
                    @input="form.avatar = $event.target.files[0]"
                    ref="file"
                    hidden
                    @change="change"
                  />
                  <div v-if="form.errors.avatar" class="invalid-feedback">
                    {{ form.errors.avatar }}
                  </div>
                  <button @click="browse" type="button" class="btn btn-primary">
                    Browse
                  </button>
                </div>

                <div class="form-group">
                  <label>Spesialis</label>
                  <select
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.speciality }"
                    name=""
                    v-model="form.speciality_id"
                    required
                    id=""
                  >
                    <option
                      v-for="speciality in specialities"
                      :key="speciality.id"
                      :value="speciality.id"
                    >
                      {{ speciality.speciality }}
                    </option>
                    >
                  </select>
                  <div v-if="form.errors.speciality" class="invalid-feedback">
                    {{ form.errors.speciality }}
                  </div>
                </div>
                <div class="form-group">
                  <label>Minggu</label>
                  <input
                    name="name"
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.sunday }"
                    v-model="form.sunday"
                    required=""
                  />
                  <div v-if="form.errors.sunday" class="invalid-feedback">
                    {{ form.errors.sunday }}
                  </div>
                </div>
                <div class="form-group">
                  <label>Senin</label>
                  <input
                    name="name"
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.monday }"
                    v-model="form.monday"
                    required=""
                  />
                  <div v-if="form.errors.monday" class="invalid-feedback">
                    {{ form.errors.monday }}
                  </div>
                </div>
                <div class="form-group">
                  <label>Selasa</label>
                  <input
                    name="name"
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.tuesday }"
                    v-model="form.tuesday"
                    required=""
                  />
                  <div v-if="form.errors.tuesday" class="invalid-feedback">
                    {{ form.errors.tuesday }}
                  </div>
                </div>
                <div class="form-group">
                  <label>Rabu</label>
                  <input
                    name="name"
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.wednesday }"
                    v-model="form.wednesday"
                    required=""
                  />
                  <div v-if="form.errors.name" wednesdaylass="invalid-feedback">
                    {{ form.errors.wednesday }}
                  </div>
                </div>
                <div class="form-group">
                  <label>Kamis</label>
                  <input
                    name="name"
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.thursday }"
                    v-model="form.thursday"
                    required=""
                  />
                  <div v-if="form.errors.thursday" class="invalid-feedback">
                    {{ form.errors.thursday }}
                  </div>
                </div>
                <div class="form-group">
                  <label>Jumat</label>
                  <input
                    name="name"
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.friday }"
                    v-model="form.friday"
                    required=""
                  />
                  <div v-if="form.errors.friday" class="invalid-feedback">
                    {{ form.errors.friday }}
                  </div>
                </div>
                <div class="form-group">
                  <label>Sabtu</label>
                  <input
                    name="name"
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.saturday }"
                    v-model="form.saturday"
                    required=""
                  />
                  <div v-if="form.errors.saturday" class="invalid-feedback">
                    {{ form.errors.saturday }}
                  </div>
                </div>
                <div class="mt-3">
                  <button
                    class="btn btn-primary"
                    :disabled="form.processing"
                    type="submit"
                  >
                    Submit
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import Editor from "@tinymce/tinymce-vue";
import MasterLayout from "@/Layouts/Master";
import { useForm } from "@inertiajs/inertia-vue3";
export default {
  layout: MasterLayout,
  //Upload
  props: {
    value: File,
    specialities: Object,
  },
  components: {
    Editor,
  },
  data() {
    return {
      src: null,
    };
  },
  //End Upload
  setup() {
    const form = useForm({
      name: "",
      description: "",
      sunday: "",
      monday: "",
      tuesday: "",
      wednesday: "",
      thursday: "",
      friday: "",
      saturday: "",
      avatar: null,
      speciality_id: null,
    });

    return { form };
  },
  methods: {
    //Upload
    browse() {
      this.$refs.file.click();
    },
    change(e) {
      console.log(e);
      let reader = new FileReader();
      reader.readAsDataURL(e.target.files[0]);
      reader.onload = (e) => {
        this.src = e.target.result;
      };
    },
    //End Upload
  },
};
</script>
