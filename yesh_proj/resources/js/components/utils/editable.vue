<template>
  <div class="tittle col-12" id="editable_id" @dblclick="updateEditable">
    <span v-if="!editable" class="title">{{editableText}}</span>
    <input v-if="editable" v-model="localEditableText" @blur="updateData" @keyup="updateText" />
  </div>
</template>
<script>
export default {
  props : ['editableText','callbackUpdateText','callbackUpdateData','callbackLockedit','lockable','blocked'],
  data(){
     return{
        editable : false,
        localEditableText : this.editableText        
     }
  },
  methods:{
    updateEditable : function(){
      if(!this.blocked){
        this.localEditableText = (this.localEditableText == "" || this.localEditableText != this.editableText   ) ? this.editableText : this.localEditableText;       
        this.editable = !this.editable;
        if(this.lockable){
          this.callbackLockedit();
        }
      }else{
        toastr.warning("Item já esta sendo editado por outra pessoa!", "Aviso!");         
      }            
    },
    updateText : function(){
      console.log("updateText"); 
      console.log(this.editableText); 
      this.callbackUpdateText(this.localEditableText);
    },
    updateData :function(){
      console.log("updateData");
      console.log(this.editableText);      
      this.editable = !this.editable;
      if(this.lockable){
        this.callbackLockedit();
      }
      this.callbackUpdateData(this.localEditableText);
    }
        
  }
  
}
</script>