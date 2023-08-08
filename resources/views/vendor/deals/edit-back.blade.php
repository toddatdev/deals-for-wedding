@extends('vendor.layouts.app')
@section('title', 'Admin: Edit Deal')
@push('customCSS')
@endpush

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Deals Management</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Edit Deal
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{route('vendor.deals.update', $deal->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="title" class="form-label"><strong>Title</strong></label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="title" value="{{isset($deal->title) ? $deal->title : ''}}" required="">
                                            @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="image" class="form-label"><strong>Image </strong><small>Required square size & minimum 800px width.</small></label>
                                            @if(isset($deal->image))
                                            <div class="old_img">
                                                <img src="{{asset('public/'.$deal->image)}}" style="width:100px">
                                                <i class="fa fa-times text-success" aria-hidden="true" onclick="removeFile(this);">Remove</i>
                                            </div>
                                            @endif
                                            <input type="file" id="image" name="image" class="form-control" accept="image/*" required="required" />
                                            <input type="hidden" id="old_image" value="{{isset($deal->image) ? $deal->image :''}}" name="old_image">
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="category_id" class="form-label"><strong>Category </strong></label>
                                            <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                                                <option value="" selected="">Select Any</option>
                                                @foreach($categories as $category)
                                                <option value="{{isset($category->id) ? $category->id : ''}}" {{($deal->category_id == $category->id) ? 'selected="selected"' : ''}}>{{isset($category->name) ? $category->name : ''}}</option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="state_id" class="form-label"><strong>City </strong></label>
                                            <select class="form-control @error('state_id') is-invalid @enderror" name="state_id" id="state_id">
                                                <option value="" selected="">Select Any</option>
                                                @foreach($states as $state)
                                                <option value="{{isset($state->id) ? $state->id : ''}}" {{($deal->state_id == $state->id) ? 'selected="selected"' : ''}}>{{isset($state->name) ? $state->name : ''}} - {{isset($state->code) ? strtoupper($state->code) : ''}}</option>
                                                @endforeach
                                            </select>
                                            @error('state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <!-- <div class="col-md-4">
							        	<label for="city" class="form-label"><strong>City</strong></label>
							        	<input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" placeholder="city" value="{{isset($deal->city) ? $deal->city :''}}" required="">
							        	@error('city')
							        	    <span class="invalid-feedback" role="alert">
							        	        <strong>{{ $message }}</strong>
							        	    </span>
							        	@enderror
							        </div> -->
                                        <div class="col-md-4">
                                            <label for="price" class="form-label"><strong>Price</strong></label>
                                            <input type="number" step="0.01" class="form-control validate_price @error('price') is-invalid @enderror" id="price" name="price" placeholder="price" value="{{isset($deal->price) ? $deal->price :''}}" required="">
                                            @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="offer_price" class="form-label"><strong>Offer Price</strong></label>
                                            <input type="number" step="0.01" class="form-control validate_price @error('offer_price') is-invalid @enderror" id="offer_price" name="offer_price" placeholder="offer_price" value="{{isset($deal->offer_price) ? $deal->offer_price :''}}">
                                            @error('offer_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="description" class="form-label"><strong>Description </strong></label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{isset($deal->description) ? $deal->description : ''}}</textarea>
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="teaser_text" class="form-label"><strong>Teaser Text </strong></label>
                                            <textarea class="form-control @error('teaser-text') is-invalid @enderror" name="teaser_text" id="teaser_text">{{isset($deal->teaser_text) ? $deal->teaser_text : ''}}</textarea>
                                            @error('teaser_text')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="advertiser_image" class="form-label"><strong>Profile Image </strong> <small>Required square size & minimum 800px width.</small></label>
                                            @if(isset($deal->image))
                                            <div class="old_img">
                                                <img src="{{asset('public/'.$deal->advertiser_image)}}" style="width:100px">
                                                <i class="fa fa-times text-success" aria-hidden="true" onclick="removeFile(this);">Remove</i>
                                            </div>
                                            @endif
                                            <input type="file" class="form-control @error('advertiser_image') is-invalid @enderror" id="advertiser_image" name="advertiser_image" accept="image/*">
                                            <input type="hidden" id="old_image" value="{{isset($deal->advertiser_image) ? $deal->advertiser_image :''}}" name="old_adv_image">
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">

                                            <label for="advertiser_bio" class="form-label"><strong>Advertiser Bio </strong></label>
                                            <textarea class="form-control @error('advertiser_bio') is-invalid @enderror" name="advertiser_bio" id="advertiser_bio">{{isset($deal->advertiser_bio) ? $deal->advertiser_bio : ''}}</textarea>
                                            @error('teaser_text')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="status" class="form-label"><strong>Status </strong></label>
                                            <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                                                <option value="1" {{($deal->status == 1) ? 'selected="selected"' : ''}}>Active</option>
                                                <option value="0" {{($deal->status == 0) ? 'selected="selected"' : ''}}>Inactive</option>
                                            </select>
                                            @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="is_featured" class="form-label"><strong>Is Featured </strong></label>
                                            <select class="form-control @error('is_featured') is-invalid @enderror" name="is_featured" id="is_featured">
                                                <option value="1" {{($deal->is_featured == 1) ? 'selected="selected"' : ''}}>Yes</option>
                                                <option value="0" {{($deal->is_featured == 0) ? 'selected="selected"' : ''}}>No</option>
                                            </select>
                                            @error('is_featured')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="card-action">
                                    <input type="submit" value="Save" class="btn btn-success">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @endsection

    @push('customJs')
    <script type="text/javascript">
        $(".validate_price").blur(function() {
            var price = $(this).val();
            var validatePrice = function(price) {
                return /^(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(price);
            }
            var dfd = validatePrice(price);
            console.log(dfd);
            if (!dfd) {
                alert('Price should be in integer');
                $(this).val('0');
            }
            //alert(validatePrice(price)); // False
        });

        $("#offer_price").blur(function() {
            var offer_price = parseFloat($("#offer_price").val());
            var regular_price = parseFloat($("#price").val());

            if (regular_price > offer_price) {
                console.log('dfgdg');
            } else {
                $("#offer_price").val('0');
                alert('Offer price should be less then regular price.');
            }
            //alert(validatePrice(price)); // False
        });

        $(function() {
            // Summernote
            $('#description').summernote()
        })
        @if(isset($deal -> id))
        $(document).ready(function() {
            $('#image').removeAttr('required');
            var form = document.getElementById('create-deal');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                console.log($('#old_image').val());
                var oldimage = $('#old_image').val();
                if (oldimage != '' || oldimage != null || oldimage.length > 0) {
                    $('#image').removeAttr('required');
                    form.submit();
                } else {
                    $('#image').attr('required', true);
                    return false;
                }
            });
        });

        function removeFile(element) {
            $(element).parent('div.old_img').remove();
            $('#image').attr('required', true);
        }
        @endif
    </script>
    @endpush