<style>
input{
    background: none;
    width: 100%;
}
.tittle{
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 780px;
}
</style>
<template>
 <div class="main-nav-start">
    <h2>
        <utils.editable
           :editableText ="projectData.title"
           :callbackUpdateText ="updateTitleText"
           :callbackUpdateData ="updateTitleData"
           :callbackLockedit ="lockEditTitle"
           :blocked ="titleBlocked"
           :lockable ="true"
        ></utils.editable>      
    </h2>
    <br>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
			<button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="false">Overview</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="list-tab" data-bs-toggle="tab" data-bs-target="#list" type="button" role="tab" aria-controls="list" aria-selected="true">List</button>
        </li> 
        <li class="nav-item" role="presentation">
			<button class="nav-link" id="board-tab" data-bs-toggle="tab" data-bs-target="#board" type="button" role="tab" aria-controls="board" aria-selected="false">Board</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="timeline-tab" data-bs-toggle="tab" data-bs-target="#timeline" type="button" role="tab" aria-controls="timeline" aria-selected="true">Timeline</button>
        </li>            
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="calendar-tab" data-bs-toggle="tab" data-bs-target="#calendar" type="button" role="tab" aria-controls="calendar" aria-selected="false">Calendar</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="workflow-tab" data-bs-toggle="tab" data-bs-target="#workflow" type="button" role="tab" aria-controls="workflow" aria-selected="true">Workflow</button>
        </li> 
        <li class="nav-item" role="presentation">
			<button class="nav-link" id="dashboard-tab" data-bs-toggle="tab" data-bs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Dashboard</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="true">Messages</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="file-tab" data-bs-toggle="tab" data-bs-target="#file" type="button" role="tab" aria-controls="file" aria-selected="true">File</button>
        </li>                        
    </ul>    
</div>
</template>
<script>
import { exportDefaultSpecifier } from '@babel/types';
import { getProject,updateProject} from "../../service/projectService";
export default {
    props : ['project','user'],
    data(){
        return{
            projectData : this.project,
            titleBlocked : false
        }
    },    
    mounted() {
        console.log('Componente projeto menu montado.')
        var self = this;
        self.created();
        getProject(self.project.id,self.updateProject);        
    },
    methods:{
        updateProject : function(value){
            this.projectData = value;
            //this.project = value;
        },
        lockEditTitle : function(){
            const self = this;
            let data = self.getCustonData();
            data.action = "lockTitle"; 
            data.data = self.user;
            self.connection.send(JSON.stringify({
                command: "send-group-message",
                data: data,
            }));            
        },
        updateTitleText(title){
           this.projectData.title = title;
           const self = this;
           let data = self.getCustonData();
            data.action = "updateProject";
            data.data = self.projectData;           
            self.connection.send(JSON.stringify({
                command: "send-group-message",
                data: data,
            }));   
        },
        updateTitleData(title){
           this.projectData.title = title;
           console.log(`updateTitleData(${title})`);
           updateProject(this.projectData,this.returUpdateProject);
        },returUpdateProject : function(returnData){
            if(returnData.status){
               toastr.success(returnData.message, "Aviso!"); 
            }
        },
        getChannel: function () {
            const self = this;            
            let projectChannel =  `"Project_Channel_"${self.project.company_id}"_"${self.projectData.id}` ;
            return projectChannel;
        },
        created: function () {
            const self = this;
            self.websocket = [];
            self.connection = new WebSocket("ws://"+window.location.hostname+":8002");
            self.connection.onmessage = function (event) {
                try {
                    //console.log(JSON.parse(event.data));
                    self.websocket = JSON.parse(event.data);
                    let atributos = Object.keys(self.websocket);
                    if (atributos.includes("command")) {
                        switch (self.websocket.command) {
                            case 'group-online-users':
                                //console.log(self.websocket.data);  
                                self.users = self.websocket.data                               
                                break;
                            case 'send-group-message':
                                self.executeAction(self.websocket.data); 
                                break;
                            case 'single-user-message':
                                break;
                            default:
                        }
                    }
                } catch (error) { }
            }
            self.connection.onopen = function (event) {
                self.joinroom(event.data);
            }
            self.connection.onclose = function (e) {
                console.log('Socket is closed. Reconnect will be attempted in 1 second.', e.reason);
                setTimeout(function () {
                    self.created();
                }, 1000);
            };
            self.connection.onerror = function (err) {
                console.error('Socket encountered error: ', err.message, 'Closing socket');
                ws.close();
            };
        },
        joinroom: function (event_data) {
            const self = this;
            let data = self.getCustonData();
            self.connection.send(JSON.stringify({
                command: "join-group",
                data: data,
            }));
        },
        getCustonData : function(){
            var self = this;
            let data = {};
            data.room = self.getChannel();
            data.user = self.user;
            data.project_id = self.projectData.id;
            data.company_id = self.projectData.company_id;
            return data;
        },
        executeAction : function(element){
            console.log(element);
            var self = this;
            switch(element.action){
                case "updateProject" :
                    self.projectData = element.data;
                    console.log(self.projectData);
                break;
                case "lockTitle" :
                    if(self.titleBlocked){
                        self.titleBlocked = false;
                    }else{
                        if(self.user.id != element.data.id ){
                            self.titleBlocked = true;                       
                        }
                    }
                break; 
                default:   
            }

        }        
    }
}
</script>