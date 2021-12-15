<template>
  <section class="section">
    <div class="section-header">
      <inertia-link :href="this.route('user.index')">
        <h1>User</h1>
      </inertia-link>
    </div>
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Update User</h4>
            </div>
            <div class="card-body">
              <form
                @submit.prevent="
                  form.post(this.route('user.update', user.id), form)
                "
                enctype="multipart/form-data"
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
                    @input="form.avatar = src"
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
                  <label>Email</label>
                  <input
                    name="email"
                    type="email"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.email }"
                    v-model="form.email"
                    required=""
                  />
                  <div v-if="form.errors.email" class="invalid-feedback">
                    {{ form.errors.email }}
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
  props: {
    user: Object,
    value: File,
  },
  data() {
    return {
      src: this.form.avatar,
    };
  },
  setup(props) {
    const { user } = props;
    const form = useForm({
      name: user.name,
      email: user.email,
      avatar: user.avatar,
    });

    return { form };
  },
  methods: {
    browse() {
      this.$refs.file.click();
    },
    change(e) {
      let reader = new FileReader();
      this.form.avatar = e.target.files[0];
      reader.readAsDataURL(e.target.files[0]);
      reader.onload = (e) => {
        this.src = e.target.result;
      };
    },
  },
};
</script>
