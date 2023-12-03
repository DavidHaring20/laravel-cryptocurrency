<div>
<div>
    <table>
        <tr>
            <th><h2>Rank</h2></th>
            <th><h2>Name</h2></th>
            <th><h2>Symbol</h2></th>
            <th><h2>Price</h2></th>
            <th><h2>Change Percentage 15m</h2></th>
        </tr>
        
        @foreach ($cryptocurrencies as $cryptocurrency)
            <tr>

                <td>{{ $loop->iteration }}</td>
                <td>{{$cryptocurrency['name']}}</td>
                <td>{{$cryptocurrency['symbol']}}</td>
                <td>{{$cryptocurrency['price']}}</td>
                <td>{{$cryptocurrency['percent_change_15m']}}</td>
            </tr>
        @endforeach  
    </table>
</div>

</div>
