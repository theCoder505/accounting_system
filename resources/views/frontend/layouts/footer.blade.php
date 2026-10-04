<?php 
    $site_info = App\Models\Siteinfo::first();
    $site_image = App\Models\SiteImage::first();
    $social_link = App\Models\SiteSocialLink::first();
?>
<footer class="page_footer corner-footer ds s-pt-30 s-pb-0 s-pb-lg-10 s-pb-xl-50 c-gutter-60 s-parallax">

    <div class="container">
        <div class="container">
            <div class="row">
                <div class="divider-20 d-none d-xl-block"></div>
                <div class="col-md-12 mt-4 text-center animate" data-animation="fadeInUp">
                    <img class="margin-negative" src="{{asset($site_image->logo)}}" alt="{{$site_info->site_name}}">
                    <div class="widget widget_social_buttons">

                        <a href="{{$social_link->facebook ?? '#'}}" target="_blank" class="fa fa-facebook color-icon border-icon" title="facebook"></a>

                        <a href="{{$social_link->linkedin ?? '#'}}" target="_blank" class="fa fa-linkedin color-icon border-icon" title="linkedin"></a>

                        {{-- <a href="{{$social_link->twitter ?? '#'}}" target="_blank"  class="fa fa-twitter color-icon border-icon" title="twitter"></a>
                        <a href="{{$social_link->youtube ?? '#'}}" target="_blank"  class="fa fa-youtube-play color-icon border-icon"
                            title="youtube-play"></a>

                        <a href="{{$social_link->instagram ?? '#'}}" target="_blank"  class="fa fa-instagram color-icon border-icon" title="instagram"></a> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<section class="page_copyright light-copy cs s-py-20 s-py-lg-5 s-parallax copyright">
    <div class="container">
        <div class="row align-items-center">
            <div class="divider-20 d-none d-lg-block"></div>
            <div class="col-md-12 text-center">
                <p>&copy; Copyright
                    <span class="copyright_year"><?php echo date('Y'); ?></span> All Rights Reserved
                </p>
            </div>
            <div class="divider-20 d-none d-lg-block"></div>
        </div>
    </div>
</section>
