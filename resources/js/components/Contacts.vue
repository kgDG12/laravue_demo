<template>
  <div class="container my-4">
    <div class="container">
      <div class="container-fluid">
        <div class="d-flex">
          <button
            v-if="login"
            class=""
            v-bind:class="btn.cls"
            @click="toggle()"
          >
            {{ btn.txt }} Form
          </button>
          <form @submit.prevent="" class="d-flex ms-auto">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Search"
              aria-label="Search"
              v-model="searchStr"
              @keyup="search(searchStr)"
            />
            <button
              @click="search(searchStr)"
              class="btn btn-outline-success"
              type="submit"
            >
              Search
            </button>
          </form>
        </div>
        <!-- form -->
        <div class="container-fluid w-75">
          <div class="row" v-if="addForm">
            <div class="col-12 text-center mb-4">
              <h2>Add Contact</h2>
            </div>
            <div class="col-12 text-center">
              <div class="row">
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
                    <div class="text-danger">{{ contErr.name }}</div>
                  </div>
                  <div class="col">
                    <label class="form-label">Email</label>
                    <input
                      v-model="cont.email"
                      type="email"
                      class="form-control"
                      required
                    />
                    <div class="text-danger">{{ contErr.email }}</div>
                  </div>
                  <div class="col">
                    <label class="form-label">Phone</label>
                    <input
                      v-model="cont.phone"
                      type="text"
                      class="form-control"
                      required
                    />
                    <div class="text-danger">{{ contErr.phone }}</div>
                  </div>
                  <div class="col-12 text-center">
                    <button
                      v-if="!edit"
                      class="btn btn-primary"
                      @click="addContact()"
                      type="submit"
                    >
                      Add Contact
                    </button>
                    <button
                      v-if="edit"
                      class="btn btn-success"
                      @click="updContact(cont.id)"
                      type="submit"
                    >
                      Update Contact
                    </button>
                    <button class="btn btn-secondary" @click="reset()">
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

    <!-- listing Contacts -->
    <div class="container">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 text-center mb-4">
            <h2>Contacts</h2>
          </div>
          <div class="col-12">
            <div class="row">
              <div v-for="cont in data" :key="cont.id" class="col-4 mb-4">
                <div class="card text-white border-secondary">
                  <div class="card-header bg-dark">
                    <h5 class="card-title">{{ cont.name }}</h5>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h6 class="card-subtitle mb-2 text-muted">
                          Email: {{ cont.email }}
                        </h6>
                        <h6 class="card-subtitle mb-2 text-muted">
                          Phone: {{ cont.phone }}
                        </h6>
                      </div>
                      <div v-if="login" class="col-4">
                        <button
                          @click="editContact(cont.id)"
                          class="btn btn-sm btn-success"
                        >
                          Edit
                        </button>
                        <button
                          @click="deleteContact(cont.id)"
                          class="btn btn-sm btn-danger"
                        >
                          Delete
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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
      login: false,
      headers: [],
      data: [],
      status: "",
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
      },
      contErr: {
        name: "",
        email: "",
        phone: "",
      },
      edit: false,
      editbtn: "btn btn-success",
      searchStr: "",
    };
  },
  created() {
    this.getContacts();
    this.getAccessToken();
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
      const headers = {
        Authorization: "Bearer " + this.$session.get("access_token"),
      };
      axios
        .post("http://localhost/fresh-app/api/add", this.cont, {
          headers: headers,
        })
        .then((res) => res)
        .then((res) => {
          if (res.data.status) {
            this.contErr.name = "";
            this.contErr.email = "";
            this.contErr.phone = "";
            this.cont.name = "";
            this.cont.email = "";
            this.cont.phone = "";
            alert(res.data.message);
            this.getContacts();
          } else {
            this.contErr.name = res.data.errors.name
              ? res.data.errors.name[0]
              : "";
            this.contErr.email = res.data.errors.email
              ? res.data.errors.email[0]
              : "";
            this.contErr.phone = res.data.errors.phone
              ? res.data.errors.phone[0]
              : "";
            // console.log(res.data.errors);
          }
        })
        .catch((error) => console.log(error));
    },
    editContact(id) {
      const headers = {
        Authorization: "Bearer " + this.$session.get("access_token"),
      };
      axios
        .get(`http://localhost/fresh-app/api/get/${id}`, {
          headers: headers,
        })
        .then((res) => res)
        .then((res) => {
          var datal = res.data;
          if (datal.status) {
            if (this.addForm === false) {
              this.toggle();
            }
            this.edit = true;
            this.cont.id = datal.data.id;
            this.cont.name = datal.data.name;
            this.cont.email = datal.data.email;
            this.cont.phone = datal.data.phone;
          }
        })
        .catch((error) => console.log(error));
    },
    updContact(id) {
      const headers = {
        Authorization: "Bearer " + this.$session.get("access_token"),
      };
      axios
        .put(`http://localhost/fresh-app/api/upd/${id}`, this.cont, {
          headers: headers,
        })
        .then((res) => res)
        .then((res) => {
          var datal = res.data;
          if (datal.status) {
            alert(datal.message);
            this.reset();
            this.getContacts();
          } else {
            console.log(datal);
            this.contErr.name = datal.errors.name ? datal.errors.name[0] : "";
            this.contErr.email = datal.errors.email
              ? datal.errors.email[0]
              : "";
            this.contErr.phone = datal.errors.phone
              ? datal.errors.phone[0]
              : "";
          }
        })
        .catch((error) => console.log(error));
    },
    getContacts() {
      axios
        .get("http://localhost/fresh-app/api/get/")
        .then((res) => res)
        .then((res) => {
          this.data = res.data.data;
          this.status = res.data.status;
        })
        .catch((error) => console.log(error));
      // .then((res) => console.log((res)));
    },
    deleteContact(id) {
      const headers = {
        Authorization: "Bearer " + this.$session.get("access_token"),
      };
      if (confirm("Are You Sure?")) {
        axios
          .get(`http://localhost/fresh-app/api/del/${id}`, {
            headers: headers,
          })
          .then((res) => res)
          .then((res) => {
            alert(res.data.message);
            this.getContacts();
          })
          .catch((error) => console.log(error));
      }
    },
    search(str) {
      axios
        .get(`http://localhost/fresh-app/api/search/${str}`)
        .then((res) => res)
        .then((res) => {
          var datal = res.data;
          if (datal.status) {
            this.data = datal.data;
            this.status = datal.status;
          } else {
            this.getContacts();
          }
          // console.log(res);
        });
    },
    getAccessToken() {
      if (this.$session.has("user")) {
        this.login = true;
        // this.user = this.$session.get("user");
      }
      if (this.$session.has("access_token")) {
        const headers = {
          Authorization: "Bearer " + this.$session.get("access_token"),
        };
        this.headers = headers;
      }
    },
    reset() {
      this.edit = false;
      this.cont.id = "";
      this.cont.name = "";
      this.cont.email = "";
      this.cont.phone = "";
      this.contErr.name = "";
      this.contErr.email = "";
      this.contErr.phone = "";
    },
  },
};
</script>