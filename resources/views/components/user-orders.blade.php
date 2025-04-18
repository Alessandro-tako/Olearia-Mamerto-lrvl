@if($orders->isEmpty())
    <div class="text-center my-5">
        <h3>Non hai ordini da visualizzare</h3>
        <p><a class="btn btn-custom mt-3" href="{{ route('article.index') }}">Dai uno sguardo ai nostri prodotti</a></p>
    </div>
@else
    @foreach($orders as $order)
        <div class="card bg-dark text-white mb-4 shadow rounded">
            <div class="card-body">
                <h5 class="card-title">Ordine #{{ $order->id }}</h5>
                <p class="card-text mb-1">Totale: <strong>€{{ number_format($order->total_amount, 2) }}</strong></p>
                <p class="card-text mb-3">Stato: <span class="badge bg-info text-dark">{{ ucfirst($order->status) }}</span></p>

                <h6>Articoli ordinati:</h6>
                <ul class="list-group list-group-flush">
                    @foreach($order->items as $item)
                        <li class="list-group-item bg-dark text-white d-flex justify-content-between align-items-center">
                            <div>
                                {{ $item->article->title }}<br>
                                <small>Quantità: {{ $item->quantity }}</small>
                            </div>
                            <span>€{{ number_format($item->price, 2) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
@endif
