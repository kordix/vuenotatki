<template>
<div class="container">
    <div class="row" v-for="note in notesdata">
        <div class="col-md-8">
            <a :href="''+note.link" target="_blank">{{note.link}}</a>
        </div>
          <div class="col-md-2">
           <button class="btn-sm btn-danger" @click="remove(note.id)">Usuń</button>
        </div>
    </div>
    <input type="text" v-model="newnote">
    <button @click="add">Dodaj</button>

</div>    

</template>

<script>
export default {

    data(){
        return {
            notesdata:null,
            newnote:null
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
            axios.post('note',{link:self.newnote}).then((res)=>self.getData());
        },
        remove(id){
            let self = this;
            axios.delete('/note/'+id).then((res)=>self.getData())
        }
    }
}



</script>