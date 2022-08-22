<style>
    .card-header{
        background-color: #fff;
    }
    .rounded-corners-10{
        border-radius: 10px;
    }

    .space-start-end{
        margin-top:20px;
        margin-bottom:20px;
    }

    .backbackground-white{
        background-color: #ffffff;
    }

    .backbackground-primary{
        background-color: whitesmoke;
    }

    

</style>
<template>
    <div class="tab-pane fade backbackground-primary" id="messages" role="tabpanel" aria-labelledby="messages-tab" >
        <div class="container content-box"  >
            <div class="row justify-content-center">
                <div class="col-12 space-start-end rounded-corners-10 backbackground-white" >
                    <button type="text" class="btn btn-sm button-message" data-bs-toggle="modal" data-bs-target="#message_modal">
                        <i class="fa fa-comment-o" aria-hidden="true"></i>
                        Send message
                    </button>	
                </div>    
            </div>
            <div class="row justify-content-center">
                <div 
                class="card space-start-end rounded-corners-10" 
                :id="`message${message.id}`"
                v-for="message in messages"
                :key="message.id" >
                    <div class="card-header backbackground-white" >
                        <h5 class="card-title">Projects</h5>
                    </div>    
                    <div class="card-body">
                        <h2>
                            <input class="control-form backbackground-white"
                                type="text" 
                                placeholder="Titulo da mensegem" 
                                :value="`${message.title}`"
                                style="width:100%">
                        </h2>
                        <span>{{message.origin}}</span>
                        <hr>
                        <div 
                            :id="`comment${comment.id}`"
                            v-for="comment in message.comments"
                            :key="comment.id"
                        >
                            <div class="row" >
                                <div class="col-12">
                                    <span>{{comment.origin}}</span><br>
                                </div>
                                <div class="col-12">    
                                    <span>{{comment.text}}</span> 
                                </div>
                            </div>                           
                        </div>
                    </div>
                    <div class="card-footer backbackground-white" >
                        <input class="control-form backbackground-white button-message" type="text" placeholder="Reply to message…" value="">
                    </div>
                </div>
            </div>    
        </div>        
    </div>
</template>
<script>
    export default {
        //props: [{'users' : {type: Array}}],
        data(){
            return{
                messages: [],
                users :[],
                projectView : "title"
            }
        },
        mounted() {
            let base = 0;
            for(let i = 1 ;i<=3 ; i++){
                let comments = [];
                comments.push ({
                    "id" : base + 1,
                    "origin" : "Ruan Santana12 Jan",
                    "text" : "Galera, mensagem para fim de teste! hahahah"
                });
                comments.push ({
                    "id" : base + 2,
                    "origin" : "Ruan Santana12 Jan",
                    "text" : "Era só para entender como a galera se comunica na agencia! agora ja entendi!"
                });
                
                this.messages.push({
                    "id" : i,
                    "title" : 'Galera, mensagem para fim de teste! hahahah',
                    "origin" : 'Started 12 Jan by @Ruan Santana',
                    "comments" : comments 
               });
               base = base + 2
            }                 
        }
    }
</script>


