@if($orders->isEmpty())
    <H3>Non hai ordini da visualizzare</H3>
    <p><a class="btn btn-custom" href="{{route('article.index')}}">Dai uno sguardo ai nostri prodotti</a></p>
@else
    @foreach($orders as $order)
    <div>
        <p>ID Ordine: {{ $order->id }}</p>
        <p>Totale: €{{ number_format($order->total_amount, 2) }}</p>
        <p>Stato: {{ ucfirst($order->status) }}</p>

        <h3>Articoli:</h3>
        <ul>
            @foreach($order->items as $item)
                <li>{{ $item->article->title }} - Quantità: {{ $item->quantity }} - Prezzo: €{{ number_format($item->price, 2) }}</li>
            @endforeach
        </ul>
    </div>
    <hr>
    @endforeach
@endif
