<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">LaraVue</a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a
              class="nav-link"
              aria-current="page"
              :class="menu == 'home' ? 'active' : ''"
              :href="homelink"
              >Home</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Add</a>
          </li>
          <!-- <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="navbarDropdown"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              Dropdown
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider" /></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li> -->
        </ul>
        <div v-if="!login" class="d-flex">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a
                :href="regilink"
                :class="menu == 'register' ? 'active' : ''"
                class="nav-link"
                >Register</a
              >
            </li>
            <li class="nav-item">
              <a
                :href="logilink"
                :class="menu == 'login' ? 'active' : ''"
                class="nav-link"
                >Log In</a
              >
            </li>
          </ul>
          <!-- <button class="btn btn-primary">Register</button> -->
        </div>
        <div v-if="login" class="d-flex">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a @click.prevent class="nav-link">{{ user.name }}</a>
            </li>
          </ul>
        </div>
        <div v-if="login" class="d-flex">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="#" @click.prevent="logout()" class="nav-link">Log Out</a>
            </li>
          </ul>
          <!-- <button class="btn btn-primary">Register</button> -->
        </div>
        <!-- <form class="d-flex">
          <input
            class="form-control me-2"
            type="search"
            placeholder="Search"
            aria-label="Search"
          />
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form> -->
      </div>
    </div>
  </nav>
</template>
<script>
export default {
  data() {
    return {
      login: false,
      user: [],
    };
  },
  props: ["homelink", "regilink", "logilink", "menu"],
  created() {
    this.checkSession();
  },
  methods: {
    checkSession() {
      if (this.$session.has("user")) {
        this.login = true;
        this.user = this.$session.get("user");
      }
    },
    logout() {
      axios.post("http://localhost/fresh-app/api/del_token", this.user.id);
      this.$session.clear();
      window.location.reload();
    },
  },
};
</script>