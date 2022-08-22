<style >
    .button-message {
        background-color: #ffffff;
        border: 1px black solid!important;
        margin: 10px 0 10px 0;
        width: 100%;
    }    
</style>
<template>
    <div class="container-fluid">        
        <div class="container">
            <div class="tab-content" id="myTabContent">
                <project.overview></project.overview>                
                <message.messages></message.messages>
                <project.calendar></project.calendar>
            </div>
        </div> 
        <message.message></message.message>   
    </div>
</template>
<script>
    export default {
        mounted() {
            /*
            let classes = ["","icon-button-gray","icon-button-darkmagenta","icon-button-darkred","icon-button-seagreen"];
            for(let i = 1 ;i<=4 ; i++){
               this.projects.push({"id" : i,"name" : `Project ${i}`,"logo" : classes[i] });
            }*/                 
        }
    }
</script>