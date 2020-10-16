@include('header')


@if (Route::has('login'))
    @auth
        <span class="position-fixed" style="z-index: 100; top:5px; right: 110px;">
            <!-- Button trigger modal -->
            <div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    Разместить объявление
                </button>
            </div>
            <div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#filtersForm">
                    Фильтры
                </button>
            </div>
        </span>
    @endif

@endif

@include('announcement')
@include('addForm')
@include('filtersForm')
<script type="text/javascript">


    function fetch_data(page) {

        var _tocken = $("input[name=_token]").val();

        $.ajax({
            url: "{{ route('pagination.fetch') }}",
            method: "POST",
            data: {_token: _tocken, page: page},
            success: function (data) {

                $('#dataAnnouncements').html(data);

            }
        });
    }
</script>

@include('footer')
