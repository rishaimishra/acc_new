

	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a href="{{route('viewevidence', $casenoid)}}" class="nav-link {{ 'investigator/evidence/'.$casenoid  == request()->path() ? 'active' : 'hov' }}" >Tag Evidence</a>
		</li>
		<li class="nav-item">
			<a href="{{route('viewevidencematrix', $casenoid)}}" class="nav-link  {{ 'investigator/evidencematrix/'.$casenoid  == request()->path() ? 'active disabled' : 'hov' }}">Matrix</a>
		</li>
		
	</ul>
