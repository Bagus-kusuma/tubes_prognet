    <template>
        <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
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
                        Data Detil KRS 
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

        <div class="custom-container">
        <h2 class="text-center">FORM AGAMA</h2>
        <form @submit.prevent="simpan()">
            <div class="row justify-content-center">
            <div class="mb-3 form-group col-10">
                <label>Agama</label>
                <input type="text" class="form-control" v-model="agama.agama">
            </div>
            <div class="mb-3 form-group col-10">
                <div class="btn-group mb-3 col-3">
                <button type="submit" class="btn btn-primary">SIMPAN</button>
                <button type="button" class="btn btn-warning" @click="clear()">CLEAR</button>
                </div>
            </div>
            </div>
        </form>
    
        <h3 style="text-align: center;">TABEL AGAMA</h3>
        <div class="row justify-content-center">
            <div class="col-10">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Agama</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(agama, index) in allagama" :key="agama.id">
                    <td class="text-center">{{ index + 1 }}</td>
                    <td class="text-center">{{ agama.agama }}</td>
                    <td class="text-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning" @click="edit(agama)">EDIT</button>
                        <button type="button" class="btn btn-danger" @click="remove(agama)">DELETE</button>
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
        name: 'agama',
        data() {
        return {
            allagama: [],
            agama: {
            'id': '',
            'agama': '',
            }
        };
        },
    
        created() {
        console.log('Created!');
        this.loadallagama();
        },
    
        methods: {
        loadallagama() {
            var url = 'https://api-group13-prognet.manpits.xyz/api/agama';
            var token = localStorage.getItem('token');
            var header = {'Authorization': 'Bearer ' + token};
            axios.get(url, { headers: header }).then(({ data }) => {
                this.allagama = data;
            });
        },
        remove(agama) {
            var url = `https://api-group13-prognet.manpits.xyz/api/agama/${agama.id}`;
            var token = localStorage.getItem('token');
            var header = {'Authorization': 'Bearer ' + token};
            axios.delete(url, { headers: header }).then(() => {
            console.log('Berhasil dihapus!');
            this.loadallagama(); // perbarui data
            }).catch((error) => {
            console.error('Gagal menghapus:', error);
            });
        },
    
        edit(agama) {
            var url = `https://api-group13-prognet.manpits.xyz/api/agama/${agama.id}`;
            var token = localStorage.getItem('token');
            var header = {'Authorization': 'Bearer ' + token};
            axios.get(url, { headers: header }).then(({ data }) => {
            this.agama = data;
            console.log(this.agama);
            });
        },
    
        simpan() {
            var token = localStorage.getItem('token');
            var header = {'Authorization': 'Bearer ' + token};
            if (this.agama.id === '') {
            var url = 'https://api-group13-prognet.manpits.xyz/api/agama';
            axios.post(url, this.agama, { headers: header }).then(() => {
                console.log('Berhasil disimpan!');
                this.loadallagama(); // reload data setelah simpan
                this.clear();
            }).catch((error) => {
                console.error('Gagal menyimpan:', error);
            });
            } else {
            // Edit
            var url = `https://api-group13-prognet.manpits.xyz/api/agama/${this.agama.id}`;
            axios.put(url, this.agama, { headers: header }).then(() => {
                console.log('Berhasil di edit');
                this.loadallagama(); // reload data setelah edit
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
            this.agama.id = '';
            this.agama.agama = '';
        }
        }
    };
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