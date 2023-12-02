<div>
    <table>
        <tr>
            <th><h2>Name</h2></th>
            <th><h2>Symbol</h2></th>
            <th><h2>Price</h2></th>
        </tr>
        @foreach ($cryptocurrencies as $cryptocurrency)
        <tr>
            <td>{{$cryptocurrency['name']}}</td>
            <td>{{$cryptocurrency['symbol']}}</td>
            <td>{{$cryptocurrency['price']}}</td>
        </tr>
        @endforeach  
    </table>
</div>
