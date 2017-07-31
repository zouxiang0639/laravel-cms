@extends($layout)

@section('content')
    {!! Menu::adminMenuBls()->categoryMenu(array_merge(Input::get(), ['id' => $info->id])) !!}
    @include($prefix.'.category.form.create', ['route' => route('admin.category.update', ['id' => $info->id])])
@stop