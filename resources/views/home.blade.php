@extends('layouts.landing')

@section('content')

@if(Session::has('success'))
    <div class="alert alert-success" role="alert">
     {{ Session::get('success') }}
    </div>
@endif

<section id="monitoring-table" class="pt-5 pb-5">
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
                <td>{{ substr(mb_strtolower($good->articul), 0,20) }}</td>
                <td>{{ $good->description }}</td>
                <td>{{ $good->price }}</td>
                <td class="text-center">{{ $good->change_prev_day }}</td>
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

<section id="monitoring-stores" class="pt-5 pb-5">    
    <div class="row">
        <div class="col-12 text-center">
            <div class="section-heading text-center">
                <h2>Отслеживаемые товары</h2>
                <div class="line-shape"></div>
            </div>
        </div>
    </div>
    <monitoring-stores></monitoring-stores>
</section>

<section id="about-us" class="pt-5 pb-5">    
    <div class="row">
        <div class="col-12 text-center">
            <div class="section-heading text-center">
                <h2>О нас</h2>
                <div class="line-shape"></div>
            </div>
        </div>
    </div>
    <div class="row align-items-center">
        <div class="col-lg-6">
            <div class="story-content">                
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
        <div class="col-lg-6">
            <img class="img-fluid d-flex mx-auto" src="{{asset('images/site/about.png')}}" alt="">
        </div>
    </div>

</section>

<section id="pricing" class="pt-5 pb-5">    
    <div class="row">
        <div class="col-12 text-center">
            <div class="section-heading text-center">
                <h2>Цены</h2>
                <div class="line-shape"></div>
            </div>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-12 col-md-6 col-lg-3">
            <!-- Package Price  -->
            <div class="single-price-plan text-center">
                <!-- Package Text  -->
                <div class="package-plan">
                    <h5>Мониторинг цен<br>&nbsp</h5>
                    <div class="ca-price d-flex justify-content-center">
                        <span><i class="fas fa-ruble-sign"></i></span>
                        <h4>0,02</h4>
                    </div>
                </div>
                <div class="package-description">
                    <p>минимум 10 000 единиц</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <!-- Package Price  -->
            <div class="single-price-plan text-center">
                <!-- Package Text  -->
                <div class="package-plan">
                    <h5>Мониторинг продаж<br>&nbsp</h5>
                    <div class="ca-price d-flex justify-content-center">
                        <span><i class="fas fa-ruble-sign"></i></span>
                        <h4>2</h4>
                    </div>
                </div>
                <div class="package-description">
                    <p>минимум 500 единиц</p>
                    <p>При выборе мониторинга продаж, если у выбранных позиций есть цвета и размеры, учитывайте что за 1 единицу, берется 1 единица товара/продукта одного цвета и размера.</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <!-- Package Price  -->
            <div class="single-price-plan text-center">
                <!-- Package Text  -->
                <div class="package-plan">
                    <h5>Мониторинг вновь появившегося / ушедшего товара</h5>
                    <div class="ca-price d-flex justify-content-center">
                        <span><i class="fas fa-ruble-sign"></i></span>
                        <h4>500</h4>
                    </div>
                </div>
                <div class="package-description">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <!-- Package Price  -->
            <div class="single-price-plan text-center">
                <!-- Package Text  -->
                <div class="package-plan">
                    <h5>инструмент аналитики<br>&nbsp</h5>
                    <div class="ca-price d-flex justify-content-center">
                        <span><i class="fas fa-ruble-sign"></i></span>
                        <h4>200</h4>
                    </div>
                </div>
                <div class="package-description">
                    <p>Табличная форма считается базовым инструментом и в стоимость не входит</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <p>
            Если товар/продукт в себя включает 5 цветов и 2 размера, то этот товар будет считаться как 10 единиц.
        </p>
        <p>
            На вопрос почему так, сразу Вам ответим, это не наше желание с целью получить от Вас выгоду в многократном размере. Это, если упрощенно сказать, работа процессорного времени. К примеру что бы вычислить количество продаж товара у которого 3 цвета и 5 размеров, системе понадобится в 15 раз
    больше времени, чем если бы товар имел 1 цвет и 1 размер.
        </p>
    </div>
</section>

<section id="contacts" class="pt-5 pb-5">    
    <div class="row">
        <div class="col-12 text-center">
            <div class="section-heading text-center">
                <h2>Связаться</h2>
                <div class="line-shape"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container">
            {!! Form::open(['route'=>'sendmesasage', 'class'=>'contact-form', 'id'=>'myForm'])!!} 
                <div class="row justify-content-center">
                    <div class="col-lg-5 {{ $errors->has('name') ? 'has-error' : ''}} ">
                        <input 
                            name="name" 
                            placeholder="Имя" 
                            onfocus="this.placeholder = ''" 
                            onblur="this.placeholder = 'Имя'" 
                            class="common-input mt-2" 
                            required="" 
                            type="text"
                            value="{{ old('name') }}"
                        >
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="col-lg-5">
                        <input 
                            name="email" 
                            placeholder="Email" 
                            pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" 
                            onfocus="this.placeholder = ''" 
                            onblur="this.placeholder = 'Email'" 
                            class="common-input mt-2" 
                            required="" 
                            type="email"
                            value="{{ old('email') }}"
                        >
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="col-lg-10">
                        <textarea 
                            class="common-textarea mt-2" 
                            name="message" 
                            placeholder="Сообщение" 
                            onfocus="this.placeholder = ''" 
                            onblur="this.placeholder = 'Сообщение'" 
                            required=""
                        >
                        {{ old('message') }}
                        </textarea>
                        <span class="text-danger">{{ $errors->first('message') }}</span>
                </div>
                <div class="col-lg-10 d-flex justify-content-end">
                    <button class="primary-btn white-bg d-inline-flex align-items-center mt-3"><span class="mr-10">Отправить</span><span class="lnr lnr-arrow-right"></span></button> <br>
                </div>
                <div class="alert-msg"></div>
                </div>
            {!! Form::close() !!} 
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
            $('#goods_table tbody tr:last').remove();
            let good = goods.shift();
            let tr = '<tr style="display: none">'
                    +'<td>' + good.articul.slice(0,20).toLowerCase() + '</td>'
                    +'<td>' + good.description + '</td>'
                    +'<td>' + good.price + '</td>'
                    +'<td class="text-center">' + good.change_prev_day + '</td>'
                    +'<td><a href="https://shop.beletag.com/catalog/'+good.category_id+'/'+good.site_id+'/">https://shop.beletag.com/catalog/'+good.category_id+'/'+good.site_id+'/</a></td>'
                +'</tr>';
            $(tr).hide().prependTo($('#goods_table tbody')).fadeIn(1000);
            if(goods.length == 0)
                goods = goods_showed;       
        }

        let interval = setInterval(updateTable,3000);
    };
    
</script>