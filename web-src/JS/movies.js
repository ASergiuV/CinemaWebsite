$(document).ready(function () {
    $.ajax({
        type: 'GET',
        url: '/movies/all',
        dataType: "json",
        // async: false,
        success: function (data) {
            console.log(data);
            var table = $("#table tbody");
            $(table).empty();
            $.each(data, function (idx, elem) {
                table.append("<tr><td>" + elem.name +
                    "</td><td>" + elem.year + "</td>   <td><img src='" +
                    elem.image + "'></td>" +
                    "<td>" + elem.genres + "</td></tr>");
            });
            return false;
        },
        error: function (data) {
            alert(data);
            return false;
        }
    });
    console.log('doc was loaded');
});
// $.holdReady(true);
// $.get("http://www.cinema.local/movies/all", function (data) {
//     var table = ('#table');
//     $(table).empty();
//     table = $("#table tbody");
//     $.each(JSON.parse(data), function (idx, elem) {
//         table.append("<tr><td>" + elem.name +
//             "</td><td>" + elem.year + "</td>   <td><img src='" +
//             elem.image + "'></td>" +
//             "<td>" + elem.genres + "</td></tr>");
//     });
//     $.holdReady(false);
// });
