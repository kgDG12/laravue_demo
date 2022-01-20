<template>
  <div class="container my-4">
    <div class="container-fluid">
      <div class="row">
        <div class="card mx-auto" style="width: 50rem">
          <div class="card-header"><h3>Login</h3></div>
          <div class="card-body">
            <div class="row">
              <form
                @submit.prevent=""
                class="row my-4 needs-validation"
                novalidate
              >
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
                <div class="col-12">{{ msg }}</div>
                <div class="col-12">
                  <button
                    @click="login()"
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
  data() {
    return {
      userData: {
        email: "",
        password: "",
      },
      userErr: {
        email: "",
        password: "",
      },
      msg: "",
    //   login: false,
    };
  },
  created() {
    this.getToken();
  },
  methods: {
    login() {
      this.getToken();
      axios
        .post("http://localhost/fresh-app/api/login", this.userData)
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
            alert(datal.message);
          }
        });
    },
    reset() {
      var userData = this.userData;
      userData.email = "";
      userData.password = "";
      // this.msg = "";
    },
    getToken() {
      axios.get("http://localhost/fresh-app/sanctum/csrf-cookie");
    },
  },
};
</script>