@extends('layouts.landing')

@section('content')
<section id="monitoring-table">
    <div class="row">
        <table class="table table-responsive-md" id="goods_table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">Артикул</th>
            <th scope="col">Название товара</th>
            <th scope="col">Цена (руб.)</th>
            <th scope="col">Ссылка на товар </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($goods as $k=>$good)
            <tr>        
                <td>{{ $good->articul }}</td>
                <td>{{ $good->description }}</td>
                <td>{{ $good->price }}</td>
                <td><a href="https://shop.beletag.com/catalog/{{$good->category_id}}/{{$good->site_id}}/">https://shop.beletag.com/catalog/{{$good->category_id}}/{{$good->site_id}}/</a></td>
            </tr>
            @if($k == 10)
                @break
            @endif
            @endforeach
        </tbody>
        </table>
    </div>
</section>

<section id="monitoring-stores">
    
</section>

@endsection

<script>
    window.onload = function() {
        let goods = [];
        let goods_showed = [];
        @foreach ($goods as $k=>$good)
            @if($k <= 10)
                @continue
            @else
                goods.push(@json($good))
            @endif
        @endforeach

        function updateTable(){
            $('#goods_table tbody tr:last').fadeOut(1000,function(){
                $(this).remove();
            });
            let good = goods.pop();
            goods_showed.push(good);
            let tr = '<tr style="display: none">'
                    +'<td>' + good.articul + '</td>'
                    +'<td>' + good.description + '</td>'
                    +'<td>' + good.price + '</td>'
                    +'<td><a href="https://shop.beletag.com/catalog/'+good.category_id+'/'+good.site_id+'/">https://shop.beletag.com/catalog/'+good.category_id+'/'+good.site_id+'/</a></td>'
                +'</tr>';
            $(tr).hide().prependTo($('#goods_table tbody')).fadeIn(1000);
            if(goods.length == 0)
                goods = goods_showed;
                goods_showed = [];            
        }

        let interval = setInterval(updateTable,3000);
    };
    
</script>