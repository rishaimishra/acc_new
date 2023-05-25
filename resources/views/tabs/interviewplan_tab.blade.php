

	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a href="{{	route('viewinterviewplan', $casenoid)}}" class="nav-link {{ 'investigator/interviewplan/'.$casenoid == request()->path() ? 'active' : 'hov' }}" >Plan</a>
		</li>
		<li class="nav-item">
			<a href="{{	route('viewsummonorder', $casenoid)}}" class="nav-link  {{ 'investigator/summonorder/'.$casenoid == request()->path() ? 'active disabled' : 'hov' }}">Summon Order</a>
		</li>
		
	</ul>
