<template>
<div class="container">
    <div class="row" style="font-weight:bold">
        <div class="col-md-6">Link</div>
        <div class="col-md-2">Notatka</div>

    </div>

    <div class="row" v-for="note in notesdata">
        <div class="col-md-6">
            <a :href="''+note.link" target="_blank">{{note.link}}</a>
        </div>
        <div class="col-md-2">
            <p>{{note.notatka}}</p>
        </div>
          <div class="col-md-2">
           <button class="btn-sm btn-danger" @click="remove(note.id)">Usuń</button>
           <button class="btn-sm btn-danger" @click="edit(note.id)">Edit</button>

        </div>
    </div>
    <label for="">Link</label>
    <input type="text" v-model="link">
        <label for="">Opis</label>
    <input type="text" v-model="notatka">
    <button @click="add" v-if="mode=='add'">Dodaj</button>
    <button @click="update" v-else-if="mode=='edit'">Zmień</button>
</div>    

</template>

<script>
export default {

    data(){
        return {
            notesdata:null,
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
            axios.get('note').then((res)=>self.notesdata=res.data);

        },
        add(){
            let self = this;
            axios.post('note',{link:self.link,notatka:self.notatka}).then((res)=>self.getData());
        },
        edit(id){
            this.mode='edit';
            this.editid = id;
            let self = this;
            axios.get('/note/'+id).then((res)=>self.link=res.data.link);
        },
        update(){
            let self = this;
            axios.patch('/note/'+self.editid, {link:self.link,notatka:self.notatka})
        },
        remove(id){
            let self = this;
            axios.delete('/note/'+id).then((res)=>self.getData())
        }
    }
}



</script>