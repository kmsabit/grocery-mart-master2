@extends('layouts.admin-app')

@section('title')

    Orders

@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Orders</h4>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Order Date</th>
                                <th>Customer Name</th>
                                <th>Ship to</th>
                                <th>Order Price</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{'GMRT000'.$order->order_id}}</td>
                                    <td>{{$order->date}}</td>
                                    <td>{{$order->first_name.' '.$order->last_name}}</td>
                                    <td>{{$order->street_address_one.', '.$order->street_address_two.', '.$order->town.', '.$order->zip}}</td>
                                    <td>{{$order->cart_total}}</td>
                                    <td>{{$order->phone}}</td>
                                    <td>
                                        @if($order->status === 'Processing')
                                            {{Form::hidden('', $badge="success")}}
                                            {{Form::hidden('', $write="Processing")}}
                                        @endif
                                        @if($order->status === 'Complete')
                                            {{Form::hidden('', $badge='danger')}}
                                            {{Form::hidden('', $write='Complete')}}
                                        @endif
                                        <a class="badge badge-{{$badge}}"
                                           href="{{\Illuminate\Support\Facades\URL::to('orderstatus/'.$order->order_id.'')}}">{{$write}}</a>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('getinvoice/'.$order->order_id)}}" class="btn btn-outline-primary">Print</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="backend/js/data-table.js"></script>
@endsection
