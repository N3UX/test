@extends('layouts.admin')

@section('title', 'Listado de Ventas')
@section('content-header', 'Listado de Ventas')
@section('content-actions')
    <a href="{{route('cart.index')}}" class="btn btn-danger">Realizar Venta</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-7"></div>
            <div class="col-md-4">
                <form action="{{route('orders.index')}}">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="date" name="start_date" class="form-control" value="" />
                        </div>
                        <div class="col-md-5">
                            <input type="date" name="end_date" class="form-control" value="" />
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-outline-primary" type="submit">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Empleado</th>
                    <th>Total</th>
                    <th>Cantidad Recibida</th>
                    <th>Estado</th>
                    <th>Cambio</th>
                    <th>Creado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->getCustomerName()}}</td>
                    <td>{{ config('') }} {{$order->formattedTotal()}}</td>
                    <td>{{ config('') }} {{$order->formattedReceivedAmount()}}</td>
                    <td>
                        @if($order->receivedAmount() == 0)
                            <span class="badge badge-danger">No pagado</span>
                        @elseif($order->receivedAmount() < $order->total())
                            <span class="badge badge-warning">Pago Parcial</span>
                        @elseif($order->receivedAmount() == $order->total())
                            <span class="badge badge-success">Pagado</span>
                        @elseif($order->receivedAmount() > $order->total())
                            <span class="badge badge-success">Pagado</span>
                        @endif
                    </td>
                    <td>{{config('')}} {{number_format($order->total() - $order->receivedAmount(), 2)}}</td>
                    <td>{{$order->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th>{{ config('') }} {{ number_format($total, 2) }}</th>
                    <th>{{ config('') }} {{ number_format($receivedAmount, 2) }}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        {{ $orders->render() }}
    </div>
</div>
@endsection

