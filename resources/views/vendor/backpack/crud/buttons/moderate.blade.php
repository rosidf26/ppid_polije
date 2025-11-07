@if ($crud->hasAccess('update'))
	@if (!$crud->model->translationEnabled())

	<!-- Single edit button -->
	<a href="{{ url($crud->route.'/'.$entry->getKey().'/moderate') }}" class="btn btn-xs btn-info"><i class="la la-edit"></i> Reply Tickets</a>

	@else

	<!-- Edit button group -->
	<div class="btn-group">
	  <a href="{{ url($crud->route.'/'.$entry->getKey().'/moderate') }}" class="btn btn-xs btn-info pr-0"><i class="la la-edit"></i> Reply</a>
	</div>

	@endif
@endif
