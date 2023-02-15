@extends('layouts.app')
@section('content')
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($cart))
                            @foreach ($cart as $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td class="td-img"><img src="{{ Storage::url($item['image']) }}" width="100%" height="100%"
                                        alt=""></td>
                                <td>${{ $item['price'] }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td><button>Update</button>
                                    <button>Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">{{ __('Empty cart') }}</td>
                            </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>

                            <th colspan="4">Total</th>
                            <th>${{ $total }}</th>
                        </tr>

                    </tfoot>
                </table>
                @if($cart)
                 <a href="{{ route('checkout') }}" class="btn btn-primary" style="float:right">Checkout</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@push('css')
<style>
    .td-img {
        width: 80px;
        height: 80px;
    }
</style>

@endpush
