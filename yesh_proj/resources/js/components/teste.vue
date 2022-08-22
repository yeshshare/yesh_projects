<template>
    <label>Teste</label>
</template>
<script>
    export default {
       data() {
                return {
                   websocket:[]
                };
            },
            
            mounted() {
                //console.log(this.authEmail);
                   this.created();
                   
                   
                },
                 beforeMount(){
                     
                    this.joinroom();
                    
                 },
            methods: {
                 
                created: function() {
                    const self = this;
                    self.websocket = [];
                    self.connection = new WebSocket("ws://127.0.0.1:6500");
                    self.connection.onmessage = function(event) {
                      console.log(event);
                      self.websocket = JSON.parse(event.data);
                    }
                
                    self.connection.onopen = function(event) {
                       self.joinroom(event.data);
                       
                    }
                
                  },
               
               joinroom: function(data) {
                   const self = this;
                   self.connection.send(JSON.stringify({
                        join: 'proj_projID',
                    }));

               },
               
               sendmsg: function(id){
                   //console.log(id);
                   const self = this;
                   self.connection.send(JSON.stringify({
                        sendto: id,
                        msg: 'comando enviado'
                    }));
               }
            
            }
    }
</script>