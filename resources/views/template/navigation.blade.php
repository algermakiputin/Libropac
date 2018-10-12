<header class="navbar navbar-inverse navbar-fixed-top " role="banner">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}"><h1><span class="bounce-in no-display animated bounceIn appear">
                <img src="{{ url('images/hccd.png') }}" style="  margin-top: -15px;">
            </span></h1></a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class=""><a href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a></li>
               
                <li><a href="{{ url('/books') }}"><i class="fa fa-book"></i> Books</a></li>
                <li><a href="{{ url('/multimedia') }}"><i class="fa fa-file"></i> Multimedia Resources</a></li>
                <li><a href="{{ url('/ask')}}"><i class="fa fa-question"></i> ASK LIBRARIAN</a></li>
                <li><a href="{{ url('/faqs')}}"><i class="fa fa-question-circle"></i> FAQS</a></li>
            </ul>
        </div>
    </div>
</header>