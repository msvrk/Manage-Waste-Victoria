
jQuery(document).ready(function($) {
    $('#search-form').submit(function(e) {
      e.preventDefault();
      var formData = $(this).serialize(); // Serialize form data
      $.ajax({
        type: 'POST',
        url: my_ajax_obj.ajax_url, // URL to admin-ajax.php
        data: {
          action: 'get_bin_schedule', // AJAX action name
          formData: formData // Form data
        },
        success: function(response) {
            console.log(typeof response);
            console.log(response);
            var data = JSON.parse(response);

            // Check if any results were returned
            if (data.length > 0) {
              // Create the table element
              var table = $("<table style='border: 1px solid black;'></table>");
              table.append("<tr><th style='padding: 0.5rem; border: 1px solid ForestGreen;'>Collection Day</th><th style='padding: 0.5rem; border: 1px solid ForestGreen;'>Next Garbage Collection Day</th><th style='padding: 0.5rem; border: 1px solid ForestGreen;'>Next Recycle Collection Day</th><th style='padding: 0.5rem; border: 1px solid ForestGreen;'>Next Green Collection Day</th></tr>");
        
              // Loop through the result and create the table rows dynamically
              $.each(data, function(index, row) {

                row.collectionday = (row.collectionday.split(" "))[0];
                
                row.nextwaste = new Date(row.nextwaste);

                // Convert to different date format
                row.nextwaste = row.nextwaste.toLocaleDateString("en-US", { year: 'numeric', month: 'short', day: 'numeric' });

                row.nextrecycle = new Date(row.nextrecycle);

                // Convert to different date format
                row.nextrecycle = row.nextrecycle.toLocaleDateString("en-US", { year: 'numeric', month: 'short', day: 'numeric' });

                row.nextgreen = new Date(row.nextgreen);

                // Convert to different date format
                row.nextgreen = row.nextgreen.toLocaleDateString("en-US", { year: 'numeric', month: 'short', day: 'numeric' });

                var tr = $("<tr></tr>");
                tr.append("<td style='padding: 0.5rem; border: 1px solid ForestGreen;'>" + row.collectionday + "</td>");
                tr.append("<td style='padding: 0.5rem; border: 1px solid ForestGreen;'>" + row.nextwaste + "</td>");
                tr.append("<td style='padding: 0.5rem; border: 1px solid ForestGreen;'> " + row.nextrecycle + "</td>");
                tr.append("<td style='padding: 0.5rem; border: 1px solid ForestGreen;'>" + row.nextgreen + "</td>");
                table.append(tr);
              });
        
              // Output the table element to the HTML
              $("#result").html(table);
            } else {
              // Output a message if no results were found
              $("#result").html("No results found.");
            }
          },
        error: function(xhr, status, error) {
            // console.log(error);
        }
      });
    });
  });