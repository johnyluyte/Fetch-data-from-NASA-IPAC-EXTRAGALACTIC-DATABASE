// var progressElem = $('#progressCounter');

var total = 100;
$("#loading").hide();

$("#btn_gogogo").bind('click', function(event) {
    event.preventDefault();
//     $.ajax({
//         type: 'GET',
//         dataType: 'json',
//         url: 'ajaxJson.php',
//         error: function(xhr, ajaxOptions, thrownError) {
//             alert(xhr.responseText);
//             alert(thrownError);
//         },
//         // xhr: function() {
//         //     var xhr = new window.XMLHttpRequest();
//         //     xhr.addEventListener("progress", function(evt) {
//         //         $('#downloaded').text(evt.loaded);
//         //         var percentComplete = evt.loaded / total;
//         //         progressElem.html(Math.round(percentComplete * 100) + "%");
//         //     }, false);
//         //     return xhr;
//         // },
//         beforeSend: function() {
//             $('#loading').show();
//         },
//         complete: function() {
//             // $("#loading").hide();
//         },
//         success: function(result) {
//             $("#data").html(result);
//         }
//     });
});

// $("#btn_gogogo").click(function(e) {
$.ajax({
    type: 'GET',
    dataType: 'json',
    // url: 'a.json',
    url: 'ajaxJson.php',
    error: function(xhr, ajaxOptions, thrownError) {
        alert(xhr.responseText);
        alert(thrownError);
    },
    // xhr: function() {
    //     var xhr = new window.XMLHttpRequest();
    //     xhr.addEventListener("progress", function(evt) {
    //         $('#downloaded').text(evt.loaded);
    //         var percentComplete = evt.loaded / total;
    //         progressElem.html(Math.round(percentComplete * 100) + "%");
    //     }, false);
    //     return xhr;
    // },
    beforeSend: function() {
        $('#loading').show();
    },
    complete: function() {
        // $("#loading").hide();
    },
    success: function(result) {
        $("#loading").text(result);
        console.log(result);
    }
});
// });
