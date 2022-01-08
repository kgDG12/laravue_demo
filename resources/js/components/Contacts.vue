<template>
  <div class="container">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 text-center mb-4">
          <h1>Contacts</h1>
        </div>
        <div class="col-12">
          <div class="row">
            <div v-for="cont in data" :key="cont.id" class="col-4 mb-4">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">{{ cont.name }}</h5>
                </div>
                <div class="card-body">
                  <h6 class="card-subtitle mb-2 text-muted">
                    Email: {{ cont.email }}
                  </h6>
                  <h6 class="card-subtitle mb-2 text-muted">
                    Email: {{ cont.phone }}
                  </h6>
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
        });
    },
  },
};
</script>