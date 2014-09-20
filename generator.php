<?PHP

include 'inc/header.php';

$json = file_get_contents("json/blog.json");
$json = json_decode($json);

foreach($json->{'Posts'} as $json) {
  
  $jsonID = $json->{"Id"} + 1;
  break;
  
}

?>

<h1>Post Generator (<a href="generator.php" style="color: #2980b9">New</a>)</h1>

<?PHP

if(isset($_POST['post_id'])){
  
  $post_id = intval($_POST['post_id']);
  $title = htmlspecialchars($_POST['title']);
  $content = htmlspecialchars($_POST['content']);
  $date = time();
  
  echo '<textarea>"' . $post_id . '": {
      "Id": ' . $post_id . ',
      "Title": "' . $title . '",
      "Content": "' . $content . '",
      "Date": "' . $date . '"
    },</textarea>';
  
} else {

?>

<form action="generator.php" method="post">
  <fieldset>
    <label for="post_id">Post Id</label><br />
    <input type="text" name="post_id" id="post_id" value="<?PHP echo $jsonID; ?>"><br />
    <label for="title">Title</label><br />
    <input type="text" name="title" id="title" placeholder="Title"><br />
    <label for="content">Content</label><br />
    <textarea name="content" id="content" placeholder="Content"></textarea><br />
  </fieldset>
  <input type="submit" value="Generate" class="submit">
</form>

<?PHP

}

include 'inc/footer.php';