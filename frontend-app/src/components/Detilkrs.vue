<template>
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

        <div class="custom-container">
        <h2 class="text-center">FORM HASIL PEMBELAJARAN</h2>
        <form @submit.prevent="simpan()">
            <div class="row justify-content-center">
            <div class="mb-3 form-group col-10">
                <label>Id KRS</label>
                <select type="text" class="form-control" v-model="detilkrs.krs_id">
                <option value=""></option>
                <option v-for="(krs, index) in allkrs" :key="krs.id" :value="krs.id">
                    {{ krs.tahun + '-' +krs.semester }}
                </option>
                </select>
            </div>
            <div class="mb-3 form-group col-10">
                <label>Mahasiswa</label>
                <select type="text" class="form-control" v-model="detilkrs.mahasiswa_id">
                    <option value=""></option>
                    <option v-for="(mahasiswa, index) in allmahasiswa" :key="mahasiswa.id" :value="mahasiswa.id">
                        {{ mahasiswa.nama + ' - ' + mahasiswa.nim }}
                    </option>
                </select>
            </div>

            <div class="mb-3 form-group col-10" style="max-height: 200px; overflow-y: auto;">
                <label>Mata Kuliah</label>
                <select type="text" class="form-control" v-model="detilkrs.matakuliah_id">
                    <option value=""></option>
                    <option v-for="(matakuliah, index) in allmatakuliah" :key="matakuliah.id" :value="matakuliah.id">
                        {{ matakuliah.namamatakuliah + ' - ' + matakuliah.kode }}
                    </option>
                </select>
            </div>

            <div class="mb-3 form-group col-10">
                <label>Nilai</label>
                <input type="text" class="form-control" v-model="detilkrs.nilai">
            </div>
            <div class="mb-3 form-group col-10">
                <div class="btn-group mb-3 col-3">
                <button type="submit" class="btn btn-primary">SIMPAN</button>
                <button type="button" class="btn btn-warning" @click="clear()">CLEAR</button>
                </div>
            </div>
            </div>
        </form>
    
        <h3 style="text-align: center;">TABEL DETIL KRS</h3>
        <div class="row justify-content-center">
            <div class="col-10">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center">NIM</th>
                    <th class="text-center">Nama Mahasiswa</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(mahasiswa, index) in allmahasiswa" :key="mahasiswa.id">
                    <td class="text-center">{{ index + 1 }}</td>
                    <td class="text-center">{{ mahasiswa.nim }}</td>
                    <td class="text-center">{{ mahasiswa.nama }}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" @click="redirectToDetilKrsNilai(mahasiswa.id)">Detail</button>
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
        name: 'detilkrs',
        data() {
        return {
            alldetilkrs: [],
            detilkrs: {
            'id': '',
            'krs_id': '',
            'mahasiswa_id': '',
            'matakuliah_id': '',
            'nilai': '',
            },
            allkrs: [],
            allmahasiswa: [],
            mahasiswa: {
            'id': '',
            'nim': '',
            'nama': '',
            'alamat': '',
            'lahir': '',
            'agama_id': '',
            },
            allmatakuliah: [],
        };
        },
    
        created() {
        console.log('Created!');
        this.loadalldetilkrs();
        this.loadallkrs();
        this.loadallmahasiswa();
        this.loadallmatakuliah();
        },
    
        methods: {

        loadalldetilkrs() {
            var url = 'https://api-group13-prognet.manpits.xyz/api/detilkrs';
            var token = localStorage.getItem('token');
            var header = {'Authorization': 'Bearer ' + token};
            axios.get(url, { headers: header }).then(({ data }) => {
            this.alldetilkrs = data;
            });
        },
    
        loadallkrs() {
            var url = `https://api-group13-prognet.manpits.xyz/api/krs`;
            var token = localStorage.getItem('token');
            var header = {'Authorization': 'Bearer ' + token};
            axios.get(url, { headers: header }).then(response => {
            console.log(response.data);
            this.allkrs = response.data;
            }).catch(error => {
            console.error('Error fetching krs data:', error);
            });
        },
    
        loadallmahasiswa() {
            var url = `https://api-group13-prognet.manpits.xyz/api/mahasiswa`;
            var token = localStorage.getItem('token');
            var header = {'Authorization': 'Bearer ' + token};
            axios.get(url, { headers: header }).then(response => {
            console.log(response.data);
            this.allmahasiswa = response.data;
            }).catch(error => {
            console.error('Error fetching krs data:', error);
            });
        },
    
        loadallmatakuliah() {
            var url = `https://api-group13-prognet.manpits.xyz/api/matakuliah`;
            var token = localStorage.getItem('token');
            var header = {'Authorization': 'Bearer ' + token};
            axios.get(url, { headers: header }).then(response => {
            console.log(response.data);
            this.allmatakuliah = response.data;
            }).catch(error => {
            console.error('Error fetching krs data:', error);
            });
        },
    
        getNamaMahasiswa(detilkrs_mahasiswa_id) {
            const mahasiswa = this.allmahasiswa.find(item => item.id === detilkrs_mahasiswa_id);
            return mahasiswa ? mahasiswa.nama : 'N/A';
        },

        getIdMahasiswa(detilkrs_mahasiswa_id) {
            const mahasiswa = this.allmahasiswa.find(item => item.id === detilkrs_mahasiswa_id);
            return mahasiswa ? mahasiswa.nim : 'N/A';
        },
    
        getMatakuliah(detilkrs_matakuliah_id) {
            const matakuliah = this.allmatakuliah.find(item => item.id === detilkrs_matakuliah_id);
            return matakuliah ? matakuliah.namamatakuliah : 'N/A';
        },
    
        simpan() {
            var token = localStorage.getItem('token');
            var header = {'Authorization': 'Bearer ' + token};
            if (this.detilkrs.id === '') {
            var url = 'https://api-group13-prognet.manpits.xyz/api/detilkrs';
            axios.post(url, this.detilkrs, { headers: header }).then(() => {
                console.log('Berhasil disimpan!');
                this.loadalldetilkrs(); // Reload data after saving
                this.clear();
            }).catch((error) => {
                console.error('Gagal menyimpan:', error);
            });
            } else {
            // Edit
            var url = `https://api-group13-prognet.manpits.xyz/api/detilkrs/${this.detilkrs.id}`;
            axios.put(url, this.detilkrs, { headers: header }).then(() => {
                console.log('Berhasil di edit');
                this.loadalldetilkrs(); // Reload data after editing
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

        redirectToDetilKrsNilai(mahasiswa_id) {
            localStorage.setItem('mhs_id', mahasiswa_id);
            this.$router.push({ name: 'detilKrsNilai' });
        },
    
        clear() {
            this.detilkrs.id = '';
            this.detilkrs.krs_id = '';
            this.detilkrs.mahasiswa_id = '';
            this.detilkrs.matakuliah_id = '';
            this.detilkrs.nilai = '';
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