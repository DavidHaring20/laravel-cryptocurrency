<div>

    <h2>Update cryptocurrency</h2>

    {{$info}}
    
    <form method="POST" action="/api/updateCryptocurrency">
        @csrf
        @method('PATCH')

        <label for="symbol">Symbol</label>
        <input id="symbol" type="text" name="symbol">

        <label for="price">Price</label>
        <input id="price" type="decimal" name="price">

        <button type="submit">Update</button>
    </form>
</div>