

	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a href="{{route('viewsearch', $casenoid)}}" class="nav-link {{ 'investigator/search/'.$casenoid  == request()->path() ? 'active' : 'hov' }}" >Search</a>
		</li>
		<li class="nav-item">
			<a href="{{route('viewseizure', $casenoid)}}" class="nav-link  {{ 'investigator/seizure/'.$casenoid  == request()->path() ? 'active disabled' : 'hov' }}">Seizure</a>
		</li>
		
	</ul>
