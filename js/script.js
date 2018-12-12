function getCurrentDate()
{
    n = new Date();
    y = n.getFullYear();
    m = n.getMonth() + 1;
    d = n.getDate();

    if (m < 10)
        m = '0' + m;

    if (d < 10)
        d = '0' + d;

    $(".date").attr("value", y + "-" + m + "-" + d);
}

function clearValue()
{
    $(this).attr("value", "");
}

function setDefinedPeriod()
{
    if ($('#period').val() == "userDefined")
        $('#userDate').show();
    else
        $('#userDate').hide();
}

function submitPeriod()
{
    $('#periodForm').submit();
}

function onLoad()
{
    if ($('.date').val() == "")
        getCurrentDate();

    setDefinedPeriod();     
}

$('#period').change(submitPeriod);
$('.date').focusout(submitPeriod);
$(document).ready(onLoad);
