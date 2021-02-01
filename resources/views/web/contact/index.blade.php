


@extends('web/layout')

@section('title')

 contact 

@endsection

@section('content')

	<!-- Hero-area -->
    <div class="hero-area section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background.jpg)"></div>
        <!-- /Backgound Image -->

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <ul class="hero-area-tree">
                        <li><a href="index.html">{{__('web.home')}}</a></li>
                        <li>{{__('web.con')}}</li>
                    </ul>
                    <h1 class="white-text">{{__('web.getIntouch')}}</h1>

                </div>
            </div>
        </div>

    </div>
    <!-- /Hero-area -->

    <!-- Contact -->
    <div id="contact" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- contact form -->
                <div class="col-md-6">
                    <div class="contact-form">
                        <h4>{{__('web.sendMsg')}}</h4>
                         @include('web.inc.msg-ajax')
                        {{-- <form method="post" action="{{url('contact/message/send')}}"> --}}
                            <form id="contact-form" >
                            @csrf
                            <input class="input" type="text" name="name" placeholder="{{__('web.name')}}">
                            <input class="input" type="email" name="email" placeholder="{{__('web.email')}}">
                            <input class="input" type="text" name="subject" placeholder="{{__('web.subject')}}">
                            <textarea class="input" name="body" placeholder="{{__('web.enterMsg')}}"></textarea>
                            <button id="contact-form-btn" type="submit" class="main-button icon-button pull-right">{{__('web.sendBtn')}}</button>

                        </form>
                    </div>
                </div>
                <!-- /contact form -->

                <!-- contact information -->
                <div class="col-md-5 col-md-offset-1">
                    <h4>{{__('web.contactInfo')}}</h4>
                    <ul class="contact-details">
                        <li><i class="fa fa-envelope"></i>{{$sett->email}}</li>
                        <li><i class="fa fa-phone"></i>{{$sett->phone}}</li>
                    </ul>

                </div>
                <!-- contact information -->

            </div>
            <!-- /row -->

        </div>
        <!-- /container -->

    </div>
    <!-- /Contact -->
    @endsection
@section('script')

<script>
            $('#success-div').hide()
            $('#errors-div').hide()

            $('#contact-form-btn').click(function(e){

            $('#success-div').hide()
            $('#errors-div').hide()
            $('#success-div').empty()
            $('#errors-div').empty()

            e.preventDefault()

            let formData = new FormData($('#contact-form')[0]);
            
            $.ajax({

                type :'POST',
                url :"{{ url('contact/message/send') }}",
                data:formData,
                contentType:false,
                processData:false,

                success : function(data){
                        $('#success-div').show()
                        $('#errors-div').text(data.success)
                console.log(data.success);
                },
                error : function(xhr,status,error){
                $('#errors-div').show()
                $.each(xhr.responseJSON.errors, function (key,item)
                {
                $('#errors-div').append("<p>" + item +"</p>")
              });
            }
          });
       })


</script>


@endsection