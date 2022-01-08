<template>
  <div class="container my-4">
    <div class="container-fluid">
      <button v-bind:class="btn.cls" v-on:click="toggle">
        {{ btn.txt }} Form
      </button>
      <div class="row" v-if="addForm">
        <div class="col-12 text-center mb-4">
          <h2>Add Contacts</h2>
        </div>
        <div class="col-12 text-center">
          <form class="row g-3 needs-validation my-4" novalidate>
            <div class="col">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" required />
              <div class="valid-feedback">Looks good!</div>
            </div>
            <div class="col">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" required />
              <div class="valid-feedback">Enter Valid Email</div>
            </div>
            <div class="col">
              <label class="form-label">Phone</label>
              <input type="text" class="form-control" required />
              <div class="valid-feedback">Enter Valid Phone Number</div>
            </div>
            <div class="col-12 text-center">
              <button class="btn btn-primary" type="submit">Add Contact</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      addForm: false,
      btn: {
        txt: "Open",
        cls: "btn btn-primary",
      },
    };
  },
  methods: {
    toggle: function () {
      if (this.addForm) {
        this.addForm = false;
        this.btn.txt = "Open";
        this.btn.cls = "btn btn-primary";
      } else {
        this.addForm = true;
        this.btn.txt = "Close";
        this.btn.cls = "btn btn-danger";
      }
    },
  },
};
</script>