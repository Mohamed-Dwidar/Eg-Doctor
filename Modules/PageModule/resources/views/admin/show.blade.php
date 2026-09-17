@extends('layoutmodule::admin.main')

@section('title')
اضافه صفحة جديدة
@endsection

@section('content')


<div class="content-wrapper container-fluid">
    <div class="content-header">
        <div class="content-header-left mb-2 breadcrumb-new col">
            <h3>
                {{$page->title}}
            </h3>
        </div>
    </div>

    @include('layoutmodule::admin.flash')

    <div class="content-body">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            {{-- <div class="col-5">
                                <h2> الدورات</h2>
                            </div> --}}
                            <div class="col-lg-10"></div>
                            <div class="col-lg-2">
                                {{-- <a class="btn btn-success" href="{{route('admin.pages.add_date',$page->id)}}"
                                role="button">أضافه موعد جديد</a> --}}
                                <a class="btn btn-warning" href="{{route('admin.pages.edit',$page->id)}}"
                                    role="button">{{__('messages.edit')}}</a>
                                <a href="{{ route('admin.pages.delete',[$page->id])}}"
                                    onclick="return confirm('هل انت متأكد انك تريد Remove هذه الصفحة ؟')"
                                    class="btn btn-danger" role="button">{{__('messages.delete')}}</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="card-block">
                            <dl class="row">
                                <dt class="col-sm-12" style="text-align: center;margin-bottom: 20px">
                                    @if($page->image != null)
                                    <img src="{{url('uploads/pages/' . $page->image)}}" width="250px" />
                                    @else
                                    <img src="{{url('uploads/pages/default.png')}}" width="100px" height="100px" />
                                    @endif
                                </dt>
                                <dt class="col-sm-3">اسم الصفحة</dt>
                                <dd class="col-sm-9">{{$page->title}}</dd>

                                <dt class="col-sm-3">الصفحة الاعلي</dt>
                                <dd class="col-sm-9">
                                    @if($page->parent_id == 0)
                                    --
                                    @else
                                    {{$page->parent->title}}
                                    @endif                                    
                                </dd>

                                <dt class="col-sm-3">تفاصيل الصفحة</dt>
                                <dd class="col-sm-9">{!!$page->content!!}</dd>
                            </dl>
                        </div>

                         
                    </div>










                </div>
            </div>
        </div>
    </div>
</div>


@endsection
