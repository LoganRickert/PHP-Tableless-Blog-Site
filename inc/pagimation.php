<?PHP
function pagimation($jsonPageStart,$jsonTotal,$page) {
  
  // Get the JSON file.
  $json = file_get_contents("json/blog.json");
  $json = json_decode($json);
  
	$jsonStop = 0;
	$jsonStart = 0;

  // If no ID is set, get all.
  foreach($json->{'Posts'} as $json) {
    
    $jsonID = $json->{"Id"};
	$jsonTitle = $json->{"Title"};
    $jsonContent = $json->{"Content"};
    $jsonDate = $json->{"Date"};

    // If the post ID is greater than the starting place, skip to end.
    // IE: Post ID = 7, starting post = 5: Skips Post 7 and 6.
    if($jsonStart < $jsonPageStart){
      $jsonStart++;
      goto end;
    }
    
    $jsonStop++;
    
    echo "<h1><a href='index.php?id=" . $jsonID . "'>" . $jsonTitle . "</a></h1>" . $jsonContent . "<div class='bottom'>" . date('F j, Y',$jsonDate) . "</div>";
    
    end:
    
    if($jsonStop == $jsonTotal){
      break;
    }
  }

  echo "<div class='page'>";
  if($page > 1){
    echo "<div class='page_left'><a href='index.php?page=" . ($page - 1) . "'>Last $jsonTotal</a></div>";
  }
  if($jsonStop == $jsonTotal && $jsonID != 1){
    echo "<div class='page_right'><a href='index.php?page=" . ($page + 1) . "'>Next $jsonTotal</a></div>";
  }
  echo "</div>";
}