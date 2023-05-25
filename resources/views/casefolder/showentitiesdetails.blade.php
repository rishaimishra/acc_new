@foreach ($entitydetailsshow as $showentitydtls)
<link rel ="stylesheet" href="https://fonts.googleapis.com/css2?family=Product+Sans&display=swap" >    
 @php
          $id = Auth::user()->id;
          $adminData = App\Models\User::find($id);
      @endphp
<table class="table " style="font:Product Sans">
        <thead >
            <tr>
                <th>BioData</th>
                <th>Photo</th>
                <th>Background</th>
            </tr>
        </thead>
        <tbody>
            <tr>   
                <td>
                    <label>Name:</label>&nbsp;&nbsp; {{ $showentitydtls->name }}<br>
                    <label>CID:</label> &nbsp;&nbsp; {{ $showentitydtls->identification_no }}<br>
                    <label>Date of Birth:</label> &nbsp;&nbsp;{{ $showentitydtls->dateofbirth }}<br>
                    <label>Gender:</label> &nbsp;&nbsp; {{ $showentitydtls->gender }}<br>
                    <label>Phone No:</label> &nbsp;&nbsp; {{ $showentitydtls->contactno }}<br>
                    @if($showentitydtls->email == "")
                    <label>Email:</label>&nbsp;&nbsp;
                    No email available
                    @else
                    {{ $showentitydtls->email }}
                    @endif <br>
                    <label>Nationality:</label> &nbsp;&nbsp;{{ $showentitydtls->type }}<br>
                    <label>Address:</label>&nbsp;&nbsp;  {{ $showentitydtls->address }}
                </td>
                <td>
                    <img src = "{{ (!empty($adminData->profile_image))? url('upload/admin_images/'.$adminData->profile_image):url('upload/no_image.jpg') }}" class="rounded-circle header-profile-user" alt="User Image" style="height:135px;width:135px;">
                </td>
                <td>
                    Case 133
                    Case 454
                </td>
            </tbody>
    </table>
     
@endforeach
    