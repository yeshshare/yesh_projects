<style>
  .textAreaEditable {
    width: 100%;
    background: none;
    min-height: 500px;
    height: auto;
  }
  .labelEditable{
    white-space: break-spaces;
  }
  .quillWrapper{
    white-space: break-spaces;
  }
  .ql-toolbar.ql-snow {
    border: none!important;
    box-sizing: border-box;
    font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;
    padding: 8px;
  }
  .ql-container.ql-snow { 
    border: none!important;
  }
</style>
<template>
    <div class="tittle col-12" id="editable_id" >
        <div class="labelEditable ql-editor" v-if="!editable"  @dblclick="updateEditable" 
          v-html='`${(fullText) ? editableText :editableText.substring(0, 100)}`'
        ></div>
        <vue-editor 
        v-if="editable"
        @text-change="updateText"
        @blur="updateData"
        v-model="localEditableText"
        ></vue-editor>  
        <span  v-if="!editable" @click="defineDescriptionMode" >
          {{  (fullText) ? labelLongText : labelSortText}}
        </span>
    </div>
</template>
<script>
import { VueEditor, Quill } from "vue2-editor";
export default {
  props : ['editableText','callbackUpdateText','callbackUpdateData','callbackLockedit','lockable','blocked'],
  components: {
    VueEditor
  },
  data(){
     return{
        editable : false,
        localEditableText : this.editableText,
        fullText: false,
        labelSortText: "see more",
        labelLongText: "see less",       
     }
  },
  mounted() {
    this.editable = !this.editable;
    this.editable = !this.editable;
    //this.fullText = !this.fullText;    
  },
  methods:{
    defineDescriptionMode : function(){
      this.fullText = !this.fullText;
    },
    updateEditable : function(){
      if(!this.blocked){
        this.localEditableText = (this.localEditableText == "" || this.localEditableText != this.editableText   ) ? this.editableText : this.localEditableText;       
        this.editable = !this.editable;
        console.log(`editavel : ${this.editable}`);
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