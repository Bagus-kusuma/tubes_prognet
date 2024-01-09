<template>
    <div class="container">
        <div id="intro">
            <h1><br /><br /></h1>
            <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-md-8">
                <form class="border shadow-5-strong p-5" @submit.prevent="register">
                    <div>
                    <h2 class="text-center">
                        Register Form<br /><br />
                    </h2>
                    </div>
    
                    <div class="form-outline mb-4">
                    <label class="form-label" for="name">Name</label>
                    <input type="text" class="form-control" v-model="user.name" id="name">
                    </div>
    
                    <div class="form-outline mb-4">
                    <label class="form-label" for="email">Email address</label>
                    <input type="email" class="form-control" v-model="user.email" id="email">
                    </div>
    
                    <div class="form-outline mb-4">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" class="form-control" v-model="user.password" id="password">
                    </div>
    
                    <div class="form-outline mb-4">
                    <label class="form-label" for="confirmPassword">Confirm Password</label>
                    <input type="password" class="form-control" v-model="confirmPassword" id="confirmPassword">
                    </div>
    
                    <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>

                    <div class="row mt-1 mb-1">
                        <div class="col text-center">
                            <router-link to="/">Sudah Punya Akun? Login Disini</router-link>
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
            'name': '',
            'email': '',
            'password': '',
            },
            'confirmPassword': '',
        };
        },
    
        methods: {
        register() {
            if (this.user.password !== this.confirmPassword) {
            console.log('Passwords do not match');
            return;
            }
    
            var url = 'https://api-group13-prognet.manpits.xyz/api/user';
            axios
            .post(url, {
                name: this.user.name,
                email: this.user.email,
                password: this.user.password,
            })
            .then((response) => {
                console.log(response.data);
                if (response.data) {
                console.log('Register Success');
                this.$router.push('/'); 
                } else {
                console.log('Register failed: Invalid credentials');
                }
            })
            .catch((error) => {
                console.error('Error during register:', error);
                console.log('Register failed: Server error');
            });
        },
        },
    };
</script>