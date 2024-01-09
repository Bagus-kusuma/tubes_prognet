<template>
    <!-- Sidebar -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-lg-2 sidebar bg-dark">
                    <div class="sidebar-sticky">
                        <h5 class="sidebar-heading custom-font d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-white">
                        Dashboard
                        </h5>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <router-link to="/home" class="nav-link">
                                Home
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/agama" class="nav-link">
                                Data Agama Mahasiswa
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/krs" class="nav-link">
                                Data Krs
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/matakuliah" class="nav-link">
                                Data Matakuliah
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/mahasiswa" class="nav-link">
                                Data Mahasiswa
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/detilkrs" class="nav-link">
                                Data Detail Krs 
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link logout" @click="logout">
                                    LOGOUT ]->
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
        
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <router-view></router-view>
                </main>
            </div>
        </div>
        <!-- AkSidebar -->
        
        <div class="welcome-container">
            <h1 class="welcome-text">WELCOME TO SISTEM KRS UDAYANA</h1>
        </div>       
</template>
    
<script>
import axios from 'redaxios';

    export default {
        name: 'HomePage',
    
        methods: {
            logout() {
            var url = 'https://api-group13-prognet.manpits.xyz/api/logout';
            var token = localStorage.getItem('token');
            var header = {'Authorization': 'Bearer ' + token};

            axios.post(url, null, { headers: header }).then(() => {
                console.log('Logout successful!');
                this.$router.push('/');
            }).catch((error) => {
                console.error('Failed to logout:', error);
            });
        },
        }
    };
</script>

<style scoped>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Arial', sans-serif;
        background-color: #000000;
        color: #ffffff;
    }
    
    .welcome-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    
    .welcome-text {
        font-size: 2em;
        text-align: center;
        color: #000000; 
    }
    .custom-font {
        font-family: 'Dashboard', sans-serif;
    }
    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 1000;
        padding: 48px 0 0;
        box-shadow: inset -1px 0 0 rgb(0, 0, 0);
    }
    
    .sidebar-sticky {
        position: relative;
        top: 0;
        height: calc(100vh - 48px);
        padding-top: 20px;
        overflow-x: hidden;
        overflow-y: auto;
    }
    
    .sidebar a {
        display: block;
        padding: 0.5rem 1rem;
        color: #ffffff;
    }
    
    .sidebar a:hover {
        color: #ff0000;
        text-decoration: none;
    }
    
    .navbar {
        z-index: 99;
    }

    .sidebar a {
        display: block;
        padding: 0.5rem 1rem;
        color: #ffffff; /* Warna putih untuk tautan lainnya */
        font-weight: normal;
    }

    .sidebar a.logout {
        color: #ff0000; /* Warna merah untuk tautan "Logout" */
        font-weight: bold;
    }

    .sidebar a:hover,
    .sidebar a:visited {
        text-decoration: none;
    }
</style>