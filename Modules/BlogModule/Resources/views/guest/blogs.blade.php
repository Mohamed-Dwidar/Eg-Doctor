@extends('layoutmodule::front.main')

@php
    $page_title = "Blog";

    $breadcrumb[] = ['title' =>'Home', 'url' => route('home_page')];
    $breadcrumb[] = ['title' => 'Blogs', 'url' => route('guest.blogs')];

    $page_meta['title'] = "Blog";
    $page_meta['description'] = "Read our latest blogs and articles on coworking, entrepreneurship, and business growth. Stay updated with industry insights and tips to thrive in the modern workspace.";
    $page_meta['keywords'] = "coworking blog, business growth articles, entrepreneurship tips, coworking space insights, modern workspace trends, startup advice, business success stories, coworking community news";
    $page_meta['image'] = "";
@endphp

@section('content')

    <!-- Start Blog Area -->
    <section class="blog-area ptb-100">
        <div class="container">
            <div class="row">
                @foreach ($blogs as $blog)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog-post">
                            <div class="post-image">
                                <a href="{{ route('guest.singleBlog', $blog->id) }}">
                                    <img src="{{ $blog->imageFullPath }}" alt="{{ $blog->img_alt ?? $blog->name }}"
                                        style="height: 250px; width: 100%; object-fit: cover;">
                                </a>

                                <div class="date"><i class="flaticon-calendar"></i>
                                    {{ $blog->created_at->format('Y/m/d') }}</div>
                            </div>

                            <div class="post-content">
                                <h3><a href="{{ route('guest.singleBlog', $blog->id) }}">{{ $blog->name }}</a></h3>
                                {{-- <p>Quis ipsum suspendisse ultrices. Risus commodo viverra maecenas accumsan lacus vel
                                    facilisis.</p> --}}

                                {{-- <a href="{{ route('guest.singleBlog', $blog->id) }}" class="default-btn">Read More
                                    <span></span></a> --}}
                            </div>
                        </div>
                    </div>
                @endforeach


                <div class="col-lg-12 col-md-12">
                    <div class="pagination-area">
                        {{ $blogs->links('blogmodule::guest.partials.pagination') }}
                        {{--  <a href="#" class="prev page-numbers"><i class="fas fa-angle-double-left"></i></a>
                            <a href="#" class="page-numbers">1</a>
                            <span class="page-numbers current" aria-current="page">2</span>
                            <a href="#" class="page-numbers">3</a>
                            <a href="#" class="page-numbers">4</a>
                            <a href="#" class="next page-numbers"><i class="fas fa-angle-double-right"></i></a> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Blog Area -->
@endsection
