@props(['errors'])

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button class="close" type="button" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
