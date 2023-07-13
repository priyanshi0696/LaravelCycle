<?php
use App\Models\Banners;
$banner=Banners::get()->toArray();

?>
<div class="banner_section layout_padding">

    <div id="main_slider" class="carousel slide" data-ride="carousel">

        <div class="carousel-inner">
            <?php $firstBanner = true; ?>
            @foreach($banner as $banner1)
            <div class="carousel-item <?php echo $firstBanner ? 'active' : ''; ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="best_text">Best</div>
                            <div class="image_1"><img src="{{ asset('user/images/bannerimage/'.$banner1['banner_image'])}}"></div>
                        </div>
                        <div class="col-md-5">
                            <h1 class="banner_taital">{{$banner1['banner_title'] }}</h1>
                            <p class="banner_text">{{ $banner1['banner_description'] }}</p>
                            <div class="contact_bt"><a href="contact.html">Shop Now</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $firstBanner = false; ?>
            @endforeach
        </div>

       <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
       <i class="fa fa-angle-left"></i>
       </a>
       <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
       <i class="fa fa-angle-right"></i>
       </a>
    </div>

</div>

 <!-- banner section end -->
</div>

