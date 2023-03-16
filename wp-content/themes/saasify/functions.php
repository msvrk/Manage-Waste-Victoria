<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */
// Define the function to be run on the cron schedule
// function get_data_from_city_ballarat() {

// 	echo "Getting data from url and storing to table";

// 		// Define database connection variables
// 	$host = '127.0.0.1:49990';
// 	$user = 'azure';
// 	$password = '6#vWHD_$'; // azure user pass
// 	// $password = '$P$BjW0QfZn.ZkhzRPr9D27fMgRji3v8H/'; // wp_user pass
// 	// $password = 'vxjMebX6f7ayi8C'; // root user pass
// 	$database = 'localdb';
// 	$table_name = 'bin_schedule';

// 	// Connect to database
// 	$conn = new mysqli($host, $user, $password, $database);

// 	// Check connection
// 	if ($conn->connect_error) {
// 		echo "conn fail";
// 		die("Connection failed: " . $conn->connect_error);
// 	}
// 	echo "DB conn success";
// 	// Define CSV file URL
// 	// $file_url = 'https://data.ballarat.vic.gov.au/api/v2/catalog/datasets/waste-collection-days/exports/csv';

// 	// Open CSV file
// 	// $file = fopen($file_url, 'r');
	

	
// 	// Read CSV file data line by line
// 	// while (($line = fgetcsv($file)) !== false) {
// 	// 	// Insert CSV data into database table
// 	// 	echo "csv populate";
// 	// 	$sql = "INSERT INTO $table_name (propnum, address,  collectionday, nextwaste, nextrecycle, nextgreen ) VALUES ('$line[0]', '$line[1]', '$line[2]', '$line[3]' ,'$line[4]', '$line[5]') ON DUPLICATE KEY UPDATE    
// 	// 	propnum='$line[0]', address='$line[1]',collectionday = '$line[2]', nextwaste =  '$line[3]' , nextrecycle =  '$line[4]', nextgreen = '$line[5]'";
// 	// 	$conn->query($sql);
// 	// }
	
// 	echo "get data success";


// 	$query = "SELECT * FROM $table_name";

// 	$result = mysqli_query( $conn, $query );

// 	if ( !$result ) {
// 		die( 'Query failed: ' . mysqli_error( $conn ) );
// 	}

// 	$rows = array();

// 	while ( $row = mysqli_fetch_assoc( $result ) ) {
// 		$rows[] = $row;
// 	}

// 	echo json_encode( $rows );

// 	// Close CSV file
// 	// fclose($file);

// 	// Close database connection
// 	$conn->close();

// 	wp_die();
// }

// // Schedule the cron job to run every hour
// add_action('my_daily_event', 'get_data_from_city_ballarat');
// wp_schedule_event(strtotime('14:45:00'), 'daily', 'my_daily_event');


// add_action( 'wp_ajax_get_data_from_city_ballarat', 'get_data_from_city_ballarat' );
// add_action( 'wp_ajax_nopriv_get_data_from_city_ballarat', 'get_data_from_city_ballarat' );



