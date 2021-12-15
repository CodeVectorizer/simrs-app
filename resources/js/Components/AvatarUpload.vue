
<template>
  <div class="mb-3 form-group">
    <div v-if="!src">
      <img
        class="mb-3"
        style="width: 200px; height: 200px; object-fit: cover"
        src="/assets/img/avatar/avatar-1.png"
        alt="Default Avatar"
      />
    </div>
    <div v-else>
      <img class="mb-3" style="width: 200px" :src="src" alt="Avatar" />
    </div>
    <input type="file" accept="image/" ref="file" hidden @change="change" />
    <button @click="browse" type="button" class="btn btn-primary">
      Browse
    </button>
  </div>
</template>
<script>
export default {
  props: {
    value: File,
  },
  data() {
    return {
      src: null,
    };
  },
  methods: {
    browse() {
      this.$refs.file.click();
    },
    change(e) {
      this.$emit("input", e.target.files[0]);
      this.$refs.file.value = e.target.files[0];
      let reader = new FileReader();
      reader.readAsDataURL(e.target.files[0]);
      reader.onload = (e) => {
        this.src = e.target.result;
      };
    },
  },
};
</script>