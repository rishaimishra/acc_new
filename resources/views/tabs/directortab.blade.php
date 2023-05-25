<ul class="nav nav-tabs">
	<li class="nav-item">
		<a  href="{{route('directornonassigned')}}" class="nav-link {{ 'director/nonassignedcases' == request()->path() ? 'active' : 'hov' }}">Non Assigned</a>
	</li>
	<li class="nav-item">
		<a href="{{route('directorassigned')}}" class="nav-link  {{ 'director/assignedcases' == request()->path() ? 'disabled active' : 'hov' }}">Assigned</a>
	</li>
</ul>