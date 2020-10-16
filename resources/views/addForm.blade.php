<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Добавить объявление</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="/store" id="addAnnouncements">
                @csrf
                <!--Регион-->
                    <div class="form-group">
                        <label for="egions">Регион</label>
                        <select class="form-control" id="regions" name="regions" onchange="getRegions()" required>
                            <option value="">--Выберите регион--</option>
                            @foreach ($regions as $key=>$value)
                                <option value="{{ $value->id }}" >{{ $value->nameRegion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!--Город-->
                    <div class="form-group">
                        <label for="cities">Город</label>
                        <select class="form-control" id="cities" name="cities" disabled required>

                        </select>
                    </div>
                    <!-- Marka -->
                    <div class="form-group">
                        <label for="marks">Марка</label>
                        <select class="form-control" id="marks" name="marks" onchange="getModels()" required>
                            <option value="">--Выберите марку--</option>
                            @foreach ($marks as $key=>$value)
                                <option value="{{ $value->id }}" >{{ $value->nameMarka }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Model -->
                    <div class="form-group">
                        <label for="models">Модель</label>
                        <select class="form-control" id="models" name="models" disabled required>

                        </select>
                    </div>
                    <!--Обьем двигаетля-->
                    <div class="form-group">
                        <label for="volume">Обьем двигаетля(л)</label>
                        <input type="text" class="form-control" id="volume" name="volume" required>
                    </div>
                    <!--Пробег-->
                    <div class="form-group">
                        <label for="mileage">Пробег</label>
                        <input type="text" class="form-control" id="mileage" name="mileage" required>
                    </div>
                    <!--Количество владельцев-->
                    <div class="form-group">
                        <label for="quantityOwners">Количество владельцев</label>
                        <input type="text" class="form-control" id="quantityOwners" name="quantityOwners" required>
                    </div>
                    <!--Цена-->
                    <div class="form-group">
                        <label for="price">Цена($)</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                    <!--Фото-->
                    <div class="form-group">
                        <label for="photos">Прикрепите несколько фото</label>
                        <input type="file" class="form-control-file" id="photos" name="photos[]" accept=".jpg, .jpeg, .png" multiple required>
                        <small>Фото должны быть не более 2Мб</small>
                    </div>
                    <!--Описание-->
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="addAnnouncements" class="btn btn-primary"   >Save changes</button>
            </div>

        </div>
    </div>
</div>
