@extends('layoutmodule::'.Auth::getDefaultDriver().'.main')

@section('title')
استعراض الأقسام الفرغية
@endsection

@push('styles')

@endpush
@section('content')

<div class="content-header">
    <div class="content-header-left mb-2 breadcrumb-new col">
        <h3>
            <i class="icon-grid"></i>
            استعراض الأقسام


            <a class="btn btn-success add-new-btn" href="{{route('admin.pages.add')}}" role="button">قسم
                جديد</a>
        </h3>


    </div>
</div>

@include('layoutmodule::'.Auth::getDefaultDriver().'.flash')


<div class="content-body">
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">


                <div class="card-body mt-2">
                    <div class="table-responsive">
                        <div class="cats-tree">
                            <ul>
                                <li> <a href="{{route('admin.pages')}}"> الأقسام الرئيسية </a> /</li>
                                @if ($parent_page->getParentsNames() !== $parent_page->name)

                                @foreach ($parent_page->getParentsNames()->reverse() as $item)
                                <li> <a href="{{route('admin.getSubPages',$item->id)}}"> {{$item->name }} </a> /</li>
                                @endforeach

                                @endif

                                @if($parent_page)
                                <b>{{$parent_page->name}}</b>
                                @else
                            </ul>
                            ---
                            @endif
                        </div>

                        <table id="sellers_table" class="table table-bordered table-striped">
                            <thead>
                                <tr class="head">
                                    <th>القسم </th>
                                    <th>الأقسام الفرعية</th>
                                    {{-- <th>&nbsp;</th> --}}
                                    <th>المنتجات</th>
                                    <th>فعال</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>

                            <tbody>

                                @if(!empty($sub_pages))
                                @foreach ($sub_pages as $page)
                                <tr>
                                    <td>{{$page->name}} </td>

                                    <td>
                                        <!-- <a href="">{{$page->children->count()}}</a> -->

                                        @if($page->children->count() != 0)
                                        <a class="btn-sm btn-success action"
                                            href="{{route('admin.getSubPages',$page->id)}}" role="button px-2">
                                            <i class="fa fa-eye"></i>
                                            {{$page->children->count()}}
                                        </a>
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>{{ $page->productNumber }}</td>
                                    <td>
                                        <label class="switch" id="switch">
                                            <input class="switch__input" type="checkbox" data-id="{{$page->id}}"
                                                {{$page->is_active ==1 ? 'checked' : ''}}/>
                                            <i class="switch__icon"></i>
                                            <!-- Image loader -->
                                            <div id='loader'>
                                                <img src='{{asset("assets/images/reload.gif")}}'>
                                            </div>
                                            <!-- Image loader -->
                                        </label>

                                    </td>

                                    <td class="action">
                                        <a class="btn-sm btn-warning action"
                                            href="{{route('admin.pages.edit',$page->id)}}"><i
                                                class="fa fa-edit"></i></a>&nbsp;
                                        <a class="btn-sm btn-danger action"
                                            href="{{ route('admin.pages.delete',[$page->id])}}"
                                            onclick="return confirm('Are you sure you want to delete this element?')"><i
                                                class="fa fa-trash"></i></a>&nbsp;
                                    </td>



                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>





@endsection

@push('scripts')

<script>
    $('.switch__input').on('change', function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var page_id = $(this).data('id');  
        $.ajax({
            type: 'GET',
            dataType: 'JSON',
             url: '/admin/pages/changePageActivity/'+page_id,
            data: {
                'is_active': status,
                'page_id': page_id
            },
            success:function(data) {
                
            },
            beforeSend:  () => {
                $(this).parent().find('#loader').show();
                $(this).parent().find('.switch__input').hide();
            },
            complete:  () => {
                $(this).parent().find('#loader').hide();
                $(this).parent().show();
            },
        });
        
    });

    $(document).ajaxComplete(function(){
    // Hide image container
    //$("#loader").hide();
    });
</script>

@endpush




