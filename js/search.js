$(document).ready(function () {

    "use strict";

    a();

    var e = document.getElementById("load_data"), t = document.getElementById("load_data_message");

    function a(e) {

        $.ajax({

            url: "fetch.php",

            method: "post",

            data: { query: e },

            success: function (e) {

                $("#result").html(e);

            },

        });

    }

    $("#search_text").keyup(function () {

        var l = $(this).val();

        "" != l ? (a(l), (e.style.display = "none"), (t.style.display = "none")) : (a(), (e.style.display = "block"), (t.style.display = "block"));

    });
    
    
});