@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    @foreach (array_unique($errors->all()) as $error)
        <li class="font-weight-bold">{{ $error }}</li>
    @endforeach
</div>
@endif