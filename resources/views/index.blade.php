@extends('master')
@section('content')
<!-- <div id="preloader"></div> -->
<script type="text/javascript">
    jQuery(document).ready(function($){
        'use strict';
        jQuery('body').backstretch([
            "{{url('assets/images/header/1.JPG')}}",
            "{{url('assets/images/header/2.JPG')}}",
            "{{url('assets/images/header/3.JPG')}}",
            "{{url('assets/images/header/4.JPG')}}",
            "{{url('assets/images/header/7.JPG')}}",
            "{{url('assets/images/header/8.JPG')}}"
            ], {duration: 5000, fade: 700, centeredY: true });


    });
</script>

<section id="main-slider" class="no-margin">
    <div class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="carousel-content text-center">
                                
                                <i class="home-icon bounce-in fa fa-book"  style="width: 140px;" ></i>
                              
                                <h2 class="boxed animation animated-item-1 fade-down">Library Management System</h2> 
                                <div>
                                    <p class="boxed animation animated-item-2 fade-up">Online Public Access Catagalog </p>
                                    <br>
                                </div>
                                <a class="btn btn-md animation bounce-in" href="#services">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.item-->
        </div><!--/.carousel-inner-->
    </div><!--/.carousel-->
</section><!--/#main-slider-->

<div id="content-wrapper">
    <section id="services" class="white">
        <div class="container">
            <div class="gap"></div> 
            <div class="row">
                <div class="col-md-12">
                    <div class="center gap fade-down section-heading">
                        <h2 class="main-title">Notice</h2>
                        <hr>
                        <p>Attention library users</p>
                    </div>                
                </div>
            </div>
 
            @foreach ($notices as $n) 
                @if ($loop->iteration % 2 == 0) 
                <div class="row" style="margin-bottom: 15px;">
                @endif
                <div class="col-md-6">
                    <div class="service-block">
                        <div class="pull-left bounce-in no-display animated bounceIn appear">
                            <i class="fa fa-bell fa fa-md"></i>
                        </div>
                        <div class="media-body fade-up">
                            <h3 class="media-heading">{{ $n->title }}</h3>
                            <p>{{ $n->content }}</p>
                        </div>
                    </div>
                </div> 

                @if ($loop->iteration % 2 == 0) 
                </div>
                @endif 
            @endforeach
                 

        </div>
        <div class="gap"></div>

    </section>


    <section id="single-quote" class="divider-section">                             
        <div class="container">
            <div class="gap"></div> 
            <div class="row">
                <div class="col-md-12">
                    <div class="center gap fade-down section-heading">
                        <h2 class="main-title">Meet our Librarians</h2>
                        <hr>

                    </div>                
                </div>
            </div>
            <div class="row">                        
                <div class='col-md-offset-2 col-md-8 fade-up'>
                    <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                        <div class="carousel-inner">
                            @foreach ($librarians as $l)

                            <div class="item {{ $loop->iteration == 1 ? 'active' : ''}}">

                                <div class="row">
                                    
                                    <div class="col-sm-3 text-center">
                                        <img class="img-responsive" src="{{ url('storage/avatar'). '/' . $l->image }}" style="width: 100px;height:100px;">
                                    </div>
                                    <div class="col-sm-9">
                                        <h4>{{$l->name}}</h4>
                                        <p>
                                            {{ $l->description }} 
                                        </p>
                                        <small>-{{ $l->position }}</small>
                                    </div>

                                   
                                </div>

                            </div>
                             @endforeach
                                                          
                        </div>                                     
                    </div> 
                </div>
            </div>
            <div class="gap"></div>
        </div>
    </section>

    <section id="about-us" class="white">
        <div class="container">
            <div class="gap"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="center gap fade-down section-heading">
                        <h2 class="main-title">A Little About Our Library Department</h2>
                        <hr>
                        <p>{{ $about->tag_line }}</p>
                    </div>                
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-10 col-md-offset-1 fade-up">
                    <p>
                        {!! $about->content !!}
                    </p>
                </div>
                <div class="col-md-4 fade-up">

                </div>
            </div>

            <div class="gap"></div>

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="center gap fade-down section-heading">
                            <h2 class="main-title">Frequently Ask Questions</h2>
                            <hr>
                            <p>Click below for responses to frequently asked questions.</p>
                        </div>               
                    </div>
                </div>
            </div>
            <div class="container">     
                <div class="row">
                    <div class="col-md-12 fade-up">
                        <div id="accordion">

                          @foreach ($faqs as $faq)

                              <div class="card">
                                <div class="card-header" id="headingOne">
                                  <h5 class="mb-0">
                                    <a  block;" class="btn btn-link" data-toggle="collapse" data-target="#faq{{ $faq->id }}" aria-expanded="true" aria-controls="collapseOne">
                                      <b>Q. {{ $faq->question }}</b>
                                  </a>
                              </h5>
                          </div>

                          <div id="faq{{ $faq->id }}" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                              <div class="card-body">
                                <span class="faq-header">Answerd by: {{ ucwords($faq->name) }}, on {{ date('F jS, Y', strtotime($faq->updated_at)) }}</span> 
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>

                    @endforeach

                </div>
                <div class="gap"></div>
                <a class="btn btn-md btn-view animation bounce-in no-display animated bounceIn appear" href="{{ url('faqs') }}">View All</a>
        </div>
    </div>
    <div class="gap"></div>
</div>  
</div>      
</section>
 


</section>






</div>




@endsection