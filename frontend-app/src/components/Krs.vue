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
                        <router-link to="/detilkrs" class="nav-link">
                        Data Detail KRS
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/mahasiswa" class="nav-link">
                        Data Mahasiswa
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/matakuliah" class="nav-link">
                        Data Matakuliah
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/agama" class="nav-link">
                        Data Agama Mahasiswa
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/krs" class="nav-link">
                        Data KRS 
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" @click="logout">
                            Logout
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
    <!-- Akhir Sidebar -->

        <div class="custom-container">
        <h2 class="text-center">FORM KRS</h2>
        <form @submit.prevent="simpan()">
            <div class="row justify-content-center">
            <div class="mb-3 form-group col-10">
                <label>Tahun</label>
                <input type="text" class="form-control" v-model="krs.tahun">
            </div>
            <div class="mb-3 form-group col-10">
                <label>Semester</label>
                <input type="text" class="form-control" v-model="krs.semester">
            </div>
            <div class="mb-3 form-group col-10">
                <div class="btn-group mb-3 col-3">
                <button type="submit" class="btn btn-primary">SIMPAN</button>
                <button type="button" class="btn btn-warning" @click="clear()">CLEAR</button>
                </div>
            </div>
            </div>
        </form>
    
        <h3 style="text-align: center;">TABEL KRS</h3>
        <div class="row justify-content-center">
            <div class="col-10">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Tahun</th>
                    <th class="text-center">Semester</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(krs, index) in allkrs" :key="krs.id">
                    <td class="text-center">{{ krs.id }}</td>
                    <td class="text-center">{{ krs.tahun }}</td>
                    <td class="text-center">{{ krs.semester }}</td>
                    <td class="text-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning" @click="edit(krs)">EDIT</button>
                        <button type="button" class="btn btn-danger" @click="remove(krs)">DELETE</button>
                    </div>
                    </td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</template>
    
<script>
    import axios from 'redaxios';
    
    export default {
        name: 'krs',
        data() {
        return {
            allkrs: [],
            krs: {
            'id': '',
            'tahun': '',
            'semester': '',
            },
        };
        },
    
        created() {
        console.log('Created!');
        this.loadallkrs();
        },
    
        methods: {
        loadallkrs() {
            var url = 'http://127.0.0.1:8000/api/krs';
            var token = localStorage.getItem('token');
            var header = {'Authorization': 'Bearer ' + token};
            axios.get(url, { headers: header }).then(({ data }) => {
            this.allkrs = data;
            });
        },
    
        remove(krs) {
            var url = `http://127.0.0.1:8000/api/krs/${krs.id}`;
            var token = localStorage.getItem('token');
            var header = {'Authorization': 'Bearer ' + token};
            axios.delete(url, { headers: header }).then(() => {
            console.log('Berhasil dihapus!');
            this.loadallkrs(); // perbaruin data
            }).catch((error) => {
            console.error('Gagal menghapus:', error);
            });
        },
    
        edit(krs) {
            var url = `http://127.0.0.1:8000/api/krs/${krs.id}`;
            var token = localStorage.getItem('token');
            var header = {'Authorization': 'Bearer ' + token};
            axios.get(url, { headers: header }).then(({ data }) => {
            this.krs = data;
            console.log(this.krs);
            });
        },
    
        simpan() {
            var token = localStorage.getItem('token');
            var header = {'Authorization': 'Bearer ' + token};
            if (this.krs.id === '') {
            var url = 'http://127.0.0.1:8000/api/krs';
            axios.post(url, this.krs, { headers: header }).then(() => {
                console.log('Berhasil disimpan!');
                this.loadallkrs(); // reload data setelah simpan
                this.clear();
            }).catch((error) => {
                console.error('Gagal menyimpan:', error);
            });
            } else {
            // Edit
            var url = `http://127.0.0.1:8000/api/krs/${this.krs.id}`;
            axios.put(url, this.krs, { headers: header }).then(() => {
                console.log('Berhasil di edit');
                this.loadallkrs(); // reload data setelah edit
                this.clear();
            });
            }
        },

        logout() {
            var url = 'http://127.0.0.1:8000/api/logout';
            var token = localStorage.getItem('token');
            var header = {'Authorization': 'Bearer ' + token};

            axios.post(url, null, { headers: header }).then(() => {
                console.log('Logout successful!');
                this.$router.push('/');
            }).catch((error) => {
                console.error('Failed to logout:', error);
            });
        },
    
        clear() {
            this.krs.id = '';
            this.krs.tahun = '';
            this.krs.semester = '';
        }
        }
    };
</script>
    
<style>
        .custom-container {
        margin-left: 5cm; 
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
</style>
    