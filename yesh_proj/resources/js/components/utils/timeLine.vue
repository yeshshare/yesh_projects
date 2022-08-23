<!--
   Timeline
   recebe uma lista de Status para geração de uma timeline.
   possui bot~es que acionam um componente para adicionar novos status.
-->
<style>
.timeline_area {
    position: relative;
    z-index: 1;
}

.single-timeline-area {
    position: relative;
    z-index: 1;
    padding-left: 180px;
}

@media only screen and (max-width: 575px) {
    .single-timeline-area {
        padding-left: 100px;
    }
}

.single-timeline-area .timeline-date {
    position: absolute;
    width: 180px;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 1;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    -ms-grid-row-align: center;
    align-items: center;
    -webkit-box-pack: end;
    -ms-flex-pack: end;
    justify-content: flex-end;
    padding-right: 60px;
}

@media only screen and (max-width: 575px) {
    .single-timeline-area .timeline-date {
        width: 100px;
    }
}

.single-timeline-area .timeline-date::after {
    position: absolute;
    width: 3px;
    height: 100%;
    content: "";
    background-color: #ebebeb;
    top: 0;
    right: 30px;
    z-index: 1;
}

.single-timeline-area .timeline-date::before {
    position: absolute;
    width: 11px;
    height: 11px;
    border-radius: 50%;
    background-color: #f1c40f;
    content: "";
    top: 50%;
    right: 26px;
    z-index: 5;
    margin-top: -5.5px;
}

.single-timeline-area .timeline-date p {
    margin-bottom: 0;
    color: #020710;
    font-size: 13px;
    text-transform: uppercase;
    font-weight: 500;
}

.single-timeline-area .single-timeline-content {
    position: relative;
    z-index: 1;
    padding: 30px 30px 25px;
    border-radius: 6px;
    margin-bottom: 15px;
    margin-top: 15px;
    -webkit-box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
    box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
    border: 1px solid #ebebeb;
}

@media only screen and (max-width: 575px) {
    .single-timeline-area .single-timeline-content {
        padding: 20px;
    }
}

.single-timeline-area .single-timeline-content .timeline-icon {
    -webkit-transition-duration: 500ms;
    transition-duration: 500ms;
    width: 30px;
    height: 30px;
    background-color: #f1c40f;
    -webkit-box-flex: 0;
    -ms-flex: 0 0 30px;
    flex: 0 0 30px;
    text-align: center;
    max-width: 30px;
    border-radius: 50%;
    margin-right: 15px;
}

.single-timeline-area .single-timeline-content .timeline-icon i {
    color: #ffffff;
    line-height: 30px;
}

.single-timeline-area .single-timeline-content .timeline-text h6 {
    -webkit-transition-duration: 500ms;
    transition-duration: 500ms;
}

.single-timeline-area .single-timeline-content .timeline-text p {
    font-size: 13px;
    margin-bottom: 0;
}

.single-timeline-area .single-timeline-content:hover .timeline-icon,
.single-timeline-area .single-timeline-content:focus .timeline-icon {
    background-color: #020710;
}

.single-timeline-area .single-timeline-content:hover .timeline-text h6,
.single-timeline-area .single-timeline-content:focus .timeline-text h6 {
    color: #3f43fd;
}

.button-status {
    border: 1px solid #020710;
    border-radius: 10px;
    margin: 20px 0 20px 0;
    width: 80%;
    height: 60px;
}

.button-icon {
    width: 20px;
    height: 20px;
    border-radius: 14px;
}

.button-success {
    background-color: #58a182;
}

.button-warning {
    background-color: #f1bd6c;
}

.button-error {
    background-color: #de5f73;
}



.success,
.warning,
.error {
    background-color: #fff;
}


.success:hover {
   background-color:rgba(0,255,0,0.3);
}

.warning:hover {
    background-color:rgba(255,255,0,0.3);
}

.error:hover {
    background-color:rgba(255,0,0,0.3);;
}

