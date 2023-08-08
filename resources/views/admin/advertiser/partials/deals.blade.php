
@if(!empty($currentAdviserDealList))
    @php $i = 1; @endphp
    @foreach($currentAdviserDealList as $key => $deal)
        <tr>
            <td>{{ $deal->created_at->toDateString() }}</td>
            <td>{{ isset($deal->title) ? $deal->title : ''}}</td>
            <td>
                @if(isset($deal->image))
                    <img src="{{asset($deal->image)}}"
                         alt="{{ isset($deal->title) ? $deal->title : ''}}"
                         width="70">
                @else
                    N/A
                @endif
            </td>
            <td>${{ isset($deal->price) ? $deal->price : ''}}</td>
            <td>${{ isset($deal->offer_price) ? $deal->offer_price : '--'}}</td>
            <td>{{ !empty($deal->user) ? (isset($deal->user->fname) ? $deal->user->fname : '') : ''}}</td>
            <td>
                @isset($userDetails)
                    {{ optional($userDetails->company()->where('field_key','company_name')->first())->field_value }}
                @endunless

                @if (!empty($deal->user))
                    @php
                        $vendorcompany = App\Models\VendorCompanyProfile::select('*')->where('field_key',
                        'company_name')->where('user_id',$deal->user->id)->get();
                    @endphp
                    @foreach ($vendorcompany as $key => $item)
                        {{$item->field_value}}
                    @endforeach
                @endif

            </td>
            <td>{{ !empty($deal->category) ? (isset($deal->category->name) ? $deal->category->name : '') : ''}}</td>
            <td>{{ !empty($deal->state) ? (isset($deal->state->name) ? $deal->state->name : '') : ''}}</td>
            <td>

                @if ($deal->multiple_cities != 'null' && $deal->multiple_cities != 'NULL' && !empty($deal->multiple_cities))
                    @foreach ((array)json_decode($deal->multiple_cities) as $cityn)
                        @foreach ($cities->where('id', $cityn)->where('id', '!=', $deal->state->id) as $city)
                            {{$city->name}} <br>
                        @endforeach
                    @endforeach
                @endif

            </td>
            <td>{{ (($deal->is_featured == 1) ? 'Yes' : 'No') }}</td>

            <td class="">
                                                        <span class="{{$deal->status == 1 ?'badge badge-success' : 'badge badge-danger'}}">
                                                            {{ (($deal->status == 1) ? 'Active' : 'Inactive') }}
                                                        </span>
            </td>

            <td width="20%">
                <a class="text-decoration-none" title="Preview"
                   href="{{route('vendor.dealdetail', $deal->id)}}"
                   target="_blank">
                    <i class="la la-eye btn btn-success action-cons px-2 mb-1"
                       aria-hidden="true"></i>
                </a>
                <a class="text-decoration-none" title="Download Preview"
                   href="{{ route('home.deal_download', $deal->slug) }}"
                   target="_blank">
                    <i class="la la-cloud-download btn btn-success action-cons px-2 mb-1"
                       aria-hidden="true"></i>
                </a>

                <a class="text-decoration-none" href="{{route('deals.edit',$deal->id)}}"
                   title="Edit"><i
                            class="la la-edit btn btn-success action-cons px-2 mb-1"
                            aria-hidden="true"></i></a>

                <a class="text-decoration-none" href="{{route('deals.delete',$deal->id)}}"
                   onclick="return confirm('Are you sure to want delete this item?');"
                   title="Delete"><i
                            class="la la-trash-o  btn btn-danger action-cons px-2 mb-1"
                            aria-hidden="true"></i></a>


                @if($deal->status == 0)
                    <a class="text-decoration-none"
                       href="{{route('deals.approve', $deal->id)}}"
                       title="Approve">
                        <i class="la la-check btn btn-success action-cons px-2 mb-1"
                           aria-hidden="true"></i>
                    </a>
                @else
                    <a class="text-decoration-none"
                       href="#"
                       data-toggle="modal"
                       data-target="#Modal_{{$deal->id}}" href=""
                       title="Deny">
                        <i class="la la-times btn btn-danger action-cons px-2 mb-1"
                           aria-hidden="true"></i>
                    </a>
                @endif


            </td>
            <!-- Modal -->
            <div class="modal fade" id="Modal_{{$deal->id}}" tabindex="-1"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form method="get"
                              action="{{route('deals.deny',$deal->id)}}">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    Deny Deals | {{$deal->title}}</h5>
                                <button type="button" class="close"
                                        data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Reason
                                        for denying!</label>
                                    <textarea class="form-control"
                                              id="admin_comment"
                                              name="admin_comment"
                                              rows="4"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Cancel
                                </button>
                                <button type="submit" class="btn btn-danger">
                                    Deny This Deal!
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @php $i++; @endphp
        </tr>
    @endforeach
@endif
