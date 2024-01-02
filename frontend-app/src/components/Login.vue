<template>
    <div class="container">
      <div id="intro">
        <h1><br /><br /></h1>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-md-8">
              <form class="border shadow-5-strong p-5" @submit.prevent="login">
                <div>
                  <h2 class="text-center">
                    Login Form<br /><br />
                  </h2>
                </div>
  
                <!-- Email -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="email">Email address</label>
                  <input type="text" class="form-control" v-model="user.email" id="email">
                </div>
  
                <!-- Password -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="password"> Password </label>
                  <input type="password" class="form-control" v-model="user.password" id="password">
                </div>
  
                <!-- Submit -->
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>

                <div class="row mt-1 mb-1">
                  <div class="col text-center">
                      <router-link to="/register">Belum Punya Akun? Klik Untuk Register</router-link>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'redaxios';
  
  export default {
    data() {
      return {
        user: {
          'email': '',
          'password': '',
        },
      };
    },
  
    methods: {
      login() {
        var url = 'http://127.0.0.1:8000/api/login';
        axios.post(url, this.user)
          .then(response => {
            console.log(response.data);
            if (response.data.token) {
              localStorage.setItem('token', response.data.token);
              this.$router.push({ name: 'HomePage' });
            } else {
              console.log('Login failed: Invalid credentials');
            }
          })
          .catch(error => {
            console.error('Error during login:', error);
            console.log('Login failed: Server error');
          });
      },
    },
  };
  </script>
  