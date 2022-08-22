<style >
.button-message {
    background-color: #ffffff;
    border: 1px black solid !important;
    margin: 10px 0 10px 0;
    width: 100%;
}
</style>
<template>
    <div class="container-fluid">
        <div class="container">
            <div class="tab-content" id="myTabContent">
                <task.overview :projectData="`${JSON.stringify(projectData)}`" 
                    :userData="`${JSON.stringify(user)}`"
                    :listStatus="`${JSON.stringify(listStatus)}`" 
                    :employeesRoles="`${JSON.stringify(employeesRoles)}`" 
                    :enviarTeste="enviarTeste"
                    :updateDescriptionText="updateDescriptionText" 
                    :updateDescriptionData="updateDescriptionData"
                    :lockEditDescription="lockEditDescription" 
                    :titleBlocked="titleBlocked"></task.overview>
                <task.list></task.list>
                <task.board></task.board>
                <task.timeline></task.timeline>
                <task.calendar></task.calendar>
                <task.workflow></task.workflow>
                <task.dashboard></task.dashboard>
                <message.messages></message.messages>
                <task.file></task.file>
            </div>
        </div>
        <message.message></message.message>
        <modals.statusProject :userData="`${JSON.stringify(user)}`" :setStatusProject="setStatusProject">
        </modals.statusProject>
    </div>
</template>
<script>
import { getProject, updateProject, getListStatusProjects, updateStatusProject,getListProjectEmployees } from "../../service/projectService";
export default {
    props: ['project', 'user'],
    data() {
        return {
            projectData: this.project,
            websocket: 'aguardando informações',
            users: [],
            dataTeste: "",
            titleBlocked: false,
            listStatus: [],
            employeesRoles:[]
        }
    },
    mounted() {
        var self = this;
        self.created();
        getProject(self.project.id, self.updateProject);
        try {
            getListStatusProjects(self.setListStatus, self.project.id);
            getListProjectEmployees(self.setListEmployeesRoles,self.project.id);
        } catch (error) {}
    },
    methods: {
        updateProject: function (value) {
            this.projectData = value;
        },
        lockEditDescription: function () {
            var self = this;
            let data = self.getCustonData();
            data.action = "lockTitle";
            data.data = self.user;
            self.connection.send(JSON.stringify({
                command: "send-group-message",
                data: data,
            }));
        },
        updateDescriptionText(description) {
            this.projectData.description = description;
            const self = this;
            let data = self.getCustonData();
            data.action = "updateProject";
            data.data = self.projectData;
            self.connection.send(JSON.stringify({
                command: "send-group-message",
                data: data,
            }));
        },
        updateDescriptionData(description) {
            this.projectData.description = description;
            updateProject(this.projectData, this.returUpdateProject);
        },
        returUpdateProject: function (returnData) {
            if (returnData.status) {
                toastr.success(returnData.message, "Aviso!");
            }
        },
        enviarTeste: function () {
            const self = this;
            let data = this.getCustonData();
            data.message = "teste";
            try {
                self.connection.send(JSON.stringify({
                    command: "send-group-message",
                    data: data,
                }));
            } catch (error) { }
        },
        getChannel: function () {
            const self = this;
            let projectChannel = `"Project_Channel_"${self.project.company_id}"_"${self.projectData.id}`;
            return projectChannel;

        },
        created: function () {
            var self = this;
            self.websocket = [];
            self.connection = new WebSocket("ws://" + window.location.hostname + ":8002");
            self.connection.onmessage = function (event) {
                try {
                    self.websocket = JSON.parse(event.data);
                    let atributos = Object.keys(self.websocket);
                    if (atributos.includes("command")) {
                        switch (self.websocket.command) {
                            case 'group-online-users':
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
                } catch (error) {
                    console.log(error);
                }
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
                self.getUserList();
                ws.close();
            };
        },
        joinroom: function (event_data) {
            const self = this;
            let data = this.getCustonData()
            self.connection.send(JSON.stringify({
                command: "join-group",
                data: data,
            }));
        },
        getCustonData: function () {
            var self = this;
            let data = {};
            data.room = self.getChannel();
            data.user = self.user;
            data.project_id = self.projectData.id;
            data.company_id = self.projectData.company_id;
            return data;
        },
        executeAction: function (element) {
            //console.log(element);
            var self = this;
            switch (element.action) {
                case "updateProject":
                    self.projectData = element.data;
                    break;
                case "updateStatusProject":
                    getListStatusProjects(self.setListStatus, self.projectData.id);
                    break;
                case "lockTitle":
                    if (self.titleBlocked) {
                        self.titleBlocked = false;
                    } else {
                        if (self.user.id != element.data.id) {
                            self.titleBlocked = true;
                        }
                    }
                    break;
                default:
            }
        },
        setListStatus: function (returnData) {
            let self = this;
            self.listStatus = [];
            returnData.forEach(function (element, index) {
                let iten = {};
                iten.id = index;
                iten.date = element[0];
                iten.data = element[1];
                self.listStatus.push(iten);
            });
        },
        setListEmployeesRoles: function (returnData) {
            console.log("carregou Employees");
            let self = this;
            self.employeesRoles = [];
            returnData.forEach(function (element) {
                self.employeesRoles.push(element);
            });
        },
        setStatusProject: function (statusAtual, description) {
            let self = this;
            let stausProject = {};
            stausProject.company_id = self.projectData.company_id;
            stausProject.employee_id = self.user.id;
            stausProject.project_id = self.projectData.id;
            stausProject.description = description;
            stausProject.status = statusAtual;
            updateStatusProject(stausProject, this.reloadStatusProject);
        },
        reloadStatusProject: function (returnData) {
            let self = this;
            if (returnData.status) {
                toastr.success(returnData.message, "Aviso!");
                try {
                    getListStatusProjects(self.setListStatus, self.projectData.id);
                    let data = self.getCustonData();
                    data.action = "updateStatusProject";
                    data.data = self.projectData;
                    self.connection.send(JSON.stringify({
                        command: "send-group-message",
                        data: data,
                    }));
                } catch (error) { }
            }
        }
    },
}
</script>