
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
              var table = $("<table></table>");
              table.append("<tr><th>Collection Day</th><th>Next Garbage Collection Day</th><th>Next Recycle Collection Day</th><th>Next Green Collection Day</th></tr>");
        
              // Loop through the result and create the table rows dynamically
              $.each(data, function(index, row) {
                var tr = $("<tr></tr>");
                tr.append("<td>" + row.collectionday + "</td>");
                tr.append("<td>" + row.nextwaste + "</td>");
                tr.append("<td>" + row.nextrecycle + "</td>");
                tr.append("<td>" + row.nextgreen + "</td>");
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