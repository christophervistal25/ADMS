@if(\Session::has('success'))
<div class="alert alert-success alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    </button>
    {{ \Session::get('success') }}
</div>
@endif