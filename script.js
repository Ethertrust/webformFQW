/**
 * Created by shvedov_es on 15.02.2017.
 */

$(document).ready(function(){

    $( "#cboxCuratorAdd" ).click(function() {
        $('#curators').prepend($('#webform-component-curator').clone());
    });

    $( "#edit-submitted-VKR" ).change(function() {
        $('#error4').css("display", "none");
        $("#edit-submitted-VKR").css("border",  "1px solid transparent");
    });

    $( "#edit-submitted-institute" ).change(function() {
        $('#error7').css("display", "none");
        $("#edit-submitted-institute").css("border",  "1px solid transparent");
    });

    $(document).on("modify", ":input", function(event, data)
    {
        if(event.target.id=="edit-submitted-vash-pdf")
        {
            if(valid($.trim(data.currentValue)))
            {
                $('#notok2').css("display", "none");
                $('#ok2').css("display", "block");
                $(this).css("border", "1px solid transparent");
            }
            else
            {
                $('#ok2').css("display", "none");
                $('#notok2').css("display", "block");
                $(this).css("border", "1px solid #d11313");
            }
        }

        if(event.target.id=="edit-submitted-vash-email")
        {
            if(valid($.trim(data.currentValue),true))
            {
                $('#notok1').css("display", "none");
                $('#ok1').css("display", "block");
                $(this).css("border", "1px solid transparent");
            }
            else
            {
                $('#ok1').css("display", "none");
                $('#notok1').css("display", "block");
                $(this).css("border", "1px solid #d11313");
            }
        }
        else
        {
            if(valid($.trim(data.currentValue)))
            {
                if(event.target.id=="edit-submitted-title")
                    $('#error1').css("display", "none");
                if(event.target.id=="edit-submitted-fio")
                    $('#error2').css("display", "none");
                if(event.target.id=="edit-submitted-year")
                    $('#error3').css("display", "none");
                if(event.target.id=="edit-submitted-curator")
                    $('#error5').css("display", "none");
                if(event.target.id=="edit-submitted-Kod")
                    $('#error6').css("display", "none");
                if(event.target.id=="edit-submitted-pages")
                    $('#error8').css("display", "none");
                if(event.target.id=="edit-submitted-pdf")
                    $('#error9').css("display", "none");
                $(this).css("border",  "1px solid transparent");
            }
            else
            {
                if(event.target.id=="edit-submitted-title")
                    $('#error1').css("display", "block");
                if(event.target.id=="edit-submitted-fio")
                    $('#error2').css("display", "block");
                if(event.target.id=="edit-submitted-year")
                    $('#error3').css("display", "block");
                if(event.target.id=="edit-submitted-curator")
                    $('#error5').css("display", "block");
                if(event.target.id=="edit-submitted-Kod")
                    $('#error6').css("display", "block");
                if(event.target.id=="edit-submitted-pages")
                    $('#error8').css("display", "block");
                if(event.target.id=="edit-submitted-pdf")
                    $('#error9').css("display", "block");
                $(this).css("border", "1px solid #d11313");
            }
        }
    });

    $('.webform-client-form').on('submit', function(event) {
        event.preventDefault();
        var title = $.trim($('#edit-submitted-title').val());
        var submittedfio = $.trim($('#edit-submitted-fio').val());
        var submittedyear = $.trim($('#edit-submitted-year').val());
        var submittedVKR = $.trim($('#edit-submitted-VKR').val());
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
        if (!valid(submittedyear)) {
            $('#error3').css("display", "block");
            $('#edit-submitted-year').css("border", "1px solid #d11313");
            allright = false;
        }
        if (!valid(submittedVKR)) {
            $('#error4').css("display", "block");
            $('#edit-submitted-VKR').css("border", "1px solid #d11313");
            allright = false;
        }
        if (!valid(submittedstudCurator)) {
            $('#error5').css("display", "block");
            $('#edit-submitted-curator').css("border", "1px solid #d11313");
            allright = false;
        }
        if (!valid(submittedstudKod)) {
            $('#error6').css("display", "block");
            $('#edit-submitted-kod').css("border", "1px solid #d11313");
            allright = false;
        }
        if (!valid(submittedstudInstitute)) {
            $('#error7').css("display", "block");
            $('#edit-submitted-institute').css("border", "1px solid #d11313");
            allright = false;
        }
        if (!valid(submittedstudPages)) {
            $('#error8').css("display", "block");
            $('#edit-submitted-pages').css("border", "1px solid #d11313");
            allright = false;
        }
        if (!valid(submittedvash_email, true)) {
            $('#ok1').css("display", "none");
            $('#notok1').css("display", "block");
            $('#edit-submitted-vash-email').css("border", "1px solid #d11313");
            allright = false;
        }
        if (!valid(submittedPDF)) {
            $('#ok2').css("display", "none");
            $('#notok2').css("display", "block");
            $('#edit-submitted-pdf').css("border", "1px solid #d11313");
            allright = false;
        }

        if (!allright)
            return;
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