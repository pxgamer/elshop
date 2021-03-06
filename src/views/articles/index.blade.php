@extends('layouts.admin')

@section('header')
  <h1>@lang('elshop::article.articles')</h1>
@stop

@section('content')

  <div class="row" style="margin-bottom:20px">
    <div class="col-xs-5 pull-left">
      <a href="{{ route($prefix . 'articles.create') }}" class="btn btn-primary">@lang('elshop::article.add')</a>
    </div>

    {{ Form::open(array('route' => $prefix . 'articles.index', 'method' => 'GET')) }}
    <div class="col-xs-5">
      {{ Form::text('search', null, array('class' => 'form-control', 'placeholder' => '')) }}
    </div>
    {{ Form::submit('search', array('class' => 'btn')) }}
    {{ Form::close() }}
  </div>

  <div class="box box-primary">
    <div class="box-body no-padding">
      <table class="table">
        <thead>
          <tr>
            <th>@lang('elshop::article.name')</th>
            <th class="text-center">@lang('elshop::article.price')</th>
            <th class="text-center">@lang('elshop::article.purchasing_price')</th>
            <th class="text-center">@lang('elshop::article.brand')</th>
            <th class="text-center">@lang('elshop::article.weight')</th>
            <th></th>
          </tr>
        </thead>
        @foreach ($articles as $article)
          <tr>
            <td>
              <a href="{{ route($prefix . 'articles.edit', $article->id) }}">
                @if (isset($article->content->name))
                  {{ $article->content->name }}
                @endif
              </a>
            </td>
            <td class="text-center">{{ number_format($article->purchasing->price / 100, 2, '.', "'") . ' ' . $article->purchasing->currency->sign }}</td>
            <td class="text-center">{{ $article->formatPrice() }}</td>
            <td class="text-center">{{ $article->brand->name }}</td>
            <td class="text-center">{{ $article->weight }} KGr.</td>
            <td class="text-center">
              @if ($article->status)
                <a href="{{ route($prefix . 'articles.status', $article->id) }}" class="btn btn-success btn-xs">Actif</a>
              @else
                <a href="{{ route($prefix . 'articles.status', $article->id) }}" class="btn btn-danger btn-xs">Inactif</a>
              @endif
            </td>
            <td class="text-right">
              <div class="pull-right">
                <div class="btn-group">
                  {{ Form::open(array('route' => array($prefix . 'articles.edit', $article->id), 'method' => 'GET')) }}
                  {{ Form::button(trans('elshop::article.edit'), array('class' => 'btn btn-primary btn-xs', 'type' => 'submit')) }}
                  {{ Form::close() }}
                </div>
                <div class="btn-group">
                  {{ Form::open(array('route' => array($prefix . 'articles.destroy', $article->id), 'method' => 'DELETE')) }}
                  {{ Form::button(trans('elshop::article.delete'), array('class' => 'btn btn-danger btn-xs', 'type' => 'submit')) }}
                  {{ Form::close() }}
                </div>
              </div>
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
  {{ $articles->links() }}
@stop
