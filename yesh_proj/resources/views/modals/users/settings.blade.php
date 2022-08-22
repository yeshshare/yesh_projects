<div class="modal fade" id="settings_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="form_title" class="modal-title" id="exampleModalLabel">Account settings</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @includeif('partials.errors')
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="notifications-tab" data-bs-toggle="tab" data-bs-target="#notifications" type="button" role="tab" aria-controls="notifications" aria-selected="true">Notifications</button>
            </li>            
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="account-tab" data-bs-toggle="tab" data-bs-target="#account" type="button" role="tab" aria-controls="account" aria-selected="false">Account</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="layout-tab" data-bs-toggle="tab" data-bs-target="#layout" type="button" role="tab" aria-controls="layout" aria-selected="false">Layout</button>
            </li>
            
          </ul>
          <br>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              @include('modals.users.profile')
            </div>
            <div class="tab-pane fade" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
              home
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
              contact
            </div>
            <div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="account-tab">
              @include('modals.users.account')
            </div>
            <div class="tab-pane fade" id="layout" role="tabpanel" aria-labelledby="account-layout">
              @include('modals.users.layout')
            </div>
          </div>          
        </div>     
      </div>
    </div>
  </div> 
   