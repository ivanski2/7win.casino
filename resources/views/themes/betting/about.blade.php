@extends($theme . 'layouts.app')

@section('content')
<style>
    .banner-section {
        display: none;
        margin: 100px;
    }

    /* Add media query for small screens (phones) */
    @media only screen and (max-width: 600px) {
        .banner-section {
            margin: 20px; /* Adjust margin for smaller screens */
        }

        .testimonial-section {
            /* Add any additional styles for small screens here */
        }

        .review-box {
            /* Add any additional styles for individual review boxes on small screens here */
        }
    }
</style>

@if(isset($templates['about-us'][0]) && $aboutUs = $templates['about-us'][0])
    <center>
        <h3>@lang(optional($aboutUs->description)->title)</h3>
        <h2>@lang(optional($aboutUs->description)->sub_title)</h2>
        <p>
            @lang(optional($aboutUs->description)->description)
        </p>
    </center>
@endif

@if(isset($contentDetails['testimonial']) && count($contentDetails['testimonial']) > 0)
    <!-- testimonial section -->
    <section class="testimonial-section">
        <div class="container">
            <div class="row">
                @if(isset($templates['testimonial'][0]) && ($testimonial = $templates['testimonial'][0]))
                    <div class="col">
                        <div class="header-text mb-5 text-center">
                            <h5>@lang(optional($testimonial->description)->title)</h5>
                            <p>@lang(optional($testimonial->description)->short_description)</p>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="testimonials owl-carousel">
                        @forelse($contentDetails['testimonial'] as $item)
                            <div class="review-box">
                                <div class="upper">
                                    <div class="img-box">
                                        <img src="{{ getFile(config('location.content.path') . @$item->content->contentMedia->description->image) }}" alt="..."/>
                                    </div>
                                    <div class="client-info">
                                        <h5>@lang(@$item->description->name)</h5>
                                        <span>@lang(@$item->description->designation)</span>
                                    </div>
                                </div>
                                <p class="mb-0">@lang(@$item->description->description)</p>
                                <i class="fad fa-quote-right quote"></i>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

@endsection
