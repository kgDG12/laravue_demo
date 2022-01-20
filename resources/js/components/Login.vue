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
                    @click="reset()"
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
      login: false,
    };
  },
  created() {},
  methods: {
    reset() {
      var userData = this.userData;
      userData.name = "";
      userData.email = "";
      userData.password = "";
      userData.password_confirmation = "";
      // this.msg = "";
    },
  },
};
</script>