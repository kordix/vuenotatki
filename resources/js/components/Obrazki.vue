<template>
<div class="container">
    <div class="row" style="font-weight:bold">
        <div class="col-md-6">Obrazek</div>
    </div>

    <div class="row" v-for="elem in data">
        <a :href="elem.source" target="_blank"><img style="max-width:300px;max-height:300px" :src="elem.source"></a> 
        <p>{{elem.category}}</p>
    </div>
    <p>{{$route.path}}</p>
    <div v-if="$route.path == '/obrazki'">fasdfadfsdfsf</div>
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
    computed:{
  
    },
    methods:{
        getData(){
            let self = this;
            this.newnote='';
            axios.get('/picture').then((res)=>self.data=res.data).then(()=>self.filter());
        },
        filter(){
            if(this.$route.path == '/asdf'){
                this.data =  this.data.filter((el)=>el.category == 'asdf')
            }else{
                this.data =  this.data.filter((el)=>el.category != 'asdf')

            }
        },
        add(){
            let self = this;
            if(this.$route.path == '/asdf'){
                this.cruddata.category = 'asdf'
            }else{
                this.cruddata.category = ''
            }
            console.log(this.cruddata.category);
            axios.post('/picture',this.cruddata).then((res)=>self.getData());
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