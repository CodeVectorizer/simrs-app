



<template>
  <section class="section">
    <div class="section-header">
      <inertia-link :href="this.route('post.index')">
        <h1>Berita</h1>
      </inertia-link>
    </div>
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Update Berita</h4>
            </div>
            <div class="card-body">
              <form
                @submit.prevent="
                  form.post(this.route('post.update', post.id), form)
                "
              >
                <div class="mb-3 form-group"></div>

                <div class="form-group">
                  <label>Title</label>
                  <input
                    name="title"
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.title }"
                    v-model="form.title"
                    required=""
                  />
                  <div v-if="form.errors.title" class="invalid-feedback">
                    {{ form.errors.title }}
                  </div>
                </div>
                <div class="form-group">
                  <label>Thumbnail</label>
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
                      style="width: 400px; height: 400px; object-fit: cover"
                      src="/assets/img/avatar/avatar-1.png"
                      alt="Default Thumbnail"
                    />
                  </div>
                  <div v-else>
                    <img
                      class="mb-3"
                      style="width: 400px"
                      :src="src"
                      alt="Thumbnail"
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
                  <label>Title</label>
                  <editor
                    v-model="form.content"
                    api-key="ee9xzd5b205syj9tbyjcf5atfwoiey89bvzhnz2uwev27pqm"
                    :init="{
                      height: 400,
                      menubar: false,
                      plugins: 'lists link image emoticons',
                      toolbar:
                        'styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image emoticons',
                    }"
                  />
                  <div v-if="form.errors.title" class="invalid-feedback">
                    {{ form.errors.title }}
                  </div>
                </div>
                <div class="form-group">
                  <label>Category</label>
                  <select
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.category }"
                    name=""
                    v-model="form.category_id"
                    required
                    id=""
                  >
                    <option
                      v-for="category in categories"
                      :key="category.id"
                      :value="category.id"
                    >
                      {{ category.category }}
                    </option>
                    >
                  </select>
                  <div v-if="form.errors.category" class="invalid-feedback">
                    {{ form.errors.category }}
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
    post: Object,
    categories: Object,
  },
  components: {
    Editor,
  },
  data() {
    return {
      src: this.form.image,
    };
  },
  //End Upload
  setup(props) {
    const { post } = props;

    const form = useForm({
      title: post.title,
      content: post.content,
      image: post.image,
      category_id: post.category_id,
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

