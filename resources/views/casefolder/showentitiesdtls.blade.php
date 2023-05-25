@foreach ($entitydetailsshow as $showentitydtls)
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Name:</label> {{ $showentitydtls->name }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>CID:</label>  {{ $showentitydtls->identification_no }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Date of Birth:</label> {{ $showentitydtls->dateofbirth }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Gender:</label>  {{ $showentitydtls->gender }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Phone No:</label>  {{ $showentitydtls->contactno }}
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="form-group">
                @if($showentitydtls->email == "")
                <label>Email:</label>
                No email available
                @else
                {{ $showentitydtls->email }}
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Address:</label>  {{ $showentitydtls->address }}
            </div>
        </div>
         <div class="col-md-4">
            <div class="form-group">
                <label>Nationality:</label> {{ $showentitydtls->type }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
               
            </div>
        </div>
    </div>
@endforeach
    