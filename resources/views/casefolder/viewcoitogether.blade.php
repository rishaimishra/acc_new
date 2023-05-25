   
<table  class="table">
    <thead>
        <tr>
            <th>Conflict Declarant:</th>
            <th>Nature of Conflict</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($coifiles as $coifiles)
        <tr>
            <td>{{ $coifiles->name }}</td>
            <td>
                @if ($coifiles->nature_of_conflict == "No Conflict") 
                  Negative   
                @else
                    {{ $coifiles->nature_of_conflict }}
                @endif
            </td>
            <td>
                @if($coifiles->declared_by == "Investigator" && $coifiles->nature_of_conflict != "No Conflict")
                      <button type="button" class="btn btn-danger btn-sm" onclick="showmodalreplaceinvestigator('{{ $coifiles->email }}')" >REPLACE</button>
                @endif
            </td>
            
        </tr>
      @endforeach
    </tbody>
</table>

<script>
    function showmodalreplaceinvestigator(email)
        {
             $('#existinginvemail').val(email);
             $('#show_modal_replace_investigator').modal('show');
        
        }

    function closereplacemodal()
        {
            $('#show_modal_replace_investigator').modal('hide');
        }
    
    
</script>
