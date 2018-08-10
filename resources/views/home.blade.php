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
            <th scope="col">Продано за последний день</th>
            <th scope="col">Ссылка на товар </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($goods as $k=>$good)
            <tr>        
                <td>{{ $good->articul }}</td>
                <td>{{ $good->description }}</td>
                <td>{{ $good->price }}</td>
                <td>{{ $good->change_prev_day }}</td>
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
    <monitoring-stores></monitoring-stores>
</section>

<section id="about-us">    
    <div class="row">
        <div class="col-12 text-center">
            <h2>О нас</h2>
        </div>

        <div class="col-12">
            <p>
                Мы группа разработчиков программного обеспечения. Уже более 10 лет мы разрабатываем
                программное обеспечения и web-продукты для наших клиентов. Наш сайт полностью
                конфиденциален и уникален, поэтому, дабы не накручивать себе популярность за счет наших
                клиентов и оставить в тайне использование ими данного ресурса, а так же что бы не
                скомпрометировать их, мы не будем озвучивать их брэнды и имена. Но поверьте их очень много.
            </p>
            <p>
                <strong>Внимание!!!</strong> Мы не взламываем сайты и не проникаем в базы данных Ваших конкурентов. Мы
                за честность. Для получения всей не обходимой информации Мы пользуемся открытыми
                ресурсами в сети интернет.
            </p>
            <p>Какие возможности и выгоду дает наш ресурс Вам, как клиенту:</p>
            <ol>
                <li>С нашей помощью вы можете анализировать цены Ваших конкурентов на сайте в личном кабинете</li>
                <li>Так же у Вас появится возможность анализировать продажи как Ваших товаров, так и товаров конкурентов</li>
                <li>Кроме мониторинга цен конкурентов наш сервис может быть настроен на автоматический сбор любой информации, находящейся в свободном доступе в сети интернет</li>
                <li>Предоставим Вам возможность воспользоваться удобная системой формирования отчетов и сохранения данных. Онлайн просмотр динамики изменения цен/продаж конкурентов, отклонений цен от средних значений, доли брендов и др.</li>
                <li>Разработаем для Вас индивидуальные отчеты, и встроим их в Ваш личный кабинет</li>
                <li>У Вас появится возможность отслеживать новые товары, появившиеся у Ваших конкурентов, а так же товары вышедшие из реализации</li>
            </ol>
        </div>        
    </div>

</section>

@endsection

<script>
    window.onload = function() {
        let goods = [];
        @foreach ($goods as $k=>$good)
            @if($k <= 10)
                @continue
            @else
                goods.push(@json($good))
            @endif
        @endforeach
        const goods_showed = goods;

        function updateTable(){
            $('#goods_table tbody tr:last').fadeOut(1000,function(){
                $(this).remove();
            });
            let good = goods.pop();
            let tr = '<tr style="display: none">'
                    +'<td>' + good.articul + '</td>'
                    +'<td>' + good.description + '</td>'
                    +'<td>' + good.price + '</td>'
                    +'<td>' + good.change_prev_day + '</td>'
                    +'<td><a href="https://shop.beletag.com/catalog/'+good.category_id+'/'+good.site_id+'/">https://shop.beletag.com/catalog/'+good.category_id+'/'+good.site_id+'/</a></td>'
                +'</tr>';
            $(tr).hide().prependTo($('#goods_table tbody')).fadeIn(1000);
            if(goods.length == 0)
                goods = goods_showed;       
        }

        let interval = setInterval(updateTable,3000);
    };
    
</script>