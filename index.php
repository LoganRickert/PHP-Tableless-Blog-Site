<?PHP

  // If the ID is set, get it.
  if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    
    // Check to make sure the ID isn't smaller than 1.
    if($id <= 0){
      unset($id); 
    }
  }

  if(!isset($_GET['page'])){
    $jsonOffset = 0;
    $page = 1;
  } else if(intval($_GET['page']) <= 0){
    $jsonOffset = 0;
    $page = 1;
  } else {
    $jsonOffset = intval($_GET['page'] * 3 - 3 );
    $page = intval($_GET['page']);
  }

  // Get the Header file.
  include 'inc/header.php';
  
  // Get the JSON file.
  $json = file_get_contents("json/blog.json");
  $json = json_decode($json);
  
  // Content of the home page.
  if(isset($id)){
    
    // If an ID is set, only get the content of that ID.
    $json = $json->{'Posts'}->{'' . $id . ''};
    
    $jsonID = $json->{"Id"};
	$jsonTitle = $json->{'Title'};
    $jsonContent = $json->{"Content"};
    $jsonDate = $json->{"Date"};
    echo "<h1><a href='index.php?id=" . $jsonID . "'>" . $jsonTitle . "</a></h1>" . $jsonContent . "<div class='bottom'>" . date('F j, Y',$jsonDate) . "</div>";
    
  } else {

	include 'inc/pagimation.php';
	
	// $jsonOffset = Where to start. If set to 7, it starts at post id 7 and goes from there down. 
	// It will stop at the second number (5 by default). $page is the page you are on.
	pagimation($jsonOffset,5,$page);
	
  }
  
  // Get the footer information.
  include 'inc/footer.php';