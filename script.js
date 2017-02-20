/**
 * Created by shvedov_es on 15.02.2017.
 */

$(document).ready(function(){

    $( "#cboxCuratorAdd" ).click(function() {
        $('#curators').prepend($('#webform-component-curator').clone());
    });

    $('.webform-client-form').on('submit', function(event) {
        event.preventDefault();
        var title = $.trim($('#edit-submitted-title').val());
        var submittedfio = $.trim($('#edit-submitted-fio').val());
        var submittedyear = $.trim($('#edit-submitted-year').val());
        var submittedstudVKR = $.trim($('#edit-submitted-VKR').val());
        var submittedstudCurator = findMultiID('edit-submitted-curator');
        var submittedstudKod = $.trim($('#edit-submitted-kod').val());
        var submittedstudInstitute = $.trim($('#edit-submitted-institute').val());
        var submittedstudPages = $.trim($('#edit-submitted-pages').val());
        var submittedvash_email = $.trim($('#edit-submitted-vash-email').val());
        var submittedPDF = $.trim($('#fileToUpload').val());
        var allright = true;

        if (!valid(title)) {
            $('#error1').css("display", "block");
            $('#edit-submitted-title').css("border", "1px solid #d11313");
            allright = false;
        }
        if (!valid(submittedfio)) {
            $('#error2').css("display", "block");
            $('#edit-submitted-fio').css("border", "1px solid #d11313");
            allright = false;
        }
        if (!valid(submittedvash_email, true)) {
            $('#ok1').css("display", "none");
            $('#notok1').css("display", "block");
            $('#edit-submitted-vash-email').css("border", "1px solid #d11313");
            allright = false;
        }
        if (!valid(submittedyear)) {
            $('#error3').css("display", "block");
            $('#edit-submitted-year').css("border", "1px solid #d11313");
            allright = false;
        }
        if (!valid(submittedstudwork)) {
            $('#error4').css("display", "block");
            $('#edit-submitted-studwork').css("border", "1px solid #d11313");
            allright = false;
        }
        if (!valid(submittedbirthdate)) {
            $('#error5').css("display", "block");
            $('#edit-submitted-birthdate').css("border", "1px solid #d11313");
            allright = false;
        }

        if (!allright)
            return;
    });
 }
)

function findMultiID(id) {
    var results = [];
    var children = $("div").get(0).children;
    for (var i = 0; i < children.length; i++) {
        if (children[i].id == id) {
            results.push(children[i].val());
        }
    }
    return(results);
}

//text - string value, ismail - bool value and is false by default
function valid(text,ismail)
{
    ismail = typeof ismail != 'undefined' ? ismail : false;
    if(ismail)
        return /^[-a-z0-9!#$%&'*+/=?^_`{|}~]+(\.[-a-z0-9!#$%&'*+/=?^_`{|}~]+)*@([a-z0-9]([-a-z0-9]{0,61}[a-z0-9])?\.)*(aero|arpa|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|[a-z][a-z])$/.test(text);
    else
        return !/^[ \t\r\n\v\f]*$/.test(text);
}