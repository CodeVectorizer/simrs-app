



<template>
  <section class="section">
    <div class="section-header">
      <inertia-link :href="this.route('information.index')">
        <h1>Informasi Umum</h1>
      </inertia-link>
    </div>
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Update Information</h4>
            </div>
            <div class="card-body">
              <div v-if="$page.props.flash.message" class="alert alert-success">
                {{ $page.props.flash.message }}
              </div>
              <form
                @submit.prevent="
                  form.post(
                    this.route('information.update', information.id),
                    form
                  )
                "
              >
                <div class="mb-3 form-group">
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
                      style="width: 100%; height: auto; object-fit: cover"
                      src="/assets/img/news/img01.jpg"
                      alt="Default Image"
                    />
                  </div>
                  <div v-else>
                    <img
                      class="mb-3"
                      style="width: 100%; height: auto"
                      :src="src"
                      alt="Image"
                    />
                  </div>
                  <input
                    type="file"
                    accept="image/"
                    @input="form.image = $event.target.files[0]"
                    ref="file"
                    hidden
                    @change="change"
                  />
                  <div v-if="form.errors.image" class="invalid-feedback">
                    {{ form.errors.image }}
                  </div>
                  <button @click="browse" type="button" class="btn btn-primary">
                    Browse
                  </button>
                </div>
                <div class="form-group">
                  <label>Nama RS</label
                  ><input
                    name="name"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.name }"
                    v-model="form.name"
                    required=""
                    type="text"
                  />
                  <div v-if="form.errors.name" class="invalid-feedback">
                    {{ form.errors.name }}
                  </div>
                </div>
                <div class="form-group">
                  <label>Lokasi (Embed Google Maps)</label
                  ><input
                    name="location"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.location }"
                    v-model="form.location"
                    required=""
                    type="text"
                  />
                  <div v-if="form.errors.location" class="invalid-feedback">
                    {{ form.errors.location }}
                  </div>
                </div>
                <div class="form-group">
                  <label>Email</label
                  ><input
                    name="email"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.email }"
                    v-model="form.email"
                    required=""
                    type="text"
                  />
                  <div v-if="form.errors.email" class="invalid-feedback">
                    {{ form.errors.email }}
                  </div>
                </div>
                <div class="form-group">
                  <label>Call Center</label
                  ><input
                    name="number_phone"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.number_phone }"
                    v-model="form.number_phone"
                    required=""
                    type="text"
                  />
                  <div v-if="form.errors.number_phone" class="invalid-feedback">
                    {{ form.errors.number_phone }}
                  </div>
                </div>
                <div class="form-group">
                  <label>Alamat</label
                  ><input
                    name="address"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.address }"
                    v-model="form.address"
                    required=""
                    type="text"
                  />
                  <div v-if="form.errors.address" class="invalid-feedback">
                    {{ form.errors.address }}
                  </div>
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea
                    style="height: 200px"
                    name="description"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.description }"
                    v-model="form.description"
                    required=""
                    rows="50"
                  >
                  </textarea>
                  <div v-if="form.errors.description" class="invalid-feedback">
                    {{ form.errors.description }}
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
import MasterLayout from "@/Layouts/Master";
import { useForm } from "@inertiajs/inertia-vue3";
export default {
  layout: MasterLayout,
  //Upload
  props: {
    information: Object,
    value: File,
  },

  data() {
    return {
      src: this.form.image,
    };
  },
  //End Upload
  setup(props) {
    const { information } = props;

    const form = useForm({
      name: information.name,
      location: information.location,
      email: information.email,
      number_phone: information.number_phone,
      address: information.address,
      description: information.description,
      image: information.bg_image,
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
