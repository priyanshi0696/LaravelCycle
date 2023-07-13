@extends('layouts.app')
@section('content')

<!-- cycle section start -->

<div class="cycle_section layout_padding">
   <div class="container">
      <h1 class="cycle_taital">Our cycle</h1>
      <p class="cycle_text">It is a long established fact that a reader will be distracted by the </p>
      @foreach($product as $index =>$product1)
      <div class="cycle_section_2 layout_padding">
         <div class="row">
            @if($index % 2 == 0)
            <div class="col-md-6">
               <div class="box_main">
                  <h6 class="number_text">{{ $product1['id'] }}</h6>
                  <div class="image_2"><img src="{{ asset('user/images/productimage/'.$product1['image'])}}"></div>
               </div>
            </div>
            <div class="col-md-6">
               <h1 class="cycles_text">{{$product1['product_title'] }}</h1>
               <p class="lorem_text">{{$product1['product_description'] }}</p>
               <div class="btn_main">
                  <div class="buy_bt"><a href="#">Buy Now</a></div>
                  <h4 class="price_text">Price <span style=" color: #f7c17b">$</span> <span style=" color: #325662">{{ $product1['price'] }}</span></h4>
               </div>
            </div>
            @else
            <div class="col-md-6">
                <h1 class="cycles_text">{{$product1['product_title'] }}</h1>
                <p class="lorem_text">{{$product1['product_description'] }}</p>
                <div class="btn_main">
                   <div class="buy_bt"><a href="#">Buy Now</a></div>
                   <h4 class="price_text">Price <span style=" color: #f7c17b">$</span> <span style=" color: #325662">{{ $product1['price'] }}</span></h4>
                </div>
             </div>
             <div class="col-md-6">
                <div class="box_main">
                   <h6 class="number_text">{{ $product1['id'] }}</h6>
                   <div class="image_2"><img src="{{ asset('user/images/productimage/'.$product1['image'])}}"></div>
                </div>
             </div>
             @endif
         </div>
      </div>
      @endforeach

      <div class="read_btn_main">
         <div class="read_bt"><a href="#">Read More</a></div>
      </div>
   </div>
</div>
<!-- cycle section end -->
<!-- about section start -->
<div class="about_section layout_padding">
   <div class="container">
      <h1 class="about_taital">About Our cycle Store</h1>
      <p class="about_text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters
      </p>
      <div class="about_main">
         <img src="{{ asset('user/images/img-5.png')}}" class="image_5">
      </div>
      <div class="read_bt_1"><a href="#">Read More</a></div>
   </div>
</div>
<!-- about section end -->
<!-- client section start -->
<div class="client_section layout_padding">
   <div id="my_slider" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <?php $firstBanner = true; ?>
        @foreach($client as $client1)
         <div class="carousel-item <?php echo $firstBanner ? 'active' : ''; ?>">
            <div class="container">
               <div class="client_main">
                  <h1 class="client_taital">Says Customers</h1>
                  <div class="client_section_2">
                     <div class="client_left">
                        <div><img src="{{ asset('user/images/clientimage/'.$client1['client_image'])}}" class="client_img"></div>
                     </div>
                     <div class="client_right">
                        <div class="quote_icon"><img src="{{ asset('user/images/quote-icon.png')}}"></div>
                        <p class="client_text">{{ $client1['client_description'] }}</p>
                        <h3 class="client_name">{{ $client1['client_name']}}</h3>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php $firstBanner = false; ?>
         @endforeach

      </div>
      <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="prev">
         <i class="fa fa-angle-left"></i>
      </a>
      <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
        <i class="fa fa-angle-right"></i>
      </a>
   </div>
</div>
<!-- client section end -->
<!-- news section start -->
<div class="news_section layout_padding">
   <div class="container">
      <h1 class="news_taital">News</h1>
      <p class="news_text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using </p>
      <div class="news_section_2 layout_padding">
         <div class="row">
            <div class="col-sm-4">
               <div class="box_main_1">
                  <div class="zoomout frame"><img src="{{ asset('user/images/img-6.png')}}"></div>
                  <div class="padding_15">
                     <h2 class="speed_text">Speed cycle</h2>
                     <div class="post_text">Post by : Den <span style="float: right;">20-12-2019</span></div>
                     <p class="long_text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using </p>
                  </div>
               </div>
            </div>
            <div class="col-sm-4">
               <div class="box_main_1">
                  <div class="zoomout frame"><img src="{{ asset('user/images/img-7.png')}}"></div>
                  <div class="padding_15">
                     <h2 class="speed_text">Speed cycle</h2>
                     <div class="post_text">Post by : Den <span style="float: right;">20-12-2019</span></div>
                     <p class="long_text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using </p>
                  </div>
               </div>
            </div>
            <div class="col-sm-4">
               <div class="box_main_1">
                  <div class="zoomout frame"><img src="{{ asset('user/images/img-8.png')}}"></div>
                  <div class="padding_15">
                     <h2 class="speed_text">Jaump cycle</h2>
                     <div class="post_text">Post by : Den <span style="float: right;">20-12-2019</span></div>
                     <p class="long_text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- news section end -->
<!-- contact section start -->
<div class="contact_section layout_padding">
   <div class="container">
      <div class="contact_main">
         <h1 class="request_text">A Call Back</h1>
         <form action="/action_page.php">
            <div class="form-group">
               <input type="text" class="email-bt" placeholder="Name" name="Name">
            </div>
            <div class="form-group">
               <input type="text" class="email-bt" placeholder="Email" name="Name">
            </div>
            <div class="form-group">
               <input type="text" class="email-bt" placeholder="Phone Numbar" name="Email">
            </div>
            <div class="form-group">
               <textarea class="massage-bt" placeholder="Massage" rows="5" id="comment" name="Massage"></textarea>
            </div>
         </form>
         <div class="send_btn"><a href="#">SEND</a></div>
      </div>
   </div>
</div>
<!-- contact section end -->
<!-- footer section start -->
 @endsection




