@layout('master')

@section('content')
{{ Form::open('user/item/post') }}
    <!-- check for login errors flash var -->
    @if (Session::has('item_post_errors'))
        <span class="error">Failed to save new item</span>
    @endif
    <!-- item name field -->
    <p>{{ Form::label('name', 'Name') }}</p>
    <p>{{ Form::text('name') }}</p>
    <!-- price field -->
    <p>{{ Form::label('price', 'Price') }}</p>
    <p>{{ Form::text('price') }}</p>
    <!-- price field -->
    <p>{{ Form::label('descriptor', 'Description') }}</p>
    <p>{{ Form::textarea('descriptor') }}</p>
    <!-- submit button -->
    <p>{{ Form::submit('Save') }}</p>
{{ Form::close() }}

@endsection