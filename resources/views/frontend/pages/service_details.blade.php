@extends('frontend.layouts.app')

@section('title')
    <title>{{ $service->name }} - {{ $site_info->site_name ?? config('app.name', 'Branex IT Limited') }}</title>
@endsection

@section('content')

    <!-- Page Title & Breadcrumb -->
    <section class="page_title ls s-py-50 corner-title ls overflow-visible">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>{{ $service->name }}</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ URL::to('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('works') }}">Services</a>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ $service->name }}
                        </li>
                    </ol>
                    <div class="divider-15 d-none d-xl-block"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Details & Sidebar Section -->
    <section class="ls s-pt-50 s-pb-100 c-gutter-60 overflow-visible">
        <div class="container">
            <div class="row">

                <!-- Main Content Area -->
                <div class="col-lg-8 col-md-12">
                    
                    @if(!empty($service->image))
                        <div class="item-media mb-4 text-center">
                            <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" class="img-fluid rounded" style="width: 100%; max-height: 480px; object-fit: cover; box-shadow: 0 5px 25px rgba(0,0,0,0.08);">
                        </div>
                    @endif

                    <div class="service-details-content mb-4">
                        <h2 class="special-heading text-left">{{ $service->name }}</h2>
                        <div class="divider-20"></div>

                        @if(!empty($service->short_description))
                            <div class="p-3 mb-4 rounded" style="background: #fdf5f7; border-left: 4px solid #ff497c; font-size: 16px; line-height: 28px; color: #323232;">
                                {!! $service->short_description !!}
                            </div>
                        @endif

                        @if(!empty($service->description))
                            <div class="service-description" style="font-size: 16px; line-height: 30px; color: #555;">
                                {!! $service->description !!}
                            </div>
                        @else
                            <div class="service-description" style="font-size: 16px; line-height: 30px; color: #555;">
                                <p>
                                    We deliver industry-standard, professional <strong>{{ $service->name }}</strong> solutions customized to your business goals. 
                                    Our dedicated specialists utilize state-of-the-art technologies and best practices to ensure optimal results, performance, and scalability.
                                </p>
                                <p>
                                    Whether you are starting a new initiative or optimizing existing operations, our team is equipped to guide you every step of the way. 
                                    Reach out today to discuss how our {{ $service->name }} service can transform your business.
                                </p>
                            </div>
                        @endif
                    </div>

                    <!-- Related Works / Portfolio for this Service -->
                    @if(isset($works) && count($works) > 0)
                        <div class="divider-40"></div>
                        <h4 class="special-heading text-left">Our {{ $service->name }} Works</h4>
                        <div class="divider-25"></div>

                        <div class="row c-mb-30">
                            @foreach ($works as $work)
                                <div class="col-md-6 mb-4">
                                    <div class="vertical-item text-center ls ms p-3 border rounded shadow-sm">
                                        <div class="item-media">
                                            <img src="{{ asset($work->image) }}" alt="{{ $work->name }}" style="width: 100%; height: 220px; object-fit: cover; border-radius: 4px;">
                                        </div>
                                        <div class="item-content pt-3">
                                            <h6 class="mb-1">
                                                <a href="{{ $work->link ?? '#' }}" target="_blank">{{ $work->name }}</a>
                                            </h6>
                                            @if(!empty($work->link))
                                                <div class="small-text link-a">
                                                    <a href="{{ $work->link }}" target="_blank">View Live <i class="fa fa-external-link ml-1"></i></a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Call To Action Box -->
                    <div class="divider-35"></div>
                    <div class="p-4 rounded text-center" style="background: #f7f8fa; border: 1px solid #eaecef; border-left: 5px solid #ff497c;">
                        <h4 class="mb-2" style="font-size: 22px;">Ready to start your project with {{ $service->name }}?</h4>
                        <p class="mb-4" style="color: #666; font-size: 15px;">Send us your requirements or get in touch for a comprehensive consultation.</p>
                        <a href="{{ route('enquiry') }}" class="btn btn-maincolor mr-2">Submit Enquiry</a>
                        <a href="{{ route('contactus') }}" class="btn btn-outline-maincolor">Contact Us</a>
                    </div>

                </div>

                <!-- Right Sidebar -->
                <div class="col-lg-4 col-md-12 mt-5 mt-lg-0">
                    <div class="sidebar">

                        <!-- All Services Widget -->
                        <div class="widget widget_nav_menu p-4 mb-4 rounded" style="background: #ffffff; border: 1px solid #eaeaea; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                            <h5 class="widget-title mb-3" style="border-bottom: 2px solid #ff497c; padding-bottom: 12px; font-size: 18px; text-transform: uppercase;">
                                All Services
                            </h5>
                            <ul class="list-unstyled mb-0" style="padding-left: 0;">
                                @if(isset($services) && count($services) > 0)
                                    @foreach($services as $item)
                                        <li style="padding: 12px 10px; border-bottom: 1px solid #f0f0f0; background: {{ $item->id == $service->id ? '#fef0f3' : 'transparent' }}; border-radius: 4px; margin-bottom: 4px;">
                                            <a href="{{ route('service', $item->slug) }}" style="color: {{ $item->id == $service->id ? '#ff497c' : '#333333' }}; font-weight: {{ $item->id == $service->id ? '700' : '500' }}; text-decoration: none; display: flex; align-items: center; justify-content: space-between;">
                                                <span>
                                                    <i class="fa fa-angle-right mr-2" style="color: #ff497c;"></i> {{ $item->name }}
                                                </span>
                                                @if($item->id == $service->id)
                                                    <span class="badge" style="background: #ff497c; color: #fff; font-size: 10px; padding: 4px 8px; border-radius: 10px;">Active</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                        <!-- Need Help Contact Box -->
                        <div class="widget widget_text p-4 mb-4 rounded text-center ds" style="background: #1f2732; color: #fff; box-shadow: 0 5px 20px rgba(0,0,0,0.15);">
                            <div class="border-icon mx-auto mb-3" style="width: 70px; height: 70px; line-height: 70px; border-radius: 50%; border: 2px solid #ff497c; display: flex; align-items: center; justify-content: center;">
                                <i class="fa fa-phone fa-2x" style="color: #ff497c;"></i>
                            </div>
                            <h5 style="color: #fff; font-size: 20px; margin-bottom: 10px;">Need Help?</h5>
                            <p style="color: #b0b5be; font-size: 14px; line-height: 22px; margin-bottom: 18px;">
                                Have questions regarding our services or need custom pricing? Our support team is ready to help.
                            </p>
                            @if(!empty($site_info->phone))
                                <h6 style="margin-bottom: 12px;">
                                    <a href="tel:+88{{ $site_info->phone }}" style="color: #ff497c; font-size: 18px; font-weight: 700;">+88{{ $site_info->phone }}</a>
                                </h6>
                            @endif
                            @if(!empty($site_info->email))
                                <p style="font-size: 14px; margin-bottom: 22px;">
                                    <a href="mailto:{{ $site_info->email }}" style="color: #ffffff;">{{ $site_info->email }}</a>
                                </p>
                            @endif
                            <a href="{{ route('contactus') }}" class="btn btn-maincolor" style="padding: 14px 28px; font-size: 11px;">Contact Support</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

@stop
