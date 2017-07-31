@extends($layout)

@section('content')
    {!! Menu::adminMenuBls()->categoryMenu(Input::get()) !!}
    @include($prefix.'.category.form.create', ['route' => route('admin.category.store')])
@stop

