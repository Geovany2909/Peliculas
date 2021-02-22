@foreach (['warning', 'success', 'info'] as $msg)
@if(Session::has('alert-' . $msg))
<script type="text/javascript">
	Swal.fire({ 
		title: "", 
		text: "{{ Session::get('alert-' . $msg) }}", 
		type: "{{ $msg }}", 
		confirmButtonClass: "btn btn-primary", 
		buttonsStyling: !1 
	})
</script>
@endif
@endforeach

@foreach (['error'] as $msg)
@if(Session::has('alert-' . $msg))
<script type="text/javascript">
	Swal.fire({	
		title: "Error!", 
		text: "{{ Session::get('alert-' . $msg) }}", 
		type: "{{ $msg }}", 
		confirmButtonClass: "btn btn-primary", 
		buttonsStyling: !1 
	})
</script>
@endif
@endforeach

@if($errors->any())
<script type="text/javascript">
	Swal.fire({	
		title: "Error!", 
		text: "Revise la información ingresada", 
		type: "error", 
		confirmButtonClass: "btn btn-primary", 
		buttonsStyling: !1 
	})
</script>
@endif