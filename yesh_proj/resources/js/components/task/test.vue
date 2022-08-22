<template>
    <div>
        <span>teste</span>
    </div>
</template>
<script>
export default {
    props : ['exibir','connection','getChannel','projectData','userData'],
    mounted(){
        
    },
    beforeMount(){
        console.log(this.exibir);
        console.log(this.connection);
        this.exibir();
        const self = this;
        let data = {};
        data.room = self.getChannel(); 
        data.user = JSON.parse(self.userData);
        data.project_id = JSON.parse(self.projectData).id;
        data.company_id = JSON.parse(self.projectData).company_id; 
        data.nmessage = "teste";
        

        try {
            self.connection.send(JSON.stringify({
                command: "send-group-message",
                data: data,
            }));    
        } catch (error) {
                    
        }
        
    }
}
</script>