var dateRange = document.getElementById('date2'),

    monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
var dateRange2 = document.getElementById('dynamic-list');
var today = new Date();
var todayy = today.toISOString();
var currentime = today.getHours() + ':' + today.getMinutes();

var after = new Date();

for (var day = 0; day < 4; day++) {
    var date = new Date();
    var date2 = new Date();
    date.setDate(date.getDate() + day);
    date2.setDate(date2.getDate() + day);
    dateRange.options[dateRange.options.length] = new Option([date.getDate(), monthNames[date.getMonth()], date.getFullYear()].join(' '), date.toISOString());

}

document.write(currentime);


function ChangeSecondList(value) {

    if (value) {
        document.getElementById("static-list-div").style.display = "none";
        document.getElementById("dynamic-list-div").style.display = "block";
        document.getElementById("dynamic-list-div2").style.display = "none";
        if (value > todayy) {
            for (var time = 0; time < 15; time++) {
                date.setTime(date.getHours() + time * 60 * 60 * 1000);
                date2.setTime(date2.getHours() + 1 * 60 * 60 * 1000 + time * 60 * 60 * 1000);
                dateRange2.options[dateRange2.options.length] = new Option([date.getHours(), date.getMinutes()].join(':') + " - " + [date2.getHours(), date2.getMinutes()].join(':'));
            }

        } else {
            document.getElementById("static-list-div").style.display = "none";
            document.getElementById("dynamic-list-div").style.display = "none";
            document.getElementById("dynamic-list-div2").style.display = "block";
        }
    } else {
        document.getElementById("static-list-div").style.display = "block";
        document.getElementById("dynamic-list-div").style.display = "none";
        document.getElementById("dynamic-list-div2").style.display = "none";
    }
}

ChangeSecondList(document.getElementById("date2").options[document.getElementById("date2").selectedIndex].value);