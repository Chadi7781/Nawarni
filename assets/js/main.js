/**********start Birthday Date System***************************/

//Years 
for (i = new Date().getFullYear(); i > 1900; i--) {
    $("#years").append($('<option/>').val(i).html(i));
}

//Months
for (i = 1; i <= 12; i++) {
    $("#months").append($("<option/>").val(i).html(i));
}

updateNumberOfDays();



//Function that updateNumberOfDays 
function updateNumberOfDays() {
    $('#days').html('');
    month = $('#months').val();
    year = $('#years').val();

    console.log("day = " + $('#days').html('') + ", month = " + month + ", year = " + year);
    console.log("Date = " + daysInMonth(month, year));
    days = daysInMonth(month, year);

    for (i = 1; i <= days; i++) {
        $("#days").append($("<option/>").val(i).html(i));

    }

    $('#years,#months').on("change", function () {
        updateNumberOfDays();
    })

}


//Function return number of days in month for example february month it return 28 as a value. 
function daysInMonth(month, year) {
    return new Date(year, month, 0).getDate();
}

/**********end Birthday Date System***************************/
