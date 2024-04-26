@extends('layouts.html-layout')

@section('title', 'Cash')
@section('content')
@section('navegacion')
    <a href="{{ route('dashboard.main') }}">dasboard</a>
    <a href="{{ route('kitchen.main') }}">kitchen</a>
@endsection

    <main class="w-full h-full min-h-[calc(100vh-3.5rem)] p-6 px-14 flex flex-col gap-6">
        <h1 class="text-4xl font-bold p-6 rounded w-fit bg-stone-200">ESTÁS EN LA CAJA</h1>
        <section class="w-full h-fit flex flex-wrap flex-col gap-4">
            <div class="all-orders-container flex w-full h-[200px] gap-10">
                <ul id="orders-ctn" class="flex flex-col gap-4 select-none text-orange-950 rounded w-full h-[75vh] p-4 overflow-y-scroll">
                    <div class="flex text-2xl w-fit h-fit items-center gap-6">
                        <h2 class="font-bold bg-orange-500 text-orange-50 p-4 rounded">Para comer aquí</h2>
                        <h3 class="font-bold bg-yellow-400 text-orange-50 p-4 rounded">Total: {{ count($eatHereOrders) }}</h3>
                    </div>
                    @foreach ($eatHereOrders as $eatHereOrder)
                        <div class="order-container bg-walter-200 rounded-lg mb-4 drop-shadow-lg w-full h-fit">
                            <div class="flex text-lg flex-row justify-between items-center font-semibold p-2 px-4 rounded-t bg-orange-500 text-orange-50">
                                <div>
                                    <strong>Pedido: </strong>
                                    {{ $eatHereOrder['id'] }}
                                </div>
                                <div>
                                    <strong>Mesa: {{ $eatHereOrder['table_id'] }}</strong>
                                </div>
                                <p>{{ \Carbon\Carbon::parse($eatHereOrder['created_at'])->format('d/m/Y H:i:s') }}</p>
                            </div>
                            <div class="flex items-center px-4 pt-0">
                                <ul class="flex flex-col w-full">
                                    @foreach ($eatHereOrder['orders_line'] as $orderLine)
                                        <li class="order-line flex flex-col items-center py-4 ">
                                            <div class="flex items-center  w-full ">
                                                <div class="text-lg flex flex-col gap-1 ">
                                                    <div>
                                                        <strong>{{ $orderLine['product']['name'] }} x {{ $orderLine['quantity'] }}</strong>
                                                    </div>
                                                </div>
                                                <div class="flex justify-center items-center w-20 h-20 ml-auto bg-orange-500 rounded-full">
                                                    <img src="{{"/storage/" . $orderLine['product']['image_url'] }}" alt="{{ $orderLine['product']['name'] }}" class="w-16 h-16">
                                                </div>
                                            </div>
                                            <div class="ingredients-container hidden bg-walter-400 p-2 h-fit  m-2 mt-6 rounded text-lg w-full">
                                                {{ $orderLine['product']['description'] }}
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </ul>

                <ul class="flex flex-col gap-4 select-none text-orange-950 w-full h-[75vh] rounded p-4 overflow-y-scroll bg-stone-200">
                    <div class="flex text-2xl w-fit h-fit items-center gap-6">
                        <h2 class="font-bold bg-orange-500 text-orange-50 p-4 rounded">Para llevar</h2>
                        <h3 class="font-bold bg-yellow-400 text-orange-50 p-4 rounded">Total: {{ count($takeAwayOrders) }}</h3>
                    </div>
                    @foreach ($takeAwayOrders as $takeAwayOrder)
                        <div class="order-container bg-walter-200 rounded-lg mb-4 drop-shadow-lg w-full h-fit">
                            <div class="flex text-lg flex-row justify-between items-center font-semibold p-2 px-4 rounded-t bg-orange-500 text-orange-50">
                                <div>
                                    <strong>Pedido: </strong>
                                    {{ $takeAwayOrder['id'] }}
                                </div>
                                <div>
                                    <strong>{{ $takeAwayOrder['take_away'] ? 'Para llevar' : 'Mesa: ' . $takeAwayOrder['table_id'] }}</strong>
                                </div>
                                <p>{{ \Carbon\Carbon::parse($takeAwayOrder['created_at'])->format('d/m/Y H:i:s') }}</p>
                            </div>
                            <div class="flex items-center px-4 pt-0">
                                <ul class="flex flex-col w-full">
                                    @foreach ($takeAwayOrder['orders_line'] as $orderLine)
                                        <li class="order-line flex flex-col items-center py-4 w-full">
                                            <div class="flex items-center w-full">
                                                <div class="text-lg flex flex-col gap-1">
                                                    <div>
                                                        <strong>{{ $orderLine['product']['name'] }} x {{ $orderLine['quantity'] }}</strong>
                                                    </div>
                                                </div>
                                                <div class="flex justify-center items-center w-20 h-20 ml-auto bg-orange-500 rounded-full">
                                                    <img src="{{ asset('storage/' . $orderLine['product']['image_url']) }}" alt="{{ $orderLine['product']['name'] }}" class="w-16 h-16">
                                                </div>
                                            </div>
                                            <div class="ingredients-container hidden bg-walter-400 p-2 h-fit m-2 mt-6 rounded text-lg w-full">
                                                {{ $orderLine['product']['description'] }}
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </ul>

                <ul id="orders-ctn" class="flex flex-col gap-4 select-none text-orange-950 rounded w-full h-[75vh] p-4 overflow-y-scroll">
                    <div class="flex text-2xl w-fit h-fit items-center gap-6">
                        <h2 class="font-bold bg-orange-500 text-orange-50 p-4 rounded">En cola</h2>
                        <h3 class="font-bold bg-yellow-400 text-orange-50 p-4 rounded">Total: {{ count($preparingOrders) }}</h3>
                    </div>
                    @foreach ($preparingOrders as $preparingOrder)
                        <div class="order-container bg-walter-200 rounded-lg mb-4 drop-shadow-lg w-full h-fit">
                            <div class="flex text-lg flex-row justify-between items-center font-semibold p-2 px-4 rounded-t bg-orange-500 text-orange-50">
                                <div>
                                    <strong>Pedido: </strong>
                                    {{ $preparingOrder['id'] }}
                                </div>
                                <div>
                                    <strong>{{ $takeAwayOrder['take_away'] ? 'Para llevar' : 'Mesa: ' . $takeAwayOrder['table_id'] }}</strong>
                                </div>
                                <p>{{ \Carbon\Carbon::parse($preparingOrder['created_at'])->format('d/m/Y H:i:s') }}</p>
                            </div>
                            <div class="flex items-center px-4 pt-0">
                                <ul class="flex flex-col w-full">
                                    @foreach ($preparingOrder['orders_line'] as $orderLine)
                                        <li class="order-line flex flex-col items-center py-4 ">
                                            <div class="flex items-center  w-full ">
                                                <div class="text-lg flex flex-col gap-1 ">
                                                    <div>
                                                        <strong>{{ $orderLine['product']['name'] }} x {{ $orderLine['quantity'] }}</strong>
                                                    </div>
                                                </div>
                                                <div class="flex justify-center items-center w-20 h-20 ml-auto bg-orange-500 rounded-full">
                                                    <img src="{{"/storage/" . $orderLine['product']['image_url'] }}" alt="{{ $orderLine['product']['name'] }}" class="w-16 h-16">
                                                </div>
                                            </div>
                                            <div class="ingredients-container hidden bg-walter-400 p-2 h-fit  m-2 mt-6 rounded text-lg w-full">
                                                {{ $orderLine['product']['description'] }}
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </ul>

            </div>

        </section>

    </main>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>

    <script>
        function ingredientsDisplay(card)
        {
            const ingredientsContainer = $(card).closest('.order-line').find('.ingredients-container');
            const plusSvg = $(card).find('svg');
            ingredientsContainer.slideToggle(200);
            plusSvg.toggleClass('text-red-500 rotate-45');
        }
    </script>
    <style>
        #orders-ctn{
            background-color: #ffedd5;
        }
    </style>
@endsection

