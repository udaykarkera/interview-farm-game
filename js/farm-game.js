
// Display Message and Status of the Game
function farmGameAlert(msg, element) {
    $("#display-"+element).html(msg);
}

$(document).ready(function(){

    // This call is made at the start to get all game settings from server
    $.get("api/get-farm-game-details.php", function(data, status){
        /*
        These settings make sure you can change the game details
        only from one place i.e. server
        */
        farmEntities = data.farmEntities;
        totalturnCount = data.totalturnCount;
        farmerTitle = data.farmerTitle;
        // if Handle scenario via JS and display message
        // farmWinEntities = data.farmWinEntities;

        // Set the eaters config here
        eaters = {};
        for (var l in farmEntities) {
            eaters[farmEntities[l]] = 0;
        }

        turnCount = 0;

        // Dynamically set the table headers
        var tableHeaderHtml = '<tr ><th>Round</th>';
        for (var k in eaters) {
            // to set id so as to later on make cell red if dead
            str = k.replace(/\s+/g, '-');
            tableHeaderHtml = tableHeaderHtml + '<th id='+ str +'>' + k + '</th>';
        }
        tableHeaderHtml = tableHeaderHtml + '</tr>';
        $('#fed-chart').append(tableHeaderHtml);

        // Object to used to send as response
        farmDetails = {
            eaters
        };
    });


    $('#feed-anyone').on('click', function(){

        // Get the details after a turn 
        $.post(
            "api/next-turn.php",
            farmDetails,
            function(data, status){
                if (data['status'] == 'Invalid Input') {
                    alert('Invalid input. Kindly contact authorized technician.')
                }
                else {
                }
            }
        );


    });


    // Restart the game whenever required
    $('#restart-game').on('click', function() {
        window.location.reload();
    });
});
