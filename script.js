$(document).ready(function () {

    $('input[type=radio]').change(function () {
        if ($(this).val() == 'task1') {
            $('#xml-div').show();
            $('#employee-div').hide();
        } else {
            $('#employee-div').show();
            $('#xml-div').hide();
        }
    })

    $('#upload-form').on('submit', function (event) {
        event.preventDefault();
        var jsonData = null;
        var fileInput = $('#xml-file')[0].files[0];
        var reader = new FileReader();

        reader.onload = function (e) {
            var xmlContent = e.target.result;
            jsonData = mantaXML.xml2JSON(xmlContent);//plugin for convertion
            $('#jsonoutput').html(prettyPrintJson.toHtml(jsonData));//plugin to beautify json
            storeToDB(jsonData);//table insert function
        };
        reader.readAsText(fileInput);

    });
    function storeToDB(jsonData) {
        $.ajax({
            url: 'api/store_data.php',
            type: 'POST',
            contentType: 'applocation/json',
            data: JSON.stringify({ jsonData: jsonData }),
            success: function (response) {
                alert('Data stored successfully: ' + response);
            },
            error: function (xhr, status, error) {
                console.error('Error storing data:', error);
            }
        });
    }

    $('#employee-form').on('submit', function (event) {
        event.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            url: 'api/emp_register.php',
            type: 'POST',
            data: formData,
            success: function (data) {
                $('#token_result').html(data);
            }
        });
    })
});