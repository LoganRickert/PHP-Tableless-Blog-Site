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
    
    foreach($json->{'Posts'} as $json1) {
      $jsonFirstID = $json1->{"Id"};
      break;
    }
    
    // If an ID is set, only get the content of that ID.
    $json = $json->{'Posts'}->{'' . $id . ''};
    
    $jsonID = $json->{"Id"};
   	$jsonTitle = $json->{'Title'};
    $jsonContent = $json->{"Content"};
    $jsonDate = $json->{"Date"};
    echo "<h1>" . $jsonTitle . "</h1>" . $jsonContent . "<div class='bottom'>" . date('F j, Y',$jsonDate) . "</div>";
    
    echo "<div class='page'>";
    if($jsonFirstID !== $jsonID){
      echo "<div class='page_left'><a href='index.php?id=" . ($id + 1) . "'>Post " . ($id + 1) . "</a></div>";
    }
    if($id > 1){
      echo "<div class='page_right'><a href='index.php?id=" . ($id - 1) . "'>Post " . ($id - 1) . "</a></div>";
    }
    echo "</div>";
    
    ?>
    <div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'loganr'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
    
    <?PHP
    
  } else {

	include 'inc/pagimation.php';
	
	// $jsonOffset = Where to start. If set to 7, it starts at post id 7 and goes from there down. 
	// It will stop at the second number (5 by default). $page is the page you are on.
	pagimation($jsonOffset,3,$page);
	
  }
  
  // Get the footer information.
  include 'inc/footer.php';