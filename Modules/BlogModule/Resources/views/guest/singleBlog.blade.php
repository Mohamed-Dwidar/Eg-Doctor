@extends('layoutmodule::front.main')

@php
    $page_title = $blog->name;

    $breadcrumb[] = ['title' =>'Home', 'url' => route('home_page')];
    $breadcrumb[] = ['title' => 'Blogs', 'url' => route('guest.blogs')];

    $page_meta['title'] = $blog->seo->title ?? $blog->name;
    $page_meta['description'] = $blog->seo->description ?? $blog->name;
    $page_meta['keywords'] = $blog->seo->keywords ?? "";
    $page_meta['image'] = $blog->imageFullPath;
@endphp


@section('content')
      <!-- Start Blog Details Area -->
        <section class="blog-details-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="blog-details-desc">
                            <div class="article-image">
                                <img src="{{ $blog->imageFullPath }}" alt="{{ $blog->img_alt ?? $blog->name }}"
                                    style="width: 100%; max-width: 100%; height: 400px; object-fit: cover;">
                            </div>

                            <div class="article-content">
                                {{-- <div class="entry-meta">
                                    <ul>
                                        <li><span>Posted On:</span> <a href="#">September 31, 2024</a></li>
                                        <li><span>Posted By:</span> <a href="news-2.html">John Anderson</a></li>
                                    </ul>
                                </div> --}}

                                <h2>{{ $blog->name }}</h2>
                                {!! $blog->description !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12">
                        <aside class="widget-area" id="secondary">

                             @if ($relatedBlogs->isNotEmpty())
                            <section class="widget widget_zash_posts_thumb">
                                <h3 class="widget-title">Popular Posts</h3>
                                @foreach ($relatedBlogs as $related)
                                    <article class="item">
                                        <a href="{{ route('guest.singleBlog', $related->id) }}" class="thumb">
                                            <span class="fullimage cover bg1" role="img">
                                                <img src="{{ $related->imageFullPath }}"
                                                     alt="{{ $related->img_alt ?? $related->name }}"
                                                     style="height: 80px; width: 100%; object-fit: cover;">
                                            </span>
                                        </a>
                                        <div class="info">
                                            {{-- <time datetime="{{ $related->created_at->format('Y-m-d') }}">{{ $related->created_at->format('F d, Y') }}</time> --}}
                                            <h4 class="title usmall"><a href="{{ route('guest.singleBlog', $related->id) }}">{{ $related->name }}</a></h4>
                                        </div>

                                        <div class="clear"></div>
                                    </article>
                                @endforeach
                            </section>
                            @endif
                        </aside>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Blog Details Area -->


@endsection


<?php /* @extends('layoutmodule::public.main-page')

@section('content')
    <!-- ==== banner start ==== -->
    <section class="cmn-banner blog-single bg-img" data-background="{{ asset('assets/images/banner/cmn-banner-bg.png') }}">
        <div class="container">
            <div class="row gaper align-items-center">
                <div class="col-12 col-lg-12 col-xl-12">
                    <div class="text-center text-lg-start">
                        <h1 class="title">{{ $blog->name }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==== / banner end ==== -->

    <!-- ==== blog details start ==== -->
    <section class="section contact-m mb-0 blog-single">
        <div class="container">
            <div class="row gaper">
                <div class="col-12">
                    <div class="map-wrapper">
                        <div class="row gaper">
                            <div class="col-12 col-lg-12">
                                <div class="row contact-main__form">
                                    <div class="col-12 col-lg-12">

                                        <div class="bd-thumb mb-4 text-center">
                                            <img src="{{ $blog->imageFullPath }}"
                                                 alt="{{ $blog->img_alt ?? $blog->name }}"
                                                 style="width: 600px; max-width: 100%; height: 400px; object-fit: cover;">
                                        </div>

                                        {{-- <p class="mb-3">
                                            <b><u>Date</u> :</b> {{ $blog->created_at->format('Y/m/d') }}
                                        </p> --}}

                                        <div class="primary-text">
                                            {!! $blog->description !!}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==== / blog details end ==== -->

    <!-- ==== related blogs start ==== -->
    @if ($relatedBlogs->isNotEmpty())
        <section class="section blog-main fade-wrapper pt-0">
            <div class="container">
                <div class="section__header mb-4">
                    <h3 class="h3">Related Blogs</h3>
                </div>
                <div class="row gaper">
                    @foreach ($relatedBlogs as $related)
                        <div class="col-12 col-md-6 col-xl-3">
                            <div class="blog-main__single fade-top">
                                <div class="thumb">
                                    <div class="thumb-link">
                                        <a href="{{ route('guest.singleBlog', $related->id) }}">
                                            <img src="{{ $related->imageFullPath }}"
                                                 alt="{{ $related->img_alt ?? $related->name }}"
                                                 style="height: 200px; width: 100%; object-fit: cover;">
                                        </a>
                                    </div>
                                </div>
                                <div class="content">
                                    <h4 class="h4">
                                        <a href="{{ route('guest.singleBlog', $related->id) }}">
                                            {{ $related->name }}
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!-- ==== / related blogs end ==== -->
@endsection
*/ ?>
