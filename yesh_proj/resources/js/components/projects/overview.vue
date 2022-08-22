<style >
  .main{
      background-color: white;
  }
  .title-label{
      border-bottom: 1px black solid;
      margin-bottom: 5px;
  }
  .content-box{
      margin-top: 50px;
      max-width: 800px;
  }
  .menu-button-project{
      border-radius: 10px;
  }
  .icon-button {
      width: 48px;
      height: 48px;
      background-repeat:no-repeat;
      background-position: center;
      border-radius: 12px;
  }
  .icon-button-big {
      width: 100%;
      height: 100px;
      background-repeat:no-repeat;
      background-position: center;
      border-radius: 12px;
  }
  
  .active_details{
      opacity: 1;
  }
  .inactive_details{
      opacity: 0;
  }

  .icon-list-button-big {
      height: 45px;
  }
  .menu-icon-option{
      background-color: white;
  }
  .center-line{
      align-items: center;
      width: 100%;
      margin-left: 0;
  }
  .base-line{
      align-items: baseline;
      width: 100%;
      margin-left: 0;
      text-align: center;
  }
  .description {
      padding-bottom: 6px;
  }
  .img-user{
      width: 24px;
      height: 24px;
  }
  .icon-span::houve{
      background-color: blue;
  }
  .projectView-active{
      display: block;
  }
  .projectView-inactive{
      display: none;
  }
  .project-title-line{
      margin: 10px 0 10px 0;
  }
  /*.col-md .col-xl .col-md .col-xxl)*/
  @media (min-width: 1281px) {
      .icon-button{
          display: block;
      }
  }
  /* ##Device = Laptops, Desktops ##Screen = B/w 1025px to 1280px ## .col-md .col-xl */
  @media (min-width: 1025px) and (max-width: 1280px) {
      .icon-button{
          display: block;
      }
  }
  /* ##Device = Tablets, Ipads (portrait) ##Screen = B/w 768px to 1024px ## .col-md .col-lg */
  @media (min-width: 768px) and (max-width: 1024px) and (orientation: portrait) {
      .icon-button{
          display: block;
      }
  }
  /* ##Device = Low Resolution Tablets, Mobiles (Landscape) ##Screen = B/w 481px to 767px ## .col-sm- */
  @media (min-width: 481px) and (max-width: 767px) {
      .icon-button{
          display: none;
      }
  }
  /* ##Device = Most of the Smartphones Mobiles (Portrait) ##Screen = B/w 320px to 479px ## .col- */
  @media (min-width: 320px) and (max-width: 480px) {
      .icon-button{
          display: none;
      }
  }

