<template>
  <div class="container my-4">
    <div class="container-fluid">
      <div class="row">
        <div class="card mx-auto" style="width: 50rem">
          <div class="card-header"><h3>Register</h3></div>
          <div class="card-body">
            <div class="row">
              <form
                @submit.prevent=""
                class="row my-4 needs-validation"
                novalidate
              >
                <!-- <input type="hidden" name="_token" /> -->
                <div class="col-6 mb-3">
                  <label class="form-lable">Name</label>
                  <input
                    type="text"
                    v-model="userData.name"
                    class="form-control"
                    required
                  />
                  <div class="text-danger">{{ userErr.name }}</div>
                </div>
                <div class="col-6 mb-3">
                  <label class="form-lable">Email</label>
                  <input
                    type="email"
                    v-model="userData.email"
                    class="form-control"
                    required
                  />
                  <div class="text-danger">{{ userErr.email }}</div>
                </div>
                <div class="col-6 mb-3">
                  <label class="form-lable">Password</label>
                  <input
                    type="password"
                    v-model="userData.password"
                    class="form-control"
                    required
                  />
                  <div class="text-danger">{{ userErr.password }}</div>
                </div>
                <div class="col-6 mb-3">
                  <label class="form-lable">Confirm Password</label>
                  <input
                    type="password"
                    v-model="userData.password_confirmation"
                    class="form-control"
                    required
                  />
                  <div class="text-danger">
                    {{ userErr.password_confirmation }}
                  </div>
                </div>
                <div class="col-12">{{ msg }}</div>
                <div class="col-12">
                  <button
                    @click="register()"
                    type="submit"
                    class="btn btn-primary"
                  >
                    Submit
                  </button>
                  <button @click="reset()" class="btn btn-secondary">
                    Reset
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  // props: ["csrf_token"],
  data() {
    return {
      userData: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
      userErr: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
      // login: false,
      msg: "",
    };
  },
  created() {
    this.getToken();
  },
  methods: {
    register() {
      this.getToken();
      axios
        .post("http://localhost/fresh-app/api/register", this.userData)
        .then((res) => res)
        .then((res) => {
          var datal = res.data;
          if (datal.status) {
            this.$session.start();
            this.$session.clear();
            this.$session.set("user", datal.user);
            this.$session.set("access_token", datal.access_token);
            this.reset();
            alert(datal.message);
            window.location.reload();
          } else {
            this.userErr.name = datal.errors.name ? datal.errors.name[0] : "";
            this.userErr.email = datal.errors.email
              ? datal.errors.email[0]
              : "";
            this.userErr.password = datal.errors.password
              ? datal.errors.password[0]
              : "";
            this.userErr.password_confirmation = datal.errors
              .password_confirmation
              ? datal.errors.password_confirmation[0]
              : "";
          }
        })
        .catch((error) => console.log(error));

      //
    },
    reset() {
      var userData = this.userData;
      userData.name = "";
      userData.email = "";
      userData.password = "";
      userData.password_confirmation = "";
      // this.msg = "";
    },
    getToken() {
      axios.get("http://localhost/fresh-app/sanctum/csrf-cookie");
    },
  },
};
</script>