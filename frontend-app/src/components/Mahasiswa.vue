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
                            Data Detil Krs 
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
    <!-- Akhir Sidebar -->

    <div class="custom-container">
        <h2 class="text-center">FORM MAHASISWA</h2>
        <form @submit.prevent="simpan()">
            <div class="row justify-content-center">
                <div class="mb-3 form-group col-10 ">
                    <label>NIM</label>
                    <input type="text" class="form-control" v-model="mahasiswa.nim">
                </div>
                <div class="mb-3 form-group col-10 ">
                    <label>Nama Mahasiswa</label>
                    <input type="text" class="form-control" v-model="mahasiswa.nama">
                </div>
                <div class="mb-3 form-group col-10 ">
                    <label>Alamat</label>
                    <input type="text" class="form-control" v-model="mahasiswa.alamat">
                </div>
                <div class="mb-3 form-group col-10 ">
                    <label>Tanggal Lahir</label>
                    <input type="date" class="form-control" v-model="mahasiswa.lahir">
                </div>
                <div class="mb-3 form-group col-10 ">
                    <label>Agama</label>
                    <select type="text" class="form-control" v-model="mahasiswa.agama_id">
                        <option value=""></option>
                        <option v-for="(agama, index) in allagama" :key="agama.id" :value="agama.id">
                            {{ agama.agama }}
                        </option>
                    </select>
                </div>
                <div class="mb-3 form-group col-10 ">
                    <div class="btn-group mb-3 col-3">
                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                        <button type="button" class="btn btn-warning" @click="clear()">CLEAR</button>
                    </div>
                </div>
            </div>
        </form>
        
        <h3 style="text-align: center;">TABEL Mahasiswa</h3>
        <div class="row justify-content-center">
            <div class="col-10 ">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center">NIM</th>
                            <th class="text-center">Nama Mahasiswa</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center">Tanggal Lahir</th>
                            <th class="text-center">Agama</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(mahasiswa, index) in allmahasiswa" :key="mahasiswa.id">
                            <td class="text-center">{{ index + 1 }}</td>
                            <td class="text-center">{{ mahasiswa.nim }}</td>
                            <td class="text-center">{{ mahasiswa.nama }}</td>
                            <td class="text-center">{{ mahasiswa.alamat }}</td>
                            <td class="text-center">{{ mahasiswa.lahir }}</td>
                            <td class="text-center">{{ getAgama(mahasiswa.agama_id) }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning" @click="edit(mahasiswa)">EDIT</button>
                                    <button type="button" class="btn btn-danger" @click="remove(mahasiswa)">DELETE</button>
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
        name: 'mahasiswa',
        data() {
            return {
            allmahasiswa: [],
            mahasiswa: {
                'id': '',
                'nim': '',
                'nama': '',
                'alamat': '',
                'lahir': '',
                'agama_id': '',
            },
            allagama:[],
            }
        },
    
    created() {
        console.log('Created!');
        this.loadallmahasiswa();
        this.loadallagama();
    },
    
    methods: {
        loadallmahasiswa() {
            var url = 'https://api-group13-prognet.manpits.xyz/api/mahasiswa';
            var token = localStorage.getItem('token');
            var header = {'Authorization': 'Bearer ' + token};
            axios.get(url, { headers: header }).then(({ data }) => {
                this.allmahasiswa = data;
            });
        },
        loadallagama() {
            var url = 'https://api-group13-prognet.manpits.xyz/api/agama';
            var token = localStorage.getItem('token');
            var header = {'Authorization': 'Bearer ' + token};
            axios.get(url, { headers: header }).then(({ data }) => {
                this.allagama = data;
            });
        },

        getAgama(mahasiswa_agama_id) {
            const agama = this.allagama.find(item => item.id === mahasiswa_agama_id);
            return agama ? agama.agama : 'N/A'; // if (agama) {return agama.agama}, elsi f (!agama) {return 'N/A'}
        },

    remove(mahasiswa) {
        var url = `https://api-group13-prognet.manpits.xyz/api/mahasiswa/${mahasiswa.id}`;
        var token = localStorage.getItem('token');
        var header = {'Authorization': 'Bearer ' + token};
        axios.delete(url, { headers: header }).then(() => {
            console.log('Berhasil dihapus!');
            this.loadallmahasiswa(); // perbarui data
        }).catch((error) => {
            console.error('Gagal menghapus:', error);
        });
    },

    edit(mahasiswa) {
        var url = `https://api-group13-prognet.manpits.xyz/api/mahasiswa/${mahasiswa.id}`;
        var token = localStorage.getItem('token');
        var header = {'Authorization': 'Bearer ' + token};
        axios.get(url, { headers: header }).then(({ data }) => {
            console.log(data);
            this.mahasiswa = data;
            console.log(this.mahasiswa);
        });
    },
    
    simpan() {
        var token = localStorage.getItem('token');
        var header = {'Authorization': 'Bearer ' + token};
        if (this.mahasiswa.id === '') {
            var url = 'https://api-group13-prognet.manpits.xyz/api/mahasiswa';
            axios.post(url, this.mahasiswa, { headers: header }).then(() => {
                console.log('Berhasil disimpan!');
                this.loadallmahasiswa(); // reload data setelah simpan
                this.clear();
            }).catch((error) => {
                console.error('Gagal menyimpan:', error);
            });
        } else {
          // Edit
            var url = `https://api-group13-prognet.manpits.xyz/mahasiswa/${this.mahasiswa.id}`;
            axios.put(url, this.mahasiswa, { headers: header }).then(() => {
                console.log('Berhasil di edit');
                this.loadallmahasiswa(); // reload data setelah edit
                this.clear();
            });
        }
    },

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

    clear() {
        this.mahasiswa.id = '';
        this.mahasiswa.nim = '';
        this.mahasiswa.nama = '';
        this.mahasiswa.alamat = '';
        this.mahasiswa.lahir = '';
        this.mahasiswa.agama_id = '';
    }
    }
    }
</script>

<style>
    .custom-container {
    margin-left: 5cm; /* You can adjust this value as needed */
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
        margin-top: 310px;
    }

    .sidebar a:hover,
    .sidebar a:visited {
        text-decoration: none;
    }
</style>