<div class="modal fade" id="filtersForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Фильтры</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post"  action="/announcements" id="filters">
                @csrf
                <!--Регион-->
                    <div class="form-group">
                        <label for="filtersRegions">Регион</label>
                        <select class="form-control" id="filtersRegions" name="filtersRegions" onchange="getRegionsForFilters()">
                            <option value="">--Выберите регион--</option>
                            @foreach ($regions as $key=>$value)
                                <option value="{{ $value->id }}" >{{ $value->nameRegion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!--Город-->
                    <div class="form-group">
                        <label for="filtersCities">Город</label>
                        <select class="form-control" id="filtersCities" name="filtersCities" disabled>

                        </select>
                    </div>
                    <!-- Marka -->
                    <div class="form-group">
                        <label for="filtersMarks">Марка</label>
                        <select class="form-control" id="filtersMarks" name="filtersMarks" onchange="getModelsForFilters()">
                            <option value="">--Выберите марку--</option>
                            @foreach ($marks as $key=>$value)
                                <option value="{{ $value->id }}" >{{ $value->nameMarka }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Model -->
                    <div class="form-group">
                        <label for="filtersModels">Модель</label>
                        <select class="form-control" id="filtersModels" name="filtersModels" disabled>

                        </select>
                    </div>
                    <!--Обьем двигаетля-->
                    <div class="form-group">
                        <label for="volume1">Обьем двигаетля(л) от:</label>
                        <input type="text" class="form-control" id="volume1" name="volume1">
                        <label for="volume2">Обьем двигаетля(л) до</label>
                        <input type="text" class="form-control" id="volume2" name="volume2">
                    </div>
                    <!--Пробег-->
                    <div class="form-group">
                        <label for="mileage1">Пробег(км) от:</label>
                        <input type="text" class="form-control" id="mileage1" name="mileage1">
                        <label for="mileage2">Пробег(км) до:</label>
                        <input type="text" class="form-control" id="mileage2" name="mileage2">
                    </div>
                    <!--Количество владельцев-->
                    <div class="form-group">
                        <label for="quantityOwners1">Количество владельцев от:</label>
                        <input type="text" class="form-control" id="quantityOwners" name="quantityOwners1">
                        <label for="quantityOwners1">Количество владельцев до:</label>
                        <input type="text" class="form-control" id="quantityOwners" name="quantityOwners2">
                    </div>
                    <!--Цена-->
                    <div class="form-group">
                        <label for="price1">Цена($) от:</label>
                        <input type="number" class="form-control" id="price1" name="price1">
                        <label for="price2">Цена($) до:</label>
                        <input type="number" class="form-control" id="price2" name="price2">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="setFilters()" >Save changes</button>
            </div>

        </div>
    </div>
</div>
