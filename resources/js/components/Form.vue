<template>
  <div class="container my-4">
    <div class="container-fluid">
      <button v-bind:class="btn.cls" @click="toggle()">
        {{ btn.txt }} Form
      </button>
      <div class="row" v-if="addForm">
        <div class="col-12 text-center mb-4">
          <h2>Add Contacts</h2>
        </div>
        <div class="col-12 text-center">
          <form
            @submit.prevent=""
            class="row g-3 needs-validation my-4"
            novalidate
          >
            <div class="col">
              <label class="form-label">Name</label>
              <input
                v-model="cont.name"
                type="text"
                class="form-control"
                required
              />
              <div class="valid-feedback">Looks good!</div>
            </div>
            <div class="col">
              <label class="form-label">Email</label>
              <input
                v-model="cont.email"
                type="email"
                class="form-control"
                required
              />
              <div class="valid-feedback">Enter Valid Email</div>
            </div>
            <div class="col">
              <label class="form-label">Phone</label>
              <input
                v-model="cont.phone"
                type="text"
                class="form-control"
                required
              />
              <div class="valid-feedback">Enter Valid Phone Number</div>
            </div>
            <div class="col-12">
              <div class="form-check">
                <label class="form-check-label" for="invalidCheck">
                  <input
                    class="form-check-input me-1"
                    type="checkbox"
                    v-model="cont.checkbox"
                    name="checkbox"
                    value="1"
                    required
                  />
                  Agree to terms and conditions
                </label>
                <div class="valid-feedback">
                  You must agree before submitting.
                </div>
              </div>
            </div>
            <div class="col-12 text-center">
              <button
                class="btn btn-primary"
                @click="addContact()"
                type="submit"
              >
                Add Contact
              </button>
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
      cont: {
        id: "",
        name: "",
        email: "",
        phone: "",
        checkbox: false,
      },
      edit: false,
    };
  },
  methods: {
    toggle() {
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
    addContact() {
      if (this.edit) {
      } else {
        axios
          .post("http://localhost/fresh-app/api/add", this.cont)
          .then((res) => res)
          .then((res) => {
            alert(res.data.message);
          })
          .catch((error) => console.log(error));
      }
    },
  },
};
</script>