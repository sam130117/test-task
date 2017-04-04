$(function(){

    var sourceText = $('#sourceText');

    sourceText.change(function(){
        var text = $(this).val();

        // Remove all non english letters and convert string to lower case
        var lettersText = text.replace(/[^a-zA-Z]/gi, '').toLowerCase();

        var series = getLetterFrequencyArray(lettersText);
        var labels = Object.keys(series);
        var values = Object.values(series);

        drawDiagram(labels, values);
        ajaxRequest("/test-task/server/api/attempt-process.php", text);
    });


    sourceText.on("keypress", function(event) {

        // Disallow anything not matching the regex pattern
        var englishAlphabetAndSymbols = /[A-Za-z ,\-.!?;:"()']/g;
        var key = String.fromCharCode(event.which);

        return englishAlphabetAndSymbols.test(key);
    });


    $('#offsetNumber').on("keypress", function(event) {

        var digits = /[0-9]/g;
        var key = String.fromCharCode(event.which);
        return digits.test(key);
    });


    $('#encryptButton').click(function(){
        var text = $('#sourceText').val();
        var offset = $('#offsetNumber').val();

        if(validateOffset(offset))
            ajaxPostRequest("/test-task/server/api/encryption-process.php", text, offset);
    });


    $('#decryptButton').click(function(){
        var text = $('#sourceText').val();
        var offset = $('#offsetNumber').val();

        if(validateOffset(offset))
            ajaxPostRequest("/test-task/server/api/decryption-process.php", text, offset);
    });


    $('#decryptionAttempt').click(function(){
        var text = $('#sourceText').val();
        var offset = $('#estimatedOffset').html();
        $('#offsetNumber').val(offset);

        if(validateOffset(+offset))
            ajaxPostRequest("/test-task/server/api/decryption-process.php", text, offset);
    });


    $('.bounce-toggle').click(function () {
        var element = $('.bounce-toggle');
        stopAnimation(element);
    });


    $('.pulse-button').click(function () {
        var element = $('.pulse-button');
        stopAnimation(element);
    });
});

function stopAnimation(element)
{
    if(element.hasClass("animation-off"))
        element.removeClass( "animation-off" );
    else
        element.addClass( "animation-off" );
}


function ajaxPostRequest(url, text, offset)
{
    $.post(url,
        {
            text: text,
            offset: offset
        },
        function(data){
            data = JSON.parse(data);
            $('#processedText').html(data.text);
        });
}


function ajaxRequest(url, text)
{
    $.ajax({
        url: url,
        dataType: 'json',
        data: {text: text},
        type: 'post',
        success: function(data) {
            var textField = $('#estimatedOffset');

            if(data.offset === 0)
                $('#frequencyAnalysisResultMessage').hide();

            else {
                textField.html(data.offset);
                $('#frequencyAnalysisResultMessage').show();
            }
        }
    });
}


function validateOffset(offset)
{
    var errorField = $('#offsetError');
    if(offset < 1 || offset > 25)
    {
        errorField.html('Offset value must be between 1 and 25!');
        return false;
    }
    errorField.html('');
    return true;
}


function getLetterFrequencyArray(text) {
    var series = {};
    for(var i = 0; i < text.length; i++) {
        var character = text.charAt(i);
        if (series[character])
            series[character] += 1;
        else
            series[character] = 1;
    }
    return series;
}

function drawDiagram(labels, values)
{
    var chartData={
        "type": "bar",
        "scale-x": {
            "label": { "text": "Frequency chart" },
            "labels": labels
        },
        "series":[ { "values": values, "background-color":"#337ab7" } ]
    };
    zingchart.render({
        id:'chart-container',
        data:chartData,
        height:400,
        width:600
    });
    $('#diagramContainer').show();
}