

	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a href="{{route('viewinvestigationplan', $casenoid)}}" class="nav-link {{ 'investigator/investigationplan/'.$casenoid == request()->path() ? 'active' : 'hov' }}" >Overview</a>
		</li>
		<li class="nav-item">
			<a href="{{route('viewhypo', $casenoid)}}" class="nav-link  {{ 'investigator/hypothesisandevidence/'.$casenoid == request()->path() ? 'active disabled' : 'hov' }}">Hypothesis and Evidence</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ 'investigator/actionplan/'.$casenoid == request()->path() ? 'active disabled' : 'hov' }}" href="{{route('viewactionplan', $casenoid)}}">Action Plan</a>
		</li>
		@if(Auth::user()->role == "Investigator")
			<i  class="fa fa-location-arrow ml-auto" onclick="aa()" style="color:green" onmouseover="this.style.color='#333333';" onmouseout="this.style.color='green';" data-toggle="tooltip" data-placement="bottom" title="Send for Evaluation"></i>
		@endif
		
	</ul>

	<script>
		function aa()
		{
			
			alert("Sent for evaluation");
		}
	</script>
