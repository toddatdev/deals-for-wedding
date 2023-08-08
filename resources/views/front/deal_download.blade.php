@extends('theme.secondary')

@section('title', 'Deal : '.$deal->title)

@push('customCSS')

<link href="{{asset('/resources/css/app.css')}}" rel="stylesheet" />

@endpush
@section('content')
<a href="#" id="capbtn" class="btn btn-success" style="z-index: 50; position: sticky; top: 10px; margin:auto;"><i class="fa fa-camera"></i> &nbsp;Screenshot</a>
<div class="col-md-9 pink-bg py-4 px-3" id="middle-section">
    <div class="row">
        <div class="col-md-12">
            <div class="middle-content-area vendor-description">
                @include('flash-message')
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-6 col-xl-6">
                        <h1 class="m-0">{{isset($deal->title) ? strtoupper($deal->title) : ''}}</h1>
                        <ul class="vendor-link">
                            <li>Website .</li>
                            <li>Comments</li>
                            <li><img src="{{asset('/public/front/images/heart.png')}}" alt="" class="img-fluid"></li>
                            <li><a href=""><img src="{{asset('/public/front/images/fb-purple.png')}}" class="d-block img-fluid" alt="Facebook"></a></li>
                            <li><a href=""><img src="{{asset('/public/front/images/tw-purple.png')}}" class="d-block img-fluid" alt="Twitter"></a></li>
                            <li><a href=""><img src="{{asset('/public/front/images/instagram-purple.png')}}" class="d-block img-fluid" alt="Instgram"></a></li>
                        </ul>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="slider-section mt-3">
                                    <div id="demo" class="carousel slide" data-ride="carousel">
                                        <!-- The slideshow -->
                                        <div class="carousel-inner">
                                            {{-- <div class="carousel-item active">
											  <img src="{{asset('/public/front/images/img2.jpg')}}" class="d-block img-fluid w-100" alt=""/>
                                        </div>
                                        <div class="carousel-item">
                                            <img src="{{asset('/public/front/images/img2.jpg')}}" class="d-block img-fluid w-100" alt="" />
                                        </div>
                                        <div class="carousel-item">
                                            <img src="{{asset('/public/front/images/img2.jpg')}}" class="d-block img-fluid w-100" alt="" />
                                        </div>
                                    </div> --}}
                                    <div class="carousel-item active">
                                        @if(isset($deal->image))
                                        <img class="deal-page-main-img" src="{{ asset('/public/'.$deal->image) }}" alt="{{isset($deal->title) ? $deal->title : ''}}" class="d-block img-fluid w-100" />
                                        @else
                                        <img class="deal-page-main-img" src="/public/front/images/no-image.png')}}" alt="" class="d-block img-fluid w-100" />
                                        @endif
                                    </div>
                                </div>
                                <!-- Left and right controls -->
                                {{-- <a class="carousel-control-prev" href="#demo" data-slide="prev">
											<span class="carousel-control-prev-icon"></span>
										  </a>
										  <a class="carousel-control-next" href="#demo" data-slide="next">
											<span class="carousel-control-next-icon"></span>
										  </a> --}}

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-3">
                        @if(isset($deal->description))
                        {!! $deal->description !!}
                        @else
                        <p>N/A</p>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-8">
                        <h3>Comments</h3>
                        <p>2 Comments</p>
                    </div>
                    <div class="col-4">
                        <a href="javascript:void(0)" class="leave-review-btn" data-toggle="modal" data-target="#review-from-modal">Leave a review</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @if(count($reviews) > 0)
                        @foreach($reviews as $review)
                        <div class="commentBox mb-3">
                            <div class="row">
                                <div class="col-3">
                                    <img src="{{asset('/public/front/images/img3.png')}}" class="d-block img-fluid" alt="" />
                                    <span>{{isset($review->created_at) ? date('m-d-y',strtotime($review->created_at)) : ''}}</span>
                                </div>
                                <div class="col-9">
                                    <h5>{{isset($review->title) ? $review->title : ''}}</h5>
                                    <p>{{isset($review->message) ? $review->message : ''}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <p>Be the first to review this deal !!</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-6 col-xl-6">
                <div class="pink-bgBox mb-4">
                    <div class="white-bg">

                        <div class="alert alert-success alert-block" id="successmsg_{{$deal->id}}" style="display:none;"></div>
                        <div class="alert alert-danger alert-block" id="dangermsg_{{$deal->id}}" style="display:none;"></div>

                        <h2>Save over ${{isset($deal->offer_price) ? $deal->offer_price : $deal->price}}!</h2>
                        <div class="strip-line"></div>
                        <h3>Use Code XXXXXX</h3>
                        <div class="text-center">
                            <a href="#contact_vendor" class="btn btn-primary">Contact Vendor</a>
                            <a style="cursor:pointer;color:#fff;" class="btn btn-info save-deal" data-price="{{isset($deal->offer_price) ? $deal->offer_price : $deal->price}}" data-deal="{{isset($deal->id) ? $deal->id : ''}}">Save Deal</a>
                        </div>
                        <p>Vestibulum at velit vel risus cursus lacinia nec sit amet diam. Duis in hendrerit tortor. </p>
                        <p>Nunc sed vulputate est, nec dictum dolor.</p>
                    </div>
                </div>
                <div class="pink-bgBox mb-4">
                    <h4>Contact Vendor</h4>
                    <p class="m-0 text-center">go ahead, say hi!</p>
                    <form class="mt-3" id="contact_vendor" method="POST">
                        <div id="message"></div>
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="deal_id" value="{{$deal->id}}">
                        <div class="form-group">
                            <label for="name">Your name*</label>
                            <input type="text" class="form-control" id="name" placeholder="<AUTOFILL NAME>" name="name" value="{{(Auth::check()) ? Auth::user()->fname : ''}} {{(Auth::check()) ? Auth::user()->lname : ''}}" required="">
                        </div>
                        <div class="form-group">
                            <label for="email">Email*</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="<AUTOFILL E-MAIL>" value="{{(Auth::check()) ? Auth::user()->email : ''}}" required="">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone number*</label>
                            <input type="number" class="form-control" id="phone" name="phone" placeholder="<AUTOFILL PHONE>" value="{{isset($user->userDetails) ? $user->userDetails->phone : ''}}" required="">
                        </div>
                        <div class="form-group">
                            <label for="date">Wedding date*</label>
                            <input type="date" class="form-control" id="date" name="wedding_date" placeholder="<AUTOFILL DATE>" required="">
                        </div>
                        <div class="form-group">
                            <label for="discount-code">Your message*</label>
                            <textarea class="form-control" rows="6" id="message" name="message" required=""></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button type="button" class="btn btn-info" id="contact-send">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <hr>
        @if(count($relative_deals) > 0)
        <div class="row">
            <div class="col-md-12 pt-3">
                <h4 class="pink-text text-center">While you're at it, <span>check out these similar deals...</span></h4>
            </div>
        </div>
        <div class="row mt-5">
            @foreach($relative_deals as $rdeal)
            <div class="col-md-12 col-sm-12 col-lg-4 col-xl-4">
                <div class="infoBox mb-3">
                    <h5>{{isset($rdeal->title) ? $rdeal->title : ''}}</h5>
                    @if(isset($rdeal->image))
                    <img src="{{asset('/public/'.$rdeal->image) }}" alt="{{isset($rdeal->title) ? $rdeal->title : ''}}" class="mx-auto d-block img-fluid w-100" />
                    @else
                    <img src="{{asset('/public/front/images/no-image.png')}}" alt="" class="mx-auto d-block img-fluid w-100" />
                    @endif
                    <div class="heart-icon">
                        <img src="{{asset('/public/front/images/heart.png')}}" alt="" class="img-fluid">
                    </div>
                    <a href="#" class="btn btn-primary save-deal" data-price="{{isset($rdeal->offer_price) ? $rdeal->offer_price : $rdeal->price}}" data-deal="{{isset($rdeal->id) ? $rdeal->id : ''}}">Save Over $ {{isset($deal->offer_price) ? $deal->offer_price : $deal->price}}</a>
                    <a href="{{route('home.deal_detail', $rdeal->slug)}}" class="btn btn-info">Show Me The Deal</a>
                </div>
            </div>
            @endforeach
            {{-- <div class="col-md-12 col-sm-12 col-lg-4 col-xl-4">
							<div class="infoBox mb-3">
								<h5>Jane Doe Photography</h5>
								<img src="{{asset('/public/front/images/img1.jpg')}}" alt="" class="mx-auto d-block img-fluid w-100"/>
            <div class="heart-icon">
                <img src="{{asset('/public/front/images/heart.png')}}" alt="" class="img-fluid">
            </div>
            <button type="submit" class="btn btn-primary">Save Over $100!</button>
            <button type="submit" class="btn btn-info">Show Me The Deal</button>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-lg-4 col-xl-4">
        <div class="infoBox mb-3">
            <h5>Jane Doe Photography</h5>
            <img src="{{asset('/public/front/images/img1.jpg')}}" alt="" class="mx-auto d-block img-fluid w-100" />
            <div class="heart-icon">
                <img src="{{asset('/public/front/images/heart.png')}}" alt="" class="img-fluid">
            </div>
            <button type="submit" class="btn btn-primary">Save Over $100!</button>
            <button type="submit" class="btn btn-info">Show Me The Deal</button>
        </div>
    </div> --}}
</div>
<div class="row mt-4">
    <div class="col-md-12">
        <a href="{{route('home.allDeals')}}" class="btn btn-primary">See More</a>
    </div>
</div>
@endif
<div class="row mt-5">
    <div class="col-md-6 offset-md-3 text-center">
        <form class="my-5 category-form" method="GET" action="{{route('home.allDeals')}}">
            <p>In the meantime, find other great vendors.</p>
            <div class="form-group">
                <select class="form-control" id="category" name="category" required="">
                    <option value="">Select Category</option>
                    @foreach($categories->sortBy('name') as $category)
                    <option value="{{isset($category->slug) ? $category->slug : ''}}" {{isset($_REQUEST['category']) ? (($_REQUEST['category'] == $category->slug) ? 'selected="selected"' : '') : ''}}>{{isset($category->name) ? $category->name : ''}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <select class="form-control" id="state" name="state" required="">
                    <option value="">Select City</option>
                    @foreach($states as $state)
                    <option value="{{isset($state->code) ? $state->code : ''}}" {{isset($_REQUEST['state']) ? (($_REQUEST['state'] == $state->code) ? 'selected="selected"' : '') : ''}}>{{isset($state->code) ? $state->code : ''}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Show Me The Deals!</button>
            </div>
        </form>
        <p class="d-none d-md-none d-sm-none d-lg-block d-xl-block">&copy; Deals For Weddings </p>
    </div>
</div>
<div class="row mt-5 mb-3">
    <div class="col-sm-12">
        <h4 class="pink-text text-center">While you're at it, <span>check out these similar deals...</span></h4>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- Modal -->
<div id="review-from-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" id="close-modal">&times;</button>
                <h4 class="modal-title float-left">Add Review</h4>
            </div>
            <div class="modal-body">
                <form class="mt-3" id="modal_review_form" method="POST">
                    <div id="r_message"></div>
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <input type="hidden" name="deal_id" value="{{$deal->id}}">
                    <div class="form-group">
                        <label for="m_name">Your name*</label>
                        <input type="text" class="form-control" id="m_name" placeholder="<AUTOFILL NAME>" name="name" value="{{(Auth::check()) ? Auth::user()->fname : ''}} {{(Auth::check()) ? Auth::user()->lname : ''}}" required="">
                    </div>
                    <div class="form-group">
                        <label for="m_email">Email*</label>
                        <input type="email" class="form-control" id="m_email" name="email" placeholder="<AUTOFILL E-MAIL>" value="{{(Auth::check()) ? Auth::user()->email : ''}}" required="">
                    </div>
                    <div class="form-group">
                        <label for="title">Title*</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="" required="">
                    </div>
                    <div class="form-group">
                        <label for="m_message">Your Review*</label>
                        <textarea class="form-control" rows="10" id="m_message" name="message" required=""></textarea>
                    </div>
                    <div class="form-group text-center">
                        <button type="button" class="btn btn-info" id="review-send">Send</button>
                    </div>
                </form>
            </div>
            {{-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="close-modal">Close</button>
      </div> --}}
        </div>

    </div>
</div>
<div data-html2canvas-ignore="true">
    <div id="parentcanvas" class="css-xnjket"><img id="canvasremove" src="data:image/svg+xml;base64,PHN2ZyBmaWxsPSIjZmZmZmZmIiBoZWlnaHQ9IjI0IiB2aWV3Qm94PSIwIDAgMjQgMjQiIHdpZHRoPSIyNCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICAgIDxwYXRoIGQ9Ik0xOSA2LjQxTDE3LjU5IDUgMTIgMTAuNTkgNi40MSA1IDUgNi40MSAxMC41OSAxMiA1IDE3LjU5IDYuNDEgMTkgMTIgMTMuNDEgMTcuNTkgMTkgMTkgMTcuNTkgMTMuNDEgMTJ6Ii8+CiAgICA8cGF0aCBkPSJNMCAwaDI0djI0SDB6IiBmaWxsPSJub25lIi8+Cjwvc3ZnPgo=" alt="Close" class="css-1htfbdm">

    </div>
</div>
@endsection

@push('customJs')
<script type="text/javascript">
    //Contact Send Vendor
    $('body').on('click', '#contact-send', function() {
        let formData = $('#contact_vendor').serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('home.contact_vendor')}}",
            method: 'post',
            data: formData,
            // beforeSend: function(){
            //   // Show image container
            //   $(".loading").show();
            // },
            success: function(response) {
                if (response.status == 'success') {
                    setTimeout(function() {
                        $('#message').html('<p class="alert alert-success">' + response.message + '</p>');
                    }, 8000);
                } else {
                    $('#message').html('<p class="alert alert-danger">' + response.message + '</p>');
                }
            },
            // complete:function(data){
            //   // Hide image container
            //   $(".loading").hide();
            // }
        });
    });
    $('body').on('click', '#review-send', function() {
        let formData = $('#modal_review_form').serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('home.send_review')}}",
            method: 'post',
            data: formData,
            // beforeSend: function(){
            //   // Show image container
            //   $(".loading").show();
            // },
            success: function(response) {
                if (response.status == 'success') {
                    setTimeout(function() {
                        $('#r_message').html('<p class="alert alert-success">' + response.message + '</p>');
                    }, 3000);
                    setTimeout(function() {
                        $('#close-modal').trigger('click');
                    }, 8000);

                } else {
                    $('#r_message').html('<p class="alert alert-danger">' + response.message + '</p>');
                }
            },
            // complete:function(data){
            //   // Hide image container
            //   $(".loading").hide();
            // }
        });
    });
    //save deal
    $('body').on('click', '.save-deal', function() {
        let deal_id = $(this).data('deal');
        let price = $(this).data('price');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('home.save_deal')}}",
            method: 'post',
            data: {
                'deal_id': deal_id,
                'price': price
            },
            // beforeSend: function(){
            //   // Show image container
            //   $(".loading").show();
            // },
            success: function(response) {
                if (response.status == 'success') {
                    $('#dangermsg_' + deal_id).hide();
                    $('#successmsg_' + deal_id).show();
                    $('#successmsg_' + deal_id).html(response.message);

                    /* setTimeout(function(){
                    	$('.alert-success').html(response.message);  
                    }, 8000);   */
                } else {
                    $('#successmsg_' + deal_id).hide();
                    $('#dangermsg_' + deal_id).show();
                    $('#dangermsg_' + deal_id).html(response.message);
                    //$('.alert-danger').html(response.message);
                }
            },
            // complete:function(data){
            //   // Hide image container
            //   $(".loading").hide();
            // }
        });
    });
</script>
<script src="{{asset('/public/front/js/html2canvas.min.js')}}"></script>
<script>
    document.getElementById('capbtn').addEventListener('click', function() {
        html2canvas(document.querySelector("#capture")).then(canvas => {
            document.getElementById('parentcanvas').appendChild(canvas);
            document.getElementById('parentcanvas').style.display = "block";
        });

    });
    document.getElementById('canvasremove').addEventListener('click', function() {
        document.getElementById('parentcanvas').style.display = "none";
        document.getElementsByTagName('canvas')[0].remove();
    })
</script>

@endpush