function get_bin_schedule() {

	// echo "Getting data from url and storing to table";

		// Define database connection variables
	$host = '127.0.0.1:49990';
	$user = 'azure';
	$password = '6#vWHD_$'; // azure user pass
	// $password = '$P$BjW0QfZn.ZkhzRPr9D27fMgRji3v8H/'; // wp_user pass
	// $password = 'vxjMebX6f7ayi8C'; // root user pass
	$database = 'localdb';
	$table_name = 'bin_schedule';

	// Connect to database
	$conn = new mysqli($host, $user, $password, $database);

	// Check connection
	if ($conn->connect_error) {
		echo "conn fail";
		die("Connection failed: " . $conn->connect_error);
	}
	// echo "DB conn success";
	// Define CSV file URL
	// $file_url = 'https://data.ballarat.vic.gov.au/api/v2/catalog/datasets/waste-collection-days/exports/csv';

	// Open CSV file
	// $file = fopen($file_url, 'r');
	

	
	// Read CSV file data line by line
	// while (($line = fgetcsv($file)) !== false) {
	// 	// Insert CSV data into database table
	// 	echo "csv populate";
	// 	$sql = "INSERT INTO $table_name (propnum, address,  collectionday, nextwaste, nextrecycle, nextgreen ) VALUES ('$line[0]', '$line[1]', '$line[2]', '$line[3]' ,'$line[4]', '$line[5]') ON DUPLICATE KEY UPDATE    
	// 	propnum='$line[0]', address='$line[1]',collectionday = '$line[2]', nextwaste =  '$line[3]' , nextrecycle =  '$line[4]', nextgreen = '$line[5]'";
	// 	$conn->query($sql);
	// }
	// 
	// echo "get data success";

	$search = $_POST['formData'];
	
	$searchString =  join(" ",explode("%20", $search )); 
	
	// echo "formdata+search " . $search;
	// echo "formdata+search " . $_POST['formData']['search'];
	// echo "explode " . explode("%20", $search );

	$searchString = '%'.substr($searchString,7).'%';
	// echo $searchString;
	
	// // Prepare the SQL query with a placeholder for the search string
	// $query = "SELECT * FROM bin_collection WHERE address LIKE ?";

	// // Prepare the statement and bind the search string as a parameter
	// $stmt = $mysqli->prepare($query);
	// $stmt->bind_param("s", $searchString);

	// // Execute the statement and fetch the result
	// $stmt->execute();
	// $result = $stmt->get_result();


	$query = "SELECT collectionday, nextwaste, nextrecycle, nextgreen FROM bin_schedule WHERE address LIKE '$searchString'";
	// collectionday, nextwaste, nextrecycle, nextgreen
	$result = mysqli_query( $conn, $query );

	// echo $result;

	if ( !$result ) {
		echo "Error executing query: ".mysqli_error($conn);
  		exit();
	}

	$rows = array();

	while ( $row = mysqli_fetch_assoc( $result ) ) {
		$rows[] = $row;
	}

	// echo gettype($rows);

	echo json_encode($rows);

	// Close CSV file
	// fclose($file);

	// Close database connection
	$conn->close();

	wp_die();
}




add_action( 'wp_ajax_get_bin_schedule', 'get_bin_schedule' );
add_action( 'wp_ajax_nopriv_get_bin_schedule', 'get_bin_schedule' );

function my_enqueue_scripts() {
	// echo "JS scripts enqueued";
	// echo get_template_directory_uri() . '/assets/js/address_search_bin_schedule.js';
    wp_enqueue_script( 'jquery' );
    // wp_enqueue_script( 'connect_data_city', get_template_directory_uri() . '/assets/js/connect_data_city.js', array( 'jquery' ), '1.0.0', true );
	// wp_localize_script('connect_data_city',  'my_ajax_obj',array(
    //     'ajax_url' => admin_url('admin-ajax.php')));
	wp_enqueue_script( 'address_search_bin_schedule', get_template_directory_uri() . '/assets/js/address_search_bin_schedule.js', array( 'jquery' ), '1.0.0', true );
	wp_localize_script('address_search_bin_schedule',  'my_ajax_obj',array(
        'ajax_url' => admin_url('admin-ajax.php')));
}
// Add custom js script to wordpress when rendering
add_action( 'wp_enqueue_scripts', 'my_enqueue_scripts' );



// function get_ajax_handler_url() {
//     $url = get_template_directory_uri() . '/functions.php'; // Replace with the URL to your AJAX handler PHP file
//     echo esc_url($url);
//     wp_die();
// }

// add_action('wp_ajax_get_ajax_handler_url', 'get_ajax_handler_url');
// add_action('wp_ajax_nopriv_get_ajax_handler_url', 'get_ajax_handler_url');