.status-success, 
.status-success:hover{
   background-color: #58a182!important;
}

.status-warning,
.status-warning:hover {
    background-color: #f1bd6c!important;
}

.status-error,
.status-error:hover {
    background-color: #de5f73!important;
}

.button-icon-inside {
    margin: 18px 10px;
}
.buttons-status{
    display: flex;
    justify-content: center;
}
.line-status{
    height: 5px!important;
}

.single-timeline-area .timeline-date::before {
    position: absolute;
    width: 11px;
    height: 11px;
    border-radius: 50%;
    background-color: #0d6efd;
    content: "";
    top: 50%;
    right: 26px;
    z-index: 5;
    margin-top: -5.5px;
}

</style>
<template>
    <section class="timeline_area section_padding_130">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-12 col-lg-12">
                    <!-- Section Heading-->
                    <div class="section_heading text-center">
                        <!-- <h6>Our History</h6>
                        <h3>A brief stories of our 2 years company journey</h3>-->
                        <div class="row">
                            <div class="col-12 col-sm-4 col-lg-4 buttons-status">
                                <div class="button-status success" data-bs-toggle="modal" data-bs-target="#status_modal">
                                    <div class="row button-icon-inside">
                                        <div class="col-1">
                                            <div class="button-icon button-success">
                                                <i class="fa fa-address-card" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <h6>on track</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-lg-4 buttons-status">
                                <div class="button-status warning" data-bs-toggle="modal" data-bs-target="#status_modal">
                                    <div class="row button-icon-inside">
                                        <div class="col-1">
                                            <div class="button-icon button-warning">
                                                <i class="fa fa-address-card" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <h6>on risc</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-lg-4 buttons-status">
                                <div class="button-status error" data-bs-toggle="modal" data-bs-target="#status_modal" >
                                    <div class="row button-icon-inside">
                                        <div class="col-1">
                                            <div class="button-icon button-error">
                                                <i class="fa fa-address-card" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <h6>off track</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="line"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Timeline Area-->
                    <div class="apland-timeline-area">
                        <!-- Single Timeline Content-->
                        <div class="single-timeline-area"
                            :id="`statusProject${statusProject.id}`"
                            v-for="statusProject in listStatus"
                            :key="statusProject.id"                        
                        >
                            <div class="timeline-date wow fadeInLeft" data-wow-delay="0.1s"
                                style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                <p>{{statusProject.date}}</p>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12"
                                    :id="`status${status.id}`"
                                    v-for="status in statusProject.data"
                                    :key="status.id"
                                >
                                    <div :class="`${getBoxStatusClass(status.status)}`" data-wow-delay="0.3s"
                                        style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                        <div :class="`${getIconStatusClass(status.status)}`"><i class="fa fa-briefcase" aria-hidden="true"></i>
                                        </div>
                                        <div class="timeline-text">
                                            <h6>{{status.status}}</h6>
                                            <p>{{status.description}}</p> 
                                        </div>
                                    </div>
                                </div>
                                <hr class="line-status">
                            </div>
                        </div>
                        <!-- Single Timeline Content-->                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    props : ['listStatus'],
    data(){
       return{
          
       }
    },
    mounted(){
        console.log("teste");
                
    },
    methods:{
        getIconStatusClass: function(status){
            let baseClass = "timeline-icon"
            switch (status) {
                case "On track":
                    return `${baseClass} status-success`;
                case "At risk":
                    return `${baseClass} status-warning` 
                case "Off track":
                    return `${baseClass} status-error`
                default:
                    return baseClass;
            }            
        },
        getBoxStatusClass: function(status){
            let baseClass = "single-timeline-content d-flex wow fadeInLeft"
            switch (status) {
                case "On track":
                    return `${baseClass} success`;
                case "At risk":
                    return `${baseClass} warning` 
                case "Off track":
                    return `${baseClass} error`
                default:
                    return baseClass;
            }            
        }
    }
}

</script>