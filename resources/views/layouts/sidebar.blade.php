
<aside class = "main-sidebar sidebar-no-expand sidebar-mini-xs sidebar-dark-primary" style="background-color:#5E6366; ">
    <div class = "sidebar sidebar-no-expand">
        <div class = "user-panel mt-2 pb-2 mb-2 d-flex">
            <div class = "image">
                <img src = "{{ (!empty($adminData->profile_image))? url('upload/admin_images/'.$adminData->profile_image):url('upload/no_image.jpg') }}" class="rounded-circle header-profile-user" alt="User Image" style="height:35px;width:35px;">
            </div>
            <div class = "info">
                <a href = "" class="d-block">{{ $adminData->name }}</a>
            </div>
        </div>
     <br>
      <!-- Sidebar Menu -->
        <nav class = "mt-2" >
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                            <p> Dashboard </p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('mycases') }}" class="nav-link">
                        <i class="nav-icon fas fa-briefcase"></i>
                            <p> My Case </p>
                    </a>
                </li>
            </ul>

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('complaint-register.list') }}" class="nav-link">
                       <i class="fa fa-registered" aria-hidden="true"></i>
                            <p>Register Complaint</p>
                    </a>
                </li>
            </ul>


            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('assign.complaint') }}" class="nav-link">
                       <i class="fa fa-assistive-listening-systems" aria-hidden="true"></i>
                            <p>Assign Complaint</p>
                    </a>
                </li>
            </ul>


            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('assign.complaint.regional') }}" class="nav-link">
                       <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <p>Regional Assign Complaint</p>
                    </a>
                </li>
            </ul>


            @if((Auth::user()->role=='Director') && (Auth::user()->department=='Department of Investigation'))
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('directornonassigned') }}" class="nav-link">
                        <i class="nav-icon fas fa-briefcase"></i>
                            <p> Cases </p>
                    </a>
                </li>
            </ul>
            @elseif((Auth::user()->role=='Investigator') && (Auth::user()->department=='Department of Investigation'))
            
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('mycases') }}" class="nav-link">
                        <i class="nav-icon fas fa-briefcase"></i>
                            <p> Task </p>
                    </a>
                </li>
            </ul>
            @endif
        </nav>     
      <!-- /.sidebar-menu -->
    </div>
    </aside>