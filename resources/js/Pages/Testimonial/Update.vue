



<template>
  <section class="section">
    <div class="section-header">
      <inertia-link :href="this.route('testimonial.index')">
        <h1>Fasilitas</h1>
      </inertia-link>
    </div>
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Update Fasilitas</h4>
            </div>
            <div class="card-body">
              <form
                @submit.prevent="
                  form.post(
                    this.route('testimonial.update', testimonial.id),
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
                    @input="form.photo = $event.target.files[0]"
                    ref="file"
                    hidden
                    @change="change"
                  />
                  <div v-if="form.errors.photo" class="invalid-feedback">
                    {{ form.errors.photo }}
                  </div>
                  <button @click="browse" type="button" class="btn btn-primary">
                    Browse
                  </button>
                </div>
                <div class="form-group">
                  <label for="">Name</label
                  ><input
                    name="name"
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
                  <label for="">Job</label
                  ><input
                    name="job"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.job }"
                    v-model="form.job"
                    required=""
                  />
                  <div v-if="form.errors.job" class="invalid-feedback">
                    {{ form.errors.job }}
                  </div>
                </div>
                <div class="form-group">
                  <label>Testimonial</label>
                  <textarea
                    style="height: 200px"
                    name="testimonial"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.testimonial }"
                    v-model="form.testimonial"
                    required=""
                    rows="50"
                  >
                  </textarea>
                  <div v-if="form.errors.testimonial" class="invalid-feedback">
                    {{ form.errors.testimonial }}
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
    testimonial: Object,
    value: File,
  },

  data() {
    return {
      src: this.form.image,
    };
  },
  //End Upload
  setup(props) {
    const { testimonial } = props;

    const form = useForm({
      name: testimonial.name,
      testimonial: testimonial.testimonial,
      photo: testimonial.photo,
      job: testimonial.job,
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
