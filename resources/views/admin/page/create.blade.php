@extends($layout)

@section('content')
    {!! Menu::adminMenuBls()->pageMenu(Input::get()) !!}
    @include($prefix.'.page.form.create', ['route' => route('admin.page.store')])
@stop

