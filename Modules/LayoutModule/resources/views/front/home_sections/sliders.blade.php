<div class="container-indent nomargin">
        <div class="container-fluid">
                <div class="row">
                        <div class="slider-revolution revolution-default" data-fullscreen="false" data-width="1181"
                                data-height="500">
                                <div class="tp-banner-container">
                                        <div class="tp-banner revolution">
                                                <ul>
                                                        @if(count($sliders))
                                                        @foreach ($sliders as $slider)
                                                        <li data-thumb="{{url('uploads/sliders/' . $slider->image)}}"
                                                                data-transition="fade" data-slotamount="1"
                                                                data-masterspeed="1000" data-saveperformance="off"
                                                                data-title="Slide">
                                                                <img src="{{url('uploads/sliders/' . $slider->image)}}"
                                                                        alt="slide1" data-bgposition="center center"
                                                                        data-bgfit="cover" data-bgrepeat="no-repeat">
                                                                <div class="tp-caption tp-caption1 lfr str"
                                                                        data-x="right" data-y="center"
                                                                        data-hoffset="-351" data-voffset="-20"
                                                                        data-speed="600" data-start="900"
                                                                        data-easing="Power4.easeOut"
                                                                        data-endeasing="Power4.easeIn">
                                                                        <div class="tp-caption1-wd-1 tt-base-color">
                                                                                {{$slider->head}}
                                                                                <br>
                                                                                {{$slider->details}}
                                                                        </div>
                                                                        @if($slider->url != null)
                                                                        <div class="tp-caption1-wd-4">
                                                                                <a href="{{$slider->url}}"
                                                                                        target="_blank"
                                                                                        class="btn btn-xl">
                                                                                        {{$slider->button_text}}
                                                                                </a>
                                                                        </div>
                                                                        @endif
                                                                </div>
                                                        </li>

                                                        @endforeach
                                                        @endif
                                                </ul>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>