</style>
<template>
  <div class="tab-pane fade show active" id="overview" role="tabpanel"  aria-labelledby="overview-tab" >
    <div class="container content-box">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
          <div class="title-label description">
            <span> Descrption</span>
          </div>
          <div>
            <textarea class="form-control"  name="descrption" id="descrption" cols="20" rows="3" ></textarea>
          </div>
          <div class="title-label">
            <div class="row center-line">
              <div class="col-4">
                <span> Members</span>
              </div>
              <div class="col-8">
                <button type="text" class="btn btn-sm button-message" data-bs-toggle="modal" data-bs-target="#message_modal">
                  <i class="fa fa-comment-o" aria-hidden="true"></i>
                  Send message
                </button>	
              </div> 
            </div>
          </div>
          <div :id="`user${user.id}`" v-for="user in users" :key="user.id">
            <div class="row center-line">
              <div class="col-2">
                <img  class="img-user rounded-circle" :src="`data:image/jpeg;base64,${user.img}`" />
              </div>
              <div class="col-10">{{ user.name }}<br />{{ user.email }}</div>
            </div>
            <hr />
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
          <div class="title-label">
            <div class="row center-line">
              <div class="col-11">
                <span> Projects</span>
              </div>
              <div class="col-1">
                <span
                  class="icon list-mode"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                ></span>
                <ul class="dropdown-menu">
                  <li>
                    <a
                      class="dropdown-item"
                      href="#"
                      v-on:click="selectProjectView('title')"
                      ><span class="icon folder menu-icon-option"></span
                      >&nbsp;View as title</a
                    >
                  </li>
                  <li>
                    <a
                      class="dropdown-item"
                      href="#"
                      v-on:click="selectProjectView('list')"
                      ><span class="icon folder menu-icon-option"></span
                      >&nbsp;View as list</a
                    >
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div
            id="list" 
            :class="`${projectView == 'list'? 'projectView-active':'projectView-inactive'}`"
          >
            <div
              :id="`project${project.id}`"
              v-for="project in projects"
              :key="project.id"
            >
              <div class="row center-line">
                <div
                  :class="`col-1 icon-button list-round-bullet ${project.logo}`"
                ></div>
                <div class="col-8">{{ project.title }}</div>
                <div class="col-2"  >
                  <img  class="img-user rounded-circle" :src="`data:image/jpeg;base64,${employee.img}`" v-for="employee in project.employees" :key="employee.id" />
                </div>
                <div class="col-1">
                  <span
                    class="icon icon-span"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    ...
                  </span>
                  <ul class="dropdown-menu">
                    <li>
                      <a class="dropdown-item" href="#"
                        ><span class="icon share menu-icon-option"></span
                        >&nbsp;Share...</a
                      >
                    </li>
                    <li>
                      <a class="dropdown-item" href="#"
                        ><span class="icon star-1 menu-icon-option"></span
                        >&nbsp;Add Favorites</a
                      >
                    </li>
                    <li>
                      <a class="dropdown-item" href="#"
                        ><span class="icon edit-gray menu-icon-option"></span
                        >&nbsp;Edit profile detais</a
                      >
                    </li>
                    <li>
                      <a class="dropdown-item" href="#"
                        ><span class="icon copy-link menu-icon-option"></span
                        >&nbsp;Copy project link</a
                      >
                    </li>
                  </ul>
                </div>
              </div>
              <hr />
            </div>
          </div>
          <div
            id="title"
            :class="`${projectView == 'title' ? 'projectView-active' : 'projectView-inactive' }`"
          >
            <div>
              <div class="row base-line">
                <div
                  :id="`project${project.id}`"
                  class="col-6 col-sm-6 col-md-2 col-lg-3 col-xl-3  col-3"
                  v-for="project in projects"
                  :key="project.id"
                >
                  <div class="row">
                    <div class="col-12">
                      <div 
                        :class="`icon-button-big ${project.logo}`"
                        v-on:mouseover="viewDetails(true,project.id)"
                        v-on:mouseleave="viewDetails(false,project.id)" 
                      >
                        <div
                          :id="`detailsMenu${project.id}`"  
                          class="row inactive_details"
                        >
                          <div class="col-6"></div>
                          <div class="col-4">
                            <span
                              class="icon icon-span"
                              data-bs-toggle="dropdown"
                              aria-expanded="false"
                              style="color:#fff"
                            >
                              ...
                            </span>
                            <ul class="dropdown-menu">
                              <li>
                                <a class="dropdown-item" href="#"
                                  ><span class="icon share menu-icon-option"></span
                                  >&nbsp;Share...</a
                                >
                              </li>
                              <li>
                                <a class="dropdown-item" href="#"
                                  ><span class="icon star-1 menu-icon-option"></span
                                  >&nbsp;Add Favorites</a
                                >
                              </li>
                              <li>
                                <a class="dropdown-item" href="#"
                                  ><span class="icon edit-gray menu-icon-option"></span
                                  >&nbsp;Edit profile detais</a
                                >
                              </li>
                              <li>
                                <a class="dropdown-item" href="#"
                                  ><span class="icon copy-link menu-icon-option"></span
                                  >&nbsp;Copy project link</a
                                >
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="row">  
                          <div class="col-12 icon-list-button-big">
                            <span class="list-round-bullet"></span>
                          </div>
                        </div>
                        <div
                          :id="`detailsImage${project.id}`"  
                          class="row inactive_details"
                        > 
                          <div class="col-12">
                            <img  class="img-user rounded-circle" :src="`data:image/jpeg;base64,${employee.img}`" v-for="employee in project.employees" :key="employee.id" />
                          </div>
                        </div>
                        
                      </div>
                    </div>
                    <div class="col-12 project-title-line">
                    <a :href="`/employee/projects/${project.id}`"><span>{{ project.title }}</span></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
                projects: [],
                users :[],
                usersIMG:[],
                projectView : "title",
                details : false,
                linkProject : ""
            }
        },
        mounted() {
            /*
            let classes = ["","icon-button-gray","icon-button-darkmagenta","icon-button-darkred","icon-button-seagreen"];
            for(let i = 1 ;i<=4 ; i++){
               this.projects.push({"id" : i,"name" : `Project ${i}`,"logo" : classes[i] });
            }*/                 
        }, methods: {
            selectProjectView(projectView){
              this.projectView = projectView;
            },
            viewDetails(view,id){
              let className = view ? "row active_details" : "row inactive_details" ;
              let detailsMenu = document.getElementById(`detailsMenu${id}`);
              let detailsImage = document.getElementById(`detailsImage${id}`);
              detailsMenu.className = className;
              detailsImage.className = className;  
            }
        },
        beforeMount(){
            let qtdUser = parseInt(document.getElementById('qtdUser').value)
            for(let userCount=0; userCount < qtdUser;userCount++){
                let userID =  `userData${userCount}`;
                let user = document.getElementById(userID);
                this.users.push(JSON.parse(user.value)); 
                if(userCount < 4){
                  this.usersIMG.push(JSON.parse(user.value))
                }   
            }
            let qtdProject = parseInt(document.getElementById('qtdProject').value)
            for(let projectCount=0; projectCount < qtdProject;projectCount++){
                let projectID =  `projectData${projectCount}`;
                let project = document.getElementById(projectID);
                this.projects.push(JSON.parse(project.value));    
            }
        }
    }
</script>