<div>
    <table>
        <tr>
            <th><h2>Name</h2></th>
            <th><h2>Symbol</h2></th>
            <th><h2>Price</h2></th>
            <th><h2>Volume 24h</h2></th>
            <th><h2>Volume 24h Change 24h</h2></th>
            <th><h2>Market Cap</h2></th>
            <th><h2>Market Cap Change 24h</h2></th>
            <th><h2>Percent_Change_15m</h2></th>
            <th><h2>Percent_Change_30m</h2></th>
            <th><h2>Percent_Change_1h</h2></th>
            <th><h2>Percent_Change_6h</h2></th>
            <th><h2>Percent_Change_12h</h2></th>
            <th><h2>Percent_Change_24h</h2></th>
            <th><h2>Percent_Change_7d</h2></th>
            <th><h2>Percent_Change_30d</h2></th>
            <th><h2>Percent_Change_1y</h2></th>
            <th><h2>Ath Price</h2></th>
            <th><h2>Ath Date</h2></th>
            <th><h2>Percent Change from Ath Price</h2></th>
        </tr>
        @foreach ($cryptocurrencies as $cryptocurrency)
        <tr>
            <td>{{$cryptocurrency['name']}}</td>
            <td>{{$cryptocurrency['symbol']}}</td>
            <td>{{$cryptocurrency['quotes']['price']}}</td>
            <td>{{$cryptocurrency['quotes']['volume_24h']}}</td>
            <td>{{$cryptocurrency['quotes']['volume_24h_change_24h']}}</td>
            <td>{{$cryptocurrency['quotes']['market_cap']}}</td>
            <td>{{$cryptocurrency['quotes']['market_cap_change_24h']}}</td>
            <td>{{$cryptocurrency['quotes']['percent_change_15m']}}</td>
            <td>{{$cryptocurrency['quotes']['percent_change_30m']}}</td>
            <td>{{$cryptocurrency['quotes']['percent_change_1h']}}</td>
            <td>{{$cryptocurrency['quotes']['percent_change_6h']}}</td>
            <td>{{$cryptocurrency['quotes']['percent_change_12h']}}</td>
            <td>{{$cryptocurrency['quotes']['percent_change_24h']}}</td>
            <td>{{$cryptocurrency['quotes']['percent_change_7d']}}</td>
            <td>{{$cryptocurrency['quotes']['percent_change_30d']}}</td>
            <td>{{$cryptocurrency['quotes']['percent_change_1y']}}</td>
            <td>{{$cryptocurrency['quotes']['ath_price']}}</td>
            <td>{{$cryptocurrency['quotes']['ath_date']}}</td>
            <td>{{$cryptocurrency['quotes']['percent_from_price_ath']}}</td>
        </tr>
        @endforeach  
    </table>
</div>
