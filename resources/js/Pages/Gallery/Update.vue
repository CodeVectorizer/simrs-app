



<template>
  <section class="section">
    <div class="section-header">
      <inertia-link :href="this.route('gallery.index')">
        <h1>Gallery</h1>
      </inertia-link>
    </div>
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Tambah Gallery</h4>
            </div>
            <div class="card-body">
              <form
                @submit.prevent="
                  form.post(this.route('gallery.update', gallery.id), form)
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
    gallery: Object,
    value: File,
  },

  data() {
    return {
      src: this.form.image,
    };
  },
  //End Upload
  setup(props) {
    const { gallery } = props;

    const form = useForm({
      description: gallery.description,
      image: gallery.image,
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
