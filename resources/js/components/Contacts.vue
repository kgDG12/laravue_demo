<template>
  <div class="container">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 text-center mb-4">
          <h2>Contacts</h2>
        </div>
        <div class="col-12">
          <div class="row">
            <div v-for="cont in data" :key="cont.id" class="col-4 mb-4">
              <div class="card">
                <div class="card-header">
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
                    <div class="col-4">
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
</template>
<script>
export default {
  data() {
    return {
      data: [],
      cont: {
        id: "",
        name: "",
        email: "",
        phone: "",
      },
      status: "",
    };
  },
  created() {
    this.getContacts();
  },
  methods: {
    getContacts() {
      fetch("http://localhost/fresh-app/api/get/")
        .then((res) => res.json())
        .then((res) => {
          this.data = res.data;
          this.status = res.status;
        });
    },
    deleteContact(id) {
      if (confirm("Are You Sure?")) {
        fetch(`http://localhost/fresh-app/api/del/${id}`)
          .then((res) => res.json())
          .then((res) => {
            alert(res.message);
            this.getContacts();
          })
          .catch((error) => console.log(error));
      }
    },
  },
};
</script>