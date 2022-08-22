<!--
    dropdown list whith image (lwi)
    recebe uma lista de opções com sugentão de autocomplete
-->
<style scoped>
.row {
  background: #f8f9fa;
  margin-top: 20px;
  border: 2px solid black;
  border-radius: 10px;
}
.col {  
  padding: 10px;
}
label{
   background-color: aliceblue;
   border-radius: 10px;
   border: 2px solid black;
   padding: 0 2px;
   margin: 2px;
   font-size: 0.5em;
}
.text,
.text:focus{
  background-color: #f8f9fa;
  border: 0 solid #f8f9fa!important;
  outline-color: #f8f9fa;
  box-shadow: 0 0 0 0  #f8f9fa;
  height: 80%;
  width: 100%;
  margin-top: 1%;
}
</style>
<template>
    <div>
        <div class="row">
            <div class="col-3">
                <label v-for="iten in selecteds" :key="iten"> {{iten}} X </label>
            </div>
            <div class="col-9">
                <input v-model="elemetText" type="text" class="text" data-bs-toggle="dropdown" />
                <ul class="dropdown-menu">
                    <li v-for="element in listElements" :key="element.id">
                        <div class="dropdown-item" @click="setElement(element.name, element.email)">
                            <img :src="`data:image/jpeg;base64,${element.img}`" class="img-user rounded-circle">
                            {{ element.name }}
                            {{ element.email }}
                        </div>
                    </li>
                </ul>
            </div>
        </div>        
        
    </div>
</template>
<script>
export default {
    props: ["listElements", "keepHistory", "tokenBreaks", "callbackReturn"],
    data() {
        return {
            elemetText: "",
            selecteds:[]
        }
    },
    mounted() {
        /*
        let self = this;
        for (let index = 0; index < 6; index++) {
            let item = {}
            item.id = index;
            item.value = "email@email.com.br"  ;
            self.listElements.push(item);            
        } */
    },
    methods: {
        setElement: function (name, email) {
            let text = `${name} ${email}`;
            this.selecteds.push(text) ;
            /*
            if (this.keepHistory) {
                this.elemetText += `${text}${this.tokenBreaks}`;
            } else {
                this.elemetText = text;
            }
            this.callbackReturn(this.elemetText);*/
        }
    }
}
</script>