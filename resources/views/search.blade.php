@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="/search">
                <div class="input-group">
                    <input type="text" class="form-control h50" name="query" placeholder="关键字..." value="{{ $q }}">
                    <span class="input-group-btn"><button class="btn btn-default h50" type="submit" type="button"><span class="glyphicon glyphicon-search"></span></button></span>
                </div>
            </form>
        </div>
    </div>
    @if($q)
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default list-panel search-results">
                    <div class="panel-heading">
                        <h3 class="panel-title ">
                            <i class="fa fa-search"></i> 关于 “<span class="highlight">{{ $q }}</span>” 的搜索结果, 共 {{ $paginator->total() }} 条
                        </h3>
                    </div>

                    <div class="panel-body ">
                        @foreach($paginator as $post)
                            <div class="result">
                                <h2 class="title">
                                    <a href="{{ $post->url }}" target="_blank">
                                        @if (isset($post->highlight['title']))
                                            @foreach ($post->highlight['title'] as $item)
                                                {!! $item !!}
                                            @endforeach
                                        @else
                                            {{ $post->title }}
                                        @endif
                                    </a>
                                </h2>
                                <div class="info">
                                </div>
                                <div class="desc">
                                    @if (isset($post->highlight['content']))
                                        @foreach ($post->highlight['content'] as $item)
                                            ......{!! $item !!}......
                                        @endforeach
                                    @else
                                        {{ mb_substr($post->content, 0, 150) }}......
                                    @endif
                                </div>
                                <hr>
                            </div>
                        @endforeach
                    </div>
                    {{ $paginator->links() }}
                </div>
            </div>
        </div>
    @else
        <div class="row text-center">
            <div class="col-md-12">
                <br>
                <h2>你会搜索到什么？</h2>
                <br>
                <p>学习学习再学习公众号所有文章</p>
            </div>
        </div>
    @endif
@endsection