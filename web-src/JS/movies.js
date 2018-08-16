$(document).ready(function () {
    Array.prototype.unique = function () {
        return this.filter(function (value, index, self) {
            return self.indexOf(value) === index;
        });
    }
    $.ajax({
        type: 'GET',
        url: '/movies/all',
        dataType: "json",
        success: function (data) {
            console.log(data);

            var table = $("#table tbody");
            var genreSelector = $('#genreSelector');
            var yearSelector = $('#yearSelector');
            genreSelector.empty();
            yearSelector.empty();
            genreSelector.append("<option selected disabled>All</option>");
            yearSelector.append("<option selected disabled>All</option>");
            $(table).empty();
            var selectGenreValues = [];
            var selectYearValues = [];

            $.each(data, function (idx, elem) {
                table.append("<tr><td>" + elem.movie.name +
                    "</td><td>" + elem.movie.year + "</td>   <td><img src='" +
                    elem.movie.image + "'></td>" +
                    "<td>" + elem.movie.genres + "</td><td><ol>" +
                    elem.showtime.reduce(function (total, currentValue) {
                        return total + "<li>" + currentValue + "</li>";
                    }, "") + "</ol></td></tr>");

                selectYearValues.push(elem.movie.year);
                var splitGenres = elem.movie.genres.split(',');
                for (var i = 0; i < splitGenres.length; i++) {
                    selectGenreValues.push(splitGenres[i]);
                }

            });
            selectYearValues = selectYearValues.unique();
            for (var i = 0; i < selectYearValues.length; i++) {
                yearSelector
                    .append($("<option></option>")
                        .attr("value", selectYearValues[i])
                        .text(selectYearValues[i]));
            }
            selectGenreValues = selectGenreValues.unique();
            for (var i = 0; i < selectGenreValues.length; i++) {
                genreSelector
                    .append($("<option></option>")
                        .attr("value", selectGenreValues[i])
                        .text(selectGenreValues[i]));
            }


        },
        error: function (data) {
            alert(data);
            return false;
        }
    });
    $(function () {
        $('#myFormId').ajaxForm({
            dataType: "json",
            success: function (data) {
                console.log(data);

                var table = $("#table tbody");
                var genreSelector = $('#genreSelector');
                var yearSelector = $('#yearSelector');
                $(table).empty();
                var selectGenreValues = [];
                var selectYearValues = [];

                $.each(data, function (idx, elem) {
                    table.append("<tr><td>" + elem.movie.name +
                        "</td><td>" + elem.movie.year + "</td>   <td><img src='" +
                        elem.movie.image + "'></td>" +
                        "<td>" + elem.movie.genres + "</td><td><ol>" +
                        elem.showtime.reduce(function (total, currentValue) {
                            return total + "<li>" + currentValue + "</li>";
                        }, "") + "</ol></td></tr>");

                    selectYearValues.push(elem.movie.year);
                    var splitGenres = elem.movie.genres.split(',');
                    for (var i = 0; i < splitGenres.length; i++) {
                        selectGenreValues.push(splitGenres[i]);
                    }

                });


            },
            error: function (data) {
                alert(data);
                return false;
            }
        });
    });
});

