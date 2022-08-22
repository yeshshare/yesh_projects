<template>
    <div class="modal fade" id="message_modal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="messageModalLabel">New message</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row" >
                <div class="col-12" >
                  <h2><input 
                        v-model="mensagem.subject"
                        v-on:keyup="changeMessage" 
                        type="text" 
                        class="form-control" 
                        placeholder="Subject" ></h2>
                </div>
                <div class="col-1" >
                  <label for="messageTO" class="form-label">TO</label>
                </div>
                <div class="col-11" >  
                   <input id="messageTO" name="messageTO" type="text" class="form-control" placeholder="Message to" >
                </div>
                <div class="col-12" >
                  <textarea class="form-control" placeholder="Type '@' to mention tasks, projects, etc.Type '@' to mention tasks, projects, etc." ></textarea>
                </div>
            </div>

        </div>     
        <div class="modal-footer">
            <button type="button" class="btn btn-primary">Send</button>            
        </div>    
      </div>
    </div>
  </div> 
</template>
<script>
    export default {
      data(){
         return{
           mensagem : {
              'subject' : "",
              'to' : "",
              'message' : ""
           }
         }
      }, 
      mounted() {
                             
      }, methods: {
        changeMessage(){
          console.log(this.mensagem);
        }
      }
    }
</script>