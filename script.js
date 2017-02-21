/**
 * Created by shvedov_es on 15.02.2017.
 */

var id = 1;

$(document).ready(function(){
    //$('#webform-component-curator').clone()
    $( "#cboxCuratorAdd" ).click(function() {
        $('#curators').prepend("<div class='form-item webform-component webform-component-textfield' id='webform-component-curator'>");
        id = id+1;
        var textid = id.toString();
        $('#webform-component-curator').append("<input type='text' id='" + textid + "' name='submittedcurator' value='' size='60' maxlength='128' class='form-text required' style='width:213px;'>");
        $('#webform-component-curator').prepend('<label for="' + textid + '">Научный руководитель (Фамилия, Имя, Отчество - полностью) <span class="form-required" title="Это поле обязательно для заполнения.">*</span></label>');
        $('#webform-component-curator').append('<label for="' + textid + '" id="error' + id.toString() + '" class="error" style="display: none;">заполните, пожалуйста</label>');
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
                if(event.target.id=="1")
                    $('#error1').css("display", "none");
                if(event.target.id==id.toString())
                    $('#error1').css("display", "none");
                if(event.target.id=="edit-submitted-Kod")
                    $('#error6').css("display", "none");
                if(event.target.id=="edit-submitted-pages")
                    $('#error8').css("display", "none");
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
                if(event.target.id=="1")
                    $('#error1').css("display", "block");
                if(event.target.id=="1")
                    $('#error1').css("display", "block");
                if(event.target.id=="edit-submitted-Kod")
                    $('#error6').css("display", "block");
                if(event.target.id=="edit-submitted-pages")
                    $('#error8').css("display", "block");
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
        var submittedstudCurator = [];
            submittedstudCurator.push($.trim($('#1').val()));
        var minid = 1;
        var maxid = id;
        while(minid != maxid) {
            minid += 1;
            textid = "#" + minid.toString();
            submittedstudCurator.push($.trim($(textid).val()));
        }
        var submittedstudKod = $.trim($('#edit-submitted-kod').val());
        var submittedstudInstitute = $.trim($('#edit-submitted-institute').val());
        var submittedstudPages = $.trim($('#edit-submitted-pages').val());
        var submittedvash_email = $.trim($('#edit-submitted-vash-email').val());
        var submittedPDF = $.trim($('#edit-submitted-vash-pdf').val());
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
        var curatorfound = false;
        submittedstudCurator.forEach(function(item, i, submittedstudCurator){
           if(valid(item)){
              curatorfound = true;
           }
        });
        if (!curatorfound) {
            $('#error1').css("display", "block");
            $('#1').css("border", "1px solid #d11313");
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
            $('#edit-submitted-vash-pdf').css("border", "1px solid #d11313");
            allright = false;
        }

        if (!allright)
            return;
        return;
    });
 }
)

//text - string value, ismail - bool value and is false by default
function valid(text,ismail)
{
    ismail = typeof ismail != 'undefined' ? ismail : false;
    if(ismail)
        return /^[-a-z0-9!#$%&'*+/=?^_`{|}~]+(\.[-a-z0-9!#$%&'*+/=?^_`{|}~]+)*@([a-z0-9]([-a-z0-9]{0,61}[a-z0-9])?\.)*(aero|arpa|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|[a-z][a-z])$/.test(text);
    else
        return !/^[ \t\r\n\v\f]*$/.test(text);
}