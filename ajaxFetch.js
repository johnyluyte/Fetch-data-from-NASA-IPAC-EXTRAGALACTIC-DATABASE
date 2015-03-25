/* Init variables */
var fetch_goal = -1;
var fetched_now = -1;
var ajaxRequest = new Array();
$("#loading").hide();

$(function() {
    $("#btn_gogogo").bind('click', function(event) {
        event.preventDefault();
        createNewTable("div_result");
        abortTasks();
        startTasks();
    });
});

/* Create a new result table*/
function createNewTable(id) {
    var str = '<table class="table table-striped">';
    str += '    <thead>';
    str += '        <tr>';
    str += '            <th>#</th>';
    str += '            <th>RA</th>';
    str += '            <th>DEC</th>';
    str += '            <th>B[µm]</th>';
    str += '            <th>B Aλ</th>';
    str += '            <th>R[µm]</th>';
    str += '            <th>R Aλ</th>';
    str += '            <th>K[µm]</th>';
    str += '            <th>K Aλ</tdh>';
    str += '        </tr>';
    str += '    </thead>';
    str += '    <tbody>';
    str += '    </tbody>';
    str += '</table>';
    $("#" + id).html(str);
}

/* Abort current tasks which are not completed yet */
function abortTasks() {
    for (x in ajaxRequest) {
        /*
            http://www.w3schools.com/ajax/ajax_xmlhttprequest_onreadystatechange.asp

            readyState:
            Holds the status of the XMLHttpRequest. Changes from 0 to 4:
            0: request not initialized
            1: server connection established
            2: request received
            3: processing request
            4: request finished and response is ready

            status: 200  => got a 200 OK HTTP header
        */
        if (ajaxRequest[x].readyState != 4) {
            console.log(ajaxRequest[x]);
            ajaxRequest[x].abort();
        }
    }
}

/* Start a series of AJAX tasks */
function startTasks() {
    fetch_goal = $("#inputAmount").prop('value');
    fetched_now = 0;
    for (var i = 0; i < fetch_goal; i++) {
        startTask(i);
    }
}

/* Start a specific index of AJAX task */
function startTask(i) {
    ajaxRequest[i] = $.ajax({
        type: 'GET',
        dataType: 'json',
        url: 'ajaxFetch.php',
        cache: false,
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr.responseText);
            console.log(thrownError);
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
            // ajaxRequest[i] = null;
        },
        success: function(jsonResult) {
            // $("#loading").text(jsonResult.B_A);
            // console.log(jsonResult);
            fetched_now++;
            updateProgressBar("div_loading");
            addNewRowToTable(jsonResult, "div_result");
        }
    });
}

/* Update the progress bar when a AJAX task succeeded */
function updateProgressBar(id) {
    var str = "";
    var percent = Math.round(fetched_now * 100 / fetch_goal);
    str += '<div>' + fetched_now + ' of ' + fetch_goal + ' data fetched.' + '</div>';
    str += '<div class="progress">';
    if (percent == 100) {
        str += '<div class="progress-bar progress-bar-success" style="width: 100%">';
    } else {
        str += '<div class="progress-bar progress-bar-info progress-bar-striped active" style="width: ' + percent + '%" >';
    }
    str += '  </div>';
    str += '</div>';
    $('#div_loading_percent_text').text(percent + '%');
    $('#' + id).html(str);
}

/*
  Add new row to table using the following steps:
  1. Get result table's HTML
  2. Remove </tbody>, </table>
  3. Add <tr> .. contents .. </tr>
  4. Add back </tbody>, </table> that was removed
  5. Update result table's HTML
*/
function addNewRowToTable(jsonResult, id) {
    var $myTable = $("#" + id);
    var tableHTML = $myTable.html();
    var end_Of_tbody = tableHTML.indexOf('</tbody>');
    var tableHTML = tableHTML.substring(0, end_Of_tbody);
    // console.log(tableHTML);
    tableHTML += '<tr>';
    tableHTML += '<td>' + fetched_now + '</td>';
    tableHTML += '<td>' + jsonResult.RA + '</td>';
    tableHTML += '<td>' + jsonResult.DEC + '</td>';
    tableHTML += '<td>' + jsonResult.B_um + '</td>';
    tableHTML += '<td>' + jsonResult.B_A + '</td>';
    tableHTML += '<td>' + jsonResult.R_um + '</td>';
    tableHTML += '<td>' + jsonResult.R_A + '</td>';
    tableHTML += '<td>' + jsonResult.K_um + '</td>';
    tableHTML += '<td>' + jsonResult.K_A + '</td>';
    tableHTML += '</tr>';
    tableHTML += '</tbody></table>';
    $myTable.html(tableHTML);
}
