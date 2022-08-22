<template>
    <div class="modal fade" id="status_modal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="statusModalLabel">Status - 15 Aug</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row" >
                <div class="col-1" >
                  <label for="status" class="form-label">Status</label>
                </div>
                <div class="col-11" >  
                   <select 
                    id="status" 
                    name="status" 
                    class="form-control" 
                    v-model="statusProject">
                       <option value="On track" >On track</option>
                       <option value="At risk">At risk</option>
                       <option value="Off track">Off track</option>
                       <option value="On hold">On hold</option>
                       <option value="Complete">Complete</option>                        
                   </select><br>                                      
                </div>
                <div class="col-1" >
                  <label class="form-label">Owner : {{JSON.parse(this.userData).name}}</label>
                </div>
                <div class="col-12" >
                  <textarea v-model="description" class="form-control" placeholder="How's this project going?" ></textarea>
                </div>
            </div>

        </div>     
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="sendStatus">Send</button>            
        </div>    
      </div>
    </div>
  </div> 
</template>
<script>
export default {
  props : ['userData','setStatusProject'],
  data(){
    return {
      statusProject : "",
      description : ""
    }
  },
  methods:{
    sendStatus: function(){
      this.setStatusProject(this.statusProject,this.description);
    }
  }


}
</script>