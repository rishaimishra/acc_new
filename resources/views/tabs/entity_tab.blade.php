

	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a href="{{	route('viewperson', $casenoid)}}" class="nav-link {{ 'investigator/person/'.$casenoid == request()->path() ? 'active' : 'hov' }}" >Person</a>
		</li>
		<li class="nav-item">
			<a href="{{	route('vieworganization', $casenoid)}}" class="nav-link  {{ 'investigator/organization/'.$casenoid == request()->path() ? 'active disabled' : 'hov' }}">Organization</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ 'investigator/asset/'.$casenoid == request()->path() ? 'active disabled' : 'hov' }}" href="{{ route('viewasset', $casenoid)}}">Asset</a>
		</li>
	</ul>
