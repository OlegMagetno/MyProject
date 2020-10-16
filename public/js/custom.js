    function getModels(){
        var id = $('#marks').val();

        $.ajax({
            type:'GET',
            url:'/getmodel',
            data: { id: id },
            success:function(data){
                $("#models").html(data);
                $("#models").prop('disabled', false);
                /*$('#models').find('option').remove().end();
                $("#models").prop('disabled', false);
                $.each(data, function(i, item){
                    $("#models")
                    .append($("<option></option>")
                    .attr("value", data[i].id)
                    .text(data[i].nameModel));
                });*/
            }
        });
    }

    function getRegions(){
        var id = $('#regions').val();

        $.ajax({
            type:'GET',
            url:'/getcity',
            data: { id: id },
            success:function(data){
                $("#cities").html(data);
                $("#cities").prop('disabled', false);
                /*$('#cities').find('option').remove().end();

                $.each(data, function(i, item){
                    $("#cities")
                    .append($("<option></option>")
                    .attr("value", data[i].id)
                    .text(data[i].nameCity));
                });*/
            }
        });
    }

    function getModelsForFilters(){
        var id = $('#filtersMarks').val();

        $.ajax({
            type:'GET',
            url:'/getmodel',
            data: { id: id },
            success:function(data){
                $("#filtersModels").html(data);
                $("#filtersModels").prop('disabled', false);
                /*$('#models').find('option').remove().end();
                $("#models").prop('disabled', false);
                $.each(data, function(i, item){
                    $("#models")
                    .append($("<option></option>")
                    .attr("value", data[i].id)
                    .text(data[i].nameModel));
                });*/
            }
        });
    }

    function getRegionsForFilters(){
        var id = $('#filtersRegions').val();

        $.ajax({
            type:'GET',
            url:'/getcity',
            data: { id: id },
            success:function(data){
                $("#filtersCities").html(data);
                $("#filtersCities").prop('disabled', false);
                /*$('#cities').find('option').remove().end();

                $.each(data, function(i, item){
                    $("#cities")
                    .append($("<option></option>")
                    .attr("value", data[i].id)
                    .text(data[i].nameCity));
                });*/
            }
        });
    }

   // function saveForm(){
        //$('#addAnnouncements').validate();
    $(document).ready(function(){
        $('#addAnnouncements').submit(function(e){
            e.preventDefault();
            var form = document.getElementById('addAnnouncements');
            var data = new FormData(form);
            $.ajax({
                type:'POST',
                url:'/store',
                data: data,
                processData: false,
                contentType:false,
                success:function(data){
                    alert(data);
                    location.reload();
                }
            });
        });
    });
    //}




    $(document).ready(function(){
        $('#pagination nav div a').on('click', function(e) {
            e.preventDefault();

            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });
    });



    function setFilters() {
        $('#filters').on('submit', function (e) {
            e.preventDefault();
        });
        $.ajax({
            type: 'POST',
            url: "/announcements",
            data: $('#filters').serialize(),
            success: function (data) {
                $('#dataAnnouncements').html(data);

            }
        });
    }





