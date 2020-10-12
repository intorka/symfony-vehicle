// START : SELECT PODUCER
$("#producer").change(function (event) {
    var producer = $('#producer').val();

    $.ajax({
        type: 'GET',
        url: "/model/"+producer,
        data: producer,
        success: function (data, status) {
            $("#labelModel").show();
            $("#model").html(data.select);
        },
        error: function (xhr, textStatus, errorThrown) {
            alert("Error");
        }
    });
});

// START : SELECT MODEL
$("#model").change(function (event) {

    var data = {
        "producer" : $('#producer').val(),
        "model" : $('#modelSelect').val()
    };
    var criteria = JSON.stringify(data);

    $.ajax({
        type: "POST",
        url: "/year",
        data: criteria,
        contentType: "application/json",
        dataType: "json",
        success: function(data, status) {
            $("#labelYear").show();
            $("#year").html(data.select);
        },
        error: function (xhr, textStatus, errorThrown) {
            alert("Error");
        }
    });
});

// START : SELECT YEAR
$("#year").change(function (event) {

    var data = {
        "vehicleId" : $('#yearSelect').val(),
    };
    var vehicleId = JSON.stringify(data);

    $.ajax({
        type: "POST",
        url: "/part",
        data: vehicleId,
        contentType: "application/json",
        dataType: "json",
        success: function (data, status) {
            if (data.partLists != "<ol class='list-group'></ol>"){

                $("#parts").html(data.partLists);

            } else {

                $("#parts").html("No Record Found");

            }
        },
        error: function (xhr, textStatus, errorThrown) {
            alert("Error");
        }
    });


});