<?php /* 
@extends('layoutmodule::admin.main')

@section('title')
Pages
@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endpush


@section('content')

<div class="content-wrapper container-fluid">
    <div class="content-header">
        <div class="content-header-left mb-2 breadcrumb-new col">
            <h3>
                <i class="icon-grid2"></i>
                &nbsp;
                Pages
            </h3>
            {{-- <a href="page.html">Pages /</a> --}}
        </div>
    </div>

    @include('layoutmodule::admin.flash')

    <div class="content-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-5 ">
                            <!-- @if ($parent_page->getParentsNames() !== $parent_page->name)
                            {{ implode('/',$parent_page->getParentsNames()->reverse()->pluck('name')->toArray()) }}
                            @endif
                            @if($parent_page)
                            <b> / {{$parent_page->name}}</b>
                            @else
                            --- 
                            @endif -->
                            <ul>
                            @if ($parent_page->getParentsNames() !== $parent_page->name)
                            
                            @foreach ($parent_page->getParentsNames()->reverse() as $item)
                            
                            @if ($item->parent_id == 0)
                            
                           <li>{{ $item->name }}</li> 
                            @else
                              <li> / {{ $item->name }} </li>
                            @endif
                         
                            @endforeach
                            
                            @endif

                            / 
                            @if($parent_page)
                            <b>{{$parent_page->name}}</b>
                            @else
                            </ul>
                            --- 
                            @endif
                            </div> 
                            <div class="col-lg-10"></div>
                            <div class="col-lg-2">
                                <a class="btn btn-success round btn-min-width mr-1 mb-1"
                                    href="{{route('admin.pages.add')}}" role="button">Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr class="head">
                                        <th>Page  </th>
                                        <th>Sub Pages</th>
                                        {{-- <th>&nbsp;</th> --}}
                                        <th>Products</th>
                                        <th>Active</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if(!empty($sub_pages))
                                    @foreach ($sub_pages as $page)
                                    <tr>
                                        <td>{{$page->name}} </td>
                                       
                                        <td>
                                            <!-- <a href="">{{$page->children->count()}}</a> -->  

                                           @if($page->children->count() != 0)
                                            <a class="btn-sm btn-warning "
                                                href="{{route('admin.getSubPages',$page->id)}}"
                                                role="button px-2" >
                                                <i class="fa fa-eye" ></i>
                                                {{$page->children->count()}}
                                            </a>
                                            @else
                                              -
                                           @endif 
                                        </td>
                                        <td>{{ $page->productNumber }}</td>
                                        <td>
                                            <label class="switch" id="switch">
                                                <input class="switch__input" type="checkbox" data-id="{{$page->id}}" 
                                                    {{$page->is_active ==1 ? 'checked' : ''}}/>
                                                <i class="switch__icon"></i>
                                                <!-- Image loader -->
                                                <div id='loader'>
                                                    <img src='{{asset("assets/images/reload.gif")}}'>
                                                </div>
                                                <!-- Image loader -->
                                            </label>

                                        </td>
                                        <td class="action">
                                            <a class="btn-sm btn-warning"
                                                href="{{route('admin.pages.edit',$page->id)}}"
                                                role="button">{{__('messages.edit')}}</a>
                                            <a href="{{ route('admin.pages.delete',[$page->id])}}"
                                                onclick="return confirm('Are you sure you want to delete this element?')"
                                                class="btn-sm btn-danger" role="button">Delete</a>
                                        </td>
                                    </tr>
                                   


                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@endsection


@push('scripts')

<script>
    $('.switch__input').on('change', function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var page_id = $(this).data('id');  
        $.ajax({
            type: 'GET',
            dataType: 'JSON',
             url: '/admin/pages/changePageActivity/'+page_id,
            data: {
                'is_active': status,
                'page_id': page_id
            },
            success:function(data) {
                
            },
            beforeSend:  () => {
                $(this).parent().find('#loader').show();
                $(this).parent().find('.switch__input').hide();
            },
            complete:  () => {
                $(this).parent().find('#loader').hide();
                $(this).parent().show();
            },
        });
        
    });

    $(document).ajaxComplete(function(){
    // Hide image container
    //$("#loader").hide();
    });
</script>

@endpush

*/
?>