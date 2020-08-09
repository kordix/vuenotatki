<template>
<div class="container">
    <div class="row" style="font-weight:bold">
        <div class="col-md-6">Obrazek</div>
    </div>

    <div class="row" v-for="elem in data">
        <img :src="elem.source">
    </div>

<br><br>
    <label for="">Link</label>
    <input type="text" v-model="cruddata.source">
    <button @click="add" v-if="mode=='add'">Dodaj</button>
    <button @click="update" v-else-if="mode=='edit'">Zmień</button>
</div>    

</template>

<script>
export default {

    data(){
        return {
            cruddata:{source:''},
            data:null,
            link:null,
            notatka:null,
            notesdata2:{},
            mode:'add',
            editid:null
        }
    },
    created(){
      this.getData();
    },
    methods:{
        getData(){
            let self = this;
            this.newnote='';
            axios.get('picture').then((res)=>self.data=res.data);
        },
        add(){
            let self = this;
            axios.post('picture',this.cruddata).then((res)=>self.getData());
        },
        edit(id){
            this.mode='edit';
            this.editid = id;
            let self = this;
            axios.get('/picture/'+id).then((res)=>self.handleedit(res));
        },
        handleedit(res){
            this.link = res.data.link;
            this.notatka = res.data.notatka;
        },
        update(){
            let self = this;
            axios.patch('/picture/'+self.editid, {link:self.link,notatka:self.notatka}).then((res)=>self.getData());
        },
        remove(id){
            let self = this;
            axios.delete('/picture/'+id).then((res)=>self.getData())
        }
    }
}



</script>