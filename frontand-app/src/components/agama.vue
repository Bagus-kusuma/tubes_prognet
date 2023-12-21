<template>
    <div class="container">
        <h2>FORM AGAMA</h2>
        <form @submit.prevent="simpan()">
            <div class="mb-3 form-group">
                <label>Agama</label>
                <input type="text" class="form-control" v-model="agama.agama">
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-primary" :type="submit">SIMPAN</button>
                <button type="button" class="btn btn-warning" @click="clear(agama)">CLEAR</button>
            </div>
        </form>


        <h3 style="text-align: center;">TABEL AGAMA</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Agama</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(agama, index) in allagama" key="agama.id">
                    <td>{{ agama.id }}</td>
                    <td>{{ agama.agama }}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-warning" @click="edit(agama)">EDIT</button>
                            <button type="button" class="btn btn-danger" @click="remove(agama)">DELETE</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        
    </div>
</template>

<script>
    import axios from 'redaxios';

    export default {
        name : 'agama',
        data(){
            return{
                allagama : [],
                agama:{
                    'id': '',
                    'agama': '',
                }
            }
        },
        created() {
            console.log('Created!');
            this.loadallagama();
        },
        mounted() {
            console.log('Mounted');
        },
        methods: {
            loadallagama() {
                var url = 'http://127.0.0.1:8000/api/agama'; 
                axios.get(url).then(
                    ({data})=>{
                        // console.log(data);
                        this.allagama=data;
                    }
                );
            },
            remove(agama) {
                var url = `http://127.0.0.1:8000/api/agama/${agama.id}`;
                axios.delete(url).then(() => {
                    console.log('Berhasil dihapus!');
                    this.allagama=data;
                }).catch((error) => {
                    console.error('Gagal menghapus:', error);
                });
            },
            edit(agama){
                var url = `http://127.0.0.1:8000/api/agama/${agama.id}`;
                axios.get(url).then(({data}) => {
                    this.agama = data;
                    console.log(this.agama);
                });
            },
            simpan(){
                console.log (this.agama.id);
                alert('test')
                if (this.agama.id==''){
                    //simpan baru
                } else{
                    var url = `http://127.0.0.1:8000/api/agama/${this.agama.id}`;
                axios.put(url, this.agama). then(
                    ()=>{
                        console.log('berhasil di edit');
                    }
                );
                }
                
            },
            clear(){
                this.agama.agama='';
            }

        }
    }
</script>