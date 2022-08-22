<style scoped>
.img-user {
    margin-bottom: 20px;
    width: 50px;
    height: 50px;
    background-color: aliceblue;
}
</style>
<template>
    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-7">
                <div class="row">
                    <div class="col-12">
                        <utils.editableTextArea
                            :editableText = "JSON.parse(this.projectData).description"
                            :callbackUpdateText ="updateDescriptionText"
                            :callbackUpdateData ="updateDescriptionData"
                            :callbackLockedit ="lockEditDescription"
                            :blocked ="titleBlocked"
                            :lockable ="true"
                        ></utils.editableTextArea>
                        <br>
                        <br>
                        <br>
                        </div>
                        <div class="col-8">
                        Project roles
                        <br>
                        <br>
                        <div class="row" 
                             >
                            <div class="col-4" >
                                <img src="data:image/svg+xml;base64,PHN2ZyBjbGFzcz0ic3ZnIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4MDAiIGhlaWdodD0iNTAwIj4NCiAgPGZvcmVpZ25PYmplY3QgY2xhc3M9Im5vZGUiIHg9IjQ2IiB5PSIyMiIgd2lkdGg9IjIwMCIgaGVpZ2h0PSIzMDAiPg0KICAgIDxib2R5IHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hodG1sIj4NCiAgICA8aWZyYW1lIHNyYz0iZGF0YTppbWFnZS9zdmcreG1sO2Jhc2U2NCxQRDk0Yld3Z2RtVnljMmx2YmowaU1TNHdJaUJsYm1OdlpHbHVaejBpVlZSR0xUZ2lJSE4wWVc1a1lXeHZibVU5SW01dklqOCtDanh6ZG1jS0lDQWdlRzFzYm5NNlpHTTlJbWgwZEhBNkx5OXdkWEpzTG05eVp5OWtZeTlsYkdWdFpXNTBjeTh4TGpFdklnb2dJQ0I0Yld4dWN6cGpZejBpYUhSMGNEb3ZMMk55WldGMGFYWmxZMjl0Ylc5dWN5NXZjbWN2Ym5Naklnb2dJQ0I0Yld4dWN6cHlaR1k5SW1oMGRIQTZMeTkzZDNjdWR6TXViM0puTHpFNU9Ua3ZNREl2TWpJdGNtUm1MWE41Ym5SaGVDMXVjeU1pQ2lBZ0lIaHRiRzV6T25OMlp6MGlhSFIwY0RvdkwzZDNkeTUzTXk1dmNtY3ZNakF3TUM5emRtY2lDaUFnSUhodGJHNXpQU0pvZEhSd09pOHZkM2QzTG5jekxtOXlaeTh5TURBd0wzTjJaeUlLSUNBZ2QybGtkR2c5SWpRd2JXMGlDaUFnSUdobGFXZG9kRDBpTkRCdGJTSUtJQ0FnZG1sbGQwSnZlRDBpTUNBd0lEUXdJRFF3SWdvZ0lDQjJaWEp6YVc5dVBTSXhMakVpQ2lBZ0lHbGtQU0p6ZG1jNElqNEtJQ0E4WkdWbWN3b2dJQ0FnSUdsa1BTSmtaV1p6TWlJZ0x6NEtJQ0E4YldWMFlXUmhkR0VLSUNBZ0lDQnBaRDBpYldWMFlXUmhkR0UxSWo0S0lDQWdJRHh5WkdZNlVrUkdQZ29nSUNBZ0lDQThZMk02VjI5eWF3b2dJQ0FnSUNBZ0lDQnlaR1k2WVdKdmRYUTlJaUkrQ2lBZ0lDQWdJQ0FnUEdSak9tWnZjbTFoZEQ1cGJXRm5aUzl6ZG1jcmVHMXNQQzlrWXpwbWIzSnRZWFErQ2lBZ0lDQWdJQ0FnUEdSak9uUjVjR1VLSUNBZ0lDQWdJQ0FnSUNCeVpHWTZjbVZ6YjNWeVkyVTlJbWgwZEhBNkx5OXdkWEpzTG05eVp5OWtZeTlrWTIxcGRIbHdaUzlUZEdsc2JFbHRZV2RsSWlBdlBnb2dJQ0FnSUNBZ0lEeGtZenAwYVhSc1pUNDhMMlJqT25ScGRHeGxQZ29nSUNBZ0lDQThMMk5qT2xkdmNtcytDaUFnSUNBOEwzSmtaanBTUkVZK0NpQWdQQzl0WlhSaFpHRjBZVDRLSUNBOFp3b2dJQ0FnSUdsa1BTSnNZWGxsY2pFaUNpQWdJQ0FnZEhKaGJuTm1iM0p0UFNKMGNtRnVjMnhoZEdVb0xUWTVMalU0TURNMkxDMDRNaTQwTXpFMU5ERXBJajRLSUNBZ0lEeGphWEpqYkdVS0lDQWdJQ0FnSUhOMGVXeGxQU0ptYVd4c09pTm1aakF3TURBN1ptbHNiQzF5ZFd4bE9tVjJaVzV2WkdRN2MzUnliMnRsTFhkcFpIUm9PakF1TWpZME5UZ3pJZ29nSUNBZ0lDQWdhV1E5SW5CaGRHZ3hNQ0lLSUNBZ0lDQWdJR040UFNJNE9TNDFPREF6TmlJS0lDQWdJQ0FnSUdONVBTSXhNREl1TkRNeE5UUWlDaUFnSUNBZ0lDQnlQU0l5TUNJZ0x6NEtJQ0E4TDJjK0Nqd3ZjM1puUGdvPSI+DQogIFdJTEwgQkUgQUJTVVJEIHRoZSAiaWZyYW1lIiB0YWcgaXMgbm90IHN1cHBvcnRlZCBieSB5b3VyIGJyb3dzZXIuDQo8L2lmcmFtZT4NCiAgICA8L2JvZHk+DQogIDwvZm9yZWlnbk9iamVjdD4NCjwvc3ZnPg=="
                                    class="img-user rounded-circle" />
                            </div> 
                            <div class="col-4" v-for="role in JSON.parse(employeesRoles)" :key="role.id" >
                                <img :src="`data:image/jpeg;base64,${role.img}`"
                                    class="img-user rounded-circle" />
                            </div>                            
                        </div>
                    </div>
                    <div class="col-12">
                        Key resources
                        <utils.dropdownlwi
                          :listElements="JSON.parse(employeesRoles)"
                          :keepHistory = "false"
                          :tokenBreaks = "','"
                          :callbackReturn ="getRole"                          
                        ></utils.dropdownlwi>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-lg-5">
                What's the status?
                <utils.timeline
                    :listStatus = "JSON.parse(this.listStatus)"
                ></utils.timeline>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: [
        'projectData', 
        'userData', 
        'enviarTeste',
        'updateDescriptionText',
        'updateDescriptionData',
        'lockEditDescription',
        'titleBlocked',
        'listStatus',
        'employeesRoles'
    ],
    data(){
        return{
            project : JSON.parse(this.projectData)
        }         
    },
    mounted() {

    },
    methods : {
        getRole(role){
            console.log(role);
        }
    }
}
</script>