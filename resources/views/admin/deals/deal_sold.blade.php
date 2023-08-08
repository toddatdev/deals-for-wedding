@extends('admin.layouts.app')

@section('title', 'Deal Sold')

@push('customCSS')
<style type="text/css" media="screen">
    .action-cons {
        font-size: 20px;
        font-weight: bold;
    }

    .action-cons:hover {
        font-size: 20px;
        color: #f8f9fa;
        background: #339af0;
    }
</style>
@endpush

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Sold Deals</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @include('flash-message')
                        <div class="card-header">
                            <div class="card-title">Sold Deals Summary</div>
                        </div>
                        <div class="card-body">
                            <form style="margin-bottom: 20px;" method="post" action="{{ route('deals.soldf') }}">
                                @CSRF
                                <div class="row">
                                    <div class="col-md-6 col-sm-6m col-xs-12">
                                        <select style="width: 80%; display: inline-block;" name="filter_data" class="form-control" >
                                            <option value="">-Select Duration-</option>
                                            <option value="7days">7 Days</option>
                                            <option value="onemonth">One Month</option>
                                            <option value="threemonth">Three Month</option>
                                            <option value="All">All Saved Deals</option>
                                        </select>
                                            <input type="submit" name="submit" class="btn btn-success" value="Filter">
                                    </div>
                                    <div class="col-md-6 col-sm-6m col-xs-12">
                                        <select style="width: 80%; display: inline-block;" name="market" class="form-control" >
                                            <option value="">-Select Market/City-</option>
                                            @foreach($market as $state)
							<option value="{{isset($state->name) ? $state->name : ''}}" {{isset($_REQUEST['state']) ? (($_REQUEST['state'] == $state->code) ? 'selected="selected"' : '') : ''}}>{{isset($state->code) ? $state->name : ''}}</option>
							@endforeach
                                        </select>
                                            <input type="submit" name="submit" class="btn btn-success" value="Filter">
                                    </div>
                                    
                                </div>
                            </form>
                            <table class="table table-bordered" id="userList">
                                <thead>
                                    <tr>
                                        <th><strong>Sr. No.</strong></th>
                                        <th><strong>Deal Title</strong></th>
                                        <th><strong>Market / City</strong></th>
                                        <th><strong>Total Saved</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($dealViews))
                                    @php $i = 1;  @endphp
                                    @foreach ($dealViews->unique('deal_id') as $viewed)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td><a href="{{route('vendor.dealdetail', $viewed->deal_id)}}">{{ $viewed->deal['title'] }}</a></td>   
                                        <td>{{ $viewed->deal['state'] }}</td>                                     
                                        <td>
                                            {{$dealViews->where('deal_id', $viewed->deal_id)->count()}}
                                        </td>                                        
                                        @php $i++; @endphp
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @endsection

    @push('customJs')
    <script>
        $(document).ready(function() {

            $('#userList').DataTable();

        });
    </script>

    @endpush