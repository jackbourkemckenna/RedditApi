
<?php 

if (isset($_POST['submit']))
  {
  // Execute this code if the submit button is pressed.
  $formvalue = $_POST['input_value'];
   
  }

$string_reddit = file_get_contents("https://www.reddit.com/r/$formvalue.json?");
$json = json_decode($string_reddit, true);  

$children = $json['data']['children'];
foreach ($children as $child){
    $title = $child['data']['title'];
    $url = $child['data']['url'];
}
// This will check if the url is an image or just a link 
$urlInfo=getimagesize($url);
if(is_array($urlInfo))
{
       // The image exists
 //closing the php tag so I can add in html 
?>

<html><h1><?php echo $title; ?></h1>
  <img src="<?php echo $url ?>" alt="" height = "100" /> </html>

<?php 
  //Opening it again to continue the else statement 
  
}
// will check if the the url is a vimeo link or a youtube link
elseif(stripos($url,'vimeo.com')===false){
    //
strtok($url, '?');

  parse_str(strtok('')); // I used this thread  http://stackoverflow.com/questions/9973520/getting-youtube-video-id-the-php for help 

?>

<html><h1><?php echo $title; ?></h1>
  <iframe width="420" height="315" src="http://www.youtube.com/embed/<?php echo $v; ?>" frameborder="0" allowfullscreen></iframe>  

<?php 
    } else {
    //is youtube
  echo $url;
    }
