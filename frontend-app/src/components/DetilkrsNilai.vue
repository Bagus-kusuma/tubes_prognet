<template>
    <div class="container-fluid">
    <div class="row">
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
            </div>
        </div>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <router-view></router-view>
        </main>
    </div>
    </div>

    <div class="custom-container" style="margin-left: 7cm;">
        <h5 class="ml-2">Nama: {{ selectedMahasiswa.nama }}</h5>
        <h5 class="ml-2">NIM: {{ selectedMahasiswa.nim }}</h5>
    </div>

    <div v-for="semesterData in groupedDetilKrs" :key="semesterData.semester" class="row justify-content-center" style="margin-left: 5cm;">
            <div class="col-10">
                <h3 style="text-align: center;">TABEL Nilai - Semester {{ getSemesterKrs(semesterData.semester ) }} - {{ getSemesterTahun(semesterData.semester ) }}</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center">Kode Matakuliah</th>
                            <th class="text-center">Matakuliah</th>
                            <th class="text-center">Nilai</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(detilkrs, index) in semesterData.data" :key="detilkrs.id">
                        <td class="text-center">{{ index + 1 }}</td>
                        <td class="text-center">{{ detilkrs.kode }}</td> <!-- Tambah kolom untuk Kode Matakuliah -->
                        <td class="text-center">{{ detilkrs.namamatakuliah }}</td> <!-- Tambah kolom untuk Nama Matakuliah -->
                        <td class="text-center">{{ detilkrs.nilai }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger" @click="remove(detilkrs)">DELETE</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</template>

<script>
import axios from 'redaxios';

export default {
    name: 'detilKrsNilai',
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
        allmahasiswa: [],
        allkrs: [],
        selectedMahasiswa: {}, // New property to store the selected mahasiswa details
    };
},
// Group detilkrs berdasar semester
    computed: {
        groupedDetilKrs() {
            const groupedData = {};
            this.alldetilkrs.forEach(detilkrs => {
                if (!groupedData[detilkrs.krs_id]) {
                    groupedData[detilkrs.krs_id] = {
                        semester: detilkrs.krs_id, // Assuming 'krs_id' represents the semester
                        data: []
                    };
                }
                groupedData[detilkrs.krs_id].data.push(detilkrs);
            });

            // Convert the object to an array
            return Object.values(groupedData);
        }
    },

    created() {
        console.log('Created!');
        this.loadallmahasiswa();
        this.loadalldetailkrs();
        this.loadallkrs()
    },

    methods: {

        loadalldetailkrs() {
        var mhs_id = localStorage.getItem('mhs_id');
        mhs_id = mhs_id.toString();
        var url = `http://127.0.0.1:8000/api/detilkrs/detail/${mhs_id}`;
        var token = localStorage.getItem('token');
        var header = { 'Authorization': 'Bearer ' + token };
        var self = this;

        axios.get(url, { headers: header })
            .then(({ data }) => {
                console.log('API Response:', data);

                if (Array.isArray(data.detilkrs)) {
                    self.alldetilkrs = Array.from(data.detilkrs);

                    // Set the selected mahasiswa details
                    self.selectedMahasiswa = self.allmahasiswa.find(mahasiswa => mahasiswa.id == mhs_id);

                    // Load matakuliah details for each detilkrs
                    self.alldetilkrs.forEach(detilkrs => {
                        self.loadMatakuliahDetails(detilkrs);
                    });
                } else {
                    console.error('Invalid detilkrs data format:', data.detilkrs);
                }

            })
            .catch(error => {
                console.error('Error fetching detilkrs data:', error);
            });
        },

        loadMatakuliahDetails(detilkrs) {
        var url = `http://127.0.0.1:8000/api/matakuliah/${detilkrs.matakuliah_id}`;
        var token = localStorage.getItem('token');
        var header = { 'Authorization': 'Bearer ' + token };
        var self = this;

        axios.get(url, { headers: header })
            .then(({ data }) => {
                console.log('Matakuliah Details:', data);

                // Assign matakuliah details to detilkrs object
                detilkrs.kode = data.kode;
                detilkrs.namamatakuliah = data.namamatakuliah;
            })
            .catch(error => {
                console.error('Error fetching matakuliah details:', error);
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

        getSemesterKrs(krs_semester) {
            const krs = this.allkrs.find(item => item.id === krs_semester);
            return krs ? krs.semester : 'N/A';
        },

        getSemesterTahun(krs_semester) {
            const krs = this.allkrs.find(item => item.id === krs_semester);
            return krs ? krs.tahun : 'N/A';
        },

        remove(detilkrs) {
    var url = `https://api-group13-prognet.manpits.xyz/api/detilkrs/${detilkrs.id}`;
    var token = localStorage.getItem('token');
    var header = {'Authorization': 'Bearer ' + token};
    axios.delete(url, { headers: header }).then(() => {
        console.log('Berhasil dihapus!');
        this.loadalldetailkrs(); // perbaruin data
    }).catch((error) => {
        console.error('Gagal menghapus:', error);
    });
},
    }
};
</script>

<style>
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