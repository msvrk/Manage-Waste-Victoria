jQuery(document).ready(function($) {
  $('#get_data_from_url').click(function() {
    $.ajax({
      url: my_ajax_obj.ajax_url,
      type: 'post',
      data: {
        action: 'get_data_from_city_ballarat'
      },
      success: function(response) {
        console.log(response);
        console.log("Tables updated");
      }
    });
  });
});





// jQuery(document).ready(function($) {
//   $('#get_data_from_url').click(function() {
//     $.ajax({
//       url: '<!--?php echo get_template_directory_uri(); ?-->/functions.php',
//       type: 'post',
//       data: {
//         action: 'get_data_from_city_ballarat'
//       },
//       success: function(response) {
//         console.log("Tables updated");
//       }
//     });
//   })
// });


// function myAjaxRequest() {

//         jQuery.ajax({
//             url: my_ajax_object.ajax_url,
//             type: 'POST',
//             data: {
//                 action: 'get_data_from_city_ballarat',
//                 // Add any other data you want to pass to the server-side function
//             },
//             success: function(response) {
//                 console.log(response); // Do something with the response
//             },
//             error: function(jqXHR, textStatus, errorThrown) {
//                 console.error('AJAX error:', textStatus, errorThrown);
//             }
//         });
// }


// jQuery(document).ready(function($) {
//     // console.log("Ajax call being sent");
//     // var custom_url = '<?php echo esc_url(get_template_directory_uri()); ?>/functions.php';
//     // console.log(custom_url);
//   $('#get_data_from_url').click(function() {

//     $.ajax({
//       url: ajaxurl,
//       type: 'post',
//       data: {
//         action: 'get_ajax_handler_url'
//       },
//       success: function(response) {
//         var custom_url = response; // Use the response as the custom URL

//             $.ajax({
//                 type: 'POST',
//                 url: custom_url,
//                 data: {
//                     action: 'get_data_from_city_ballarat'
//                   },
//                 success: function(response) {
//                     console.log(response);
//                 }
//             });

//         console.log("Tables updated");
//       }
//     });
//   });
// });