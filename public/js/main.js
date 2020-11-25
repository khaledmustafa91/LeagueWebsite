$(document).ready(function() {

    $("#generateBtn").click(function() {

        $num = $('#numOfPlayers').val();
        console.log($num);

        if($.isNumeric($num)) {
            $errorText = $('#numberError');
            $errorText.css('visibility','hidden');

            for ($i = 0; $i < $num; $i++) {

                $("#teamsInfo").append("<div class=\"form-group row\">\n" +
                    "                                <label for=\"inputPlayer\" class=\"col-sm-2 col-form-label\">Player Name</label>\n" +
                    "                                <div class=\"col-sm-4\">\n" +
                    "                                    <input type=\"text\" class=\"form-control\" id=\"inputPlayer\" placeholder=\"User name\">\n" +
                    "                                </div>\n" +
                    "\n" +
                    "                                <label for=\"inputTeam\" class=\"col-sm-2 col-form-label\">Team Name</label>\n" +
                    "                                <div class=\"col-sm-4\">\n" +
                    "                                    <select class=\"custom-select\">\n" +
                    "                                        <option selected>Select your team</option>\n" +
                    "                                        <option value=\"1\">One</option>\n" +
                    "                                        <option value=\"2\">Two</option>\n" +
                    "                                        <option value=\"3\">Three</option>\n" +
                    "                                    </select>\n" +
                    "                                </div>\n" +
                    "                            </div>").show('slow');
            }
        }else{
            $errorText = $('#numberError');
            $errorText.css('visibility','visible');
        }
        return false;
    });

});



$(function () {
        'use strict';
        $('a[href^="#"]').on('click', function (e) {
            e.preventDefault();
            var target = this.hash,
                $target = $(target);
            $('html, body').stop().animate({
                'scrollTop': $target.offset().top
            }, 900, 'swing', function () {
                window.location.hash = target;
            });
        })
    }
);

