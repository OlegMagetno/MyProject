

    <div style="margin-top:50px;" id="dataAnnouncements">
        @if (count($announcements) != 0)
            @foreach($announcements as $value)
                <div id="announcement">
                    <div id="title"><h2> {{$value->nameMarka . ' ' . $value->nameModel . ' ' . $value->volume}} </h2></div>
                    <div id="imageBlock">
                        <img src="{{ $value->action[0]->action }}">
                    </div>
                    <div id="information">
                        <h4>Область: {{ $value->nameRegion }}</h4>
                        <h4>Город: {{ $value->nameCity }}</h4>
                        <h4>Объем: {{ $value->volume }}</h4>
                        <h4>Пробег: {{ $value->mileage }}</h4>
                        <h4>Количество владельцев: {{ $value->count_owners }}</h4>
                        <h4>Цена: <h2>{{ $value->price }}$</h2></h4>
                    </div>
                    <div id="smallImg">
                            @foreach($value->action as $photo)
                                <img src="{{ $photo->action }}">
                            @endforeach
                    </div>
                    <div id="description" style="font-size: 14pt;">{{ $value->description }}</div>
                </div>
            @endforeach
            <div id="pagination">{{ $announcements->links() }}</div>
         @endif

    </div>

<script type="text/javascript">

</script>

