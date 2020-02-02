<?php

// RewriteBase /henning/
// RewriteCond %{HTTP_HOST} !^www\.
// RewriteRule ^(.*)$ http://www.%{HTTP_HOST}/$1 [R=301,L]

$server = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");

if($server == "https")
{
  header("Location: http://www.henning-witzel.de/");
  die();
}

header("Content-Type: text/html; charset=utf-8");

if( isset( $_GET['page']) && !empty($_GET['page']) ) $_page = htmlspecialchars($_GET['page']);
else $_page = 'index';

if( isset( $_GET['subpage']) && !empty($_GET['subpage']) ) $_subpage = htmlspecialchars($_GET['subpage']);


$_headerContent = file_get_contents('pages/header.html');
$_menuContent = file_get_contents('pages/menu.html');

if( $_subpage )
{
  $_pageContent = file_get_contents('pages/' . $_page . '/' . $_subpage . '/index.php');
}
else
{
  $_pageContent = file_get_contents('pages/' . $_page . '/index.php');
}

$_footerContent = file_get_contents('pages/footer.html');


$_basePath = 'http://localhost/';

$ptt = array();
$rpl = array();

$ptt[] = "/###page###/"; $rpl[] = $_page;
$ptt[] = "/###subpage###/"; $rpl[] = $_subpage;
$ptt[] = "/###menu###/"; $rpl[] = $_menuContent;

$ptt[] = "/###" . $_page . "_active###/"; $rpl[] = 'active';

$ptt[] = "/###basepath###/"; $rpl[] = $_basePath;

if ( $_page == "stories" && empty($_subpage) )
{
  $jsonFile = file_get_contents($_basePath . 'pages/stories/stories.json');
  $json = json_decode($jsonFile);

  
  $count = 0;

  foreach($json as $storie)
  {   
    // if($count%4 == 0)
    // {
    //   if($count != 0)
    //   {
    //     $content .= ' </div>';
    //     $content .= ' <div class="clearfix"></div>';        
    //   }

    //   $content .= '<div class="row">';      
    // }

    $content .= " <div class='col'>";
    $content .= " <a href='###basepath######page###/" . $storie->link. "'>";
    $content .= "   <img src='###basepath###pages/###page###/" . $storie->img_link. "'>";
    $content .= "   <h1>".$storie->title."</h1>";
    $content .= "   <h2>".$storie->date."</h2>";
    $content .= ' </a>';
    $content .= ' </div>';

    $count++;
  }
  

  $ptt[] = "/###stories###/";
  $rpl[] = preg_replace($ptt, $rpl, $content);
}
else if( $_page == "stories" && !empty($_subpage))
{

  $dir = scandir('pages/stories/' . $_subpage . '/images');
  
  foreach($dir as $image)
  {
    if(strpos($image,'jpg'))
    {             
      //$subpageContent .= "<img src='" . $_basePath . "pages/stories/" . $_subpage . "/images/". $image ."' />";
      $subpageContent .= "<img data-original='" . $_basePath . "pages/stories/" . $_subpage . "/images/". $image ."' . src='" . $_basePath . "img/load.jpg" ."' />";      
    }      
  }

  $ptt[] = "/###stories_" . $_subpage . "###/"; $rpl[] = $subpageContent;
}


if ( $_page == "portfolio" && empty($_subpage) )
{
  $jsonFile = file_get_contents($_basePath . 'pages/portfolio/portfolio.json');
  $json = json_decode($jsonFile);

  
  $count = 0;

  foreach($json as $storie)
  {   
    // if($count%4 == 0)
    // {
    //   if($count != 0)
    //   {
    //     $content .= ' </div>';
    //     $content .= ' <div class="clearfix"></div>';        
    //   }

    //   $content .= '<div class="row">';      
    // }

    $content .= " <div class='col'>";
    $content .= " <a href='###basepath######page###/" . $storie->link. "'>";
    $content .= "   <img src='###basepath###pages/###page###/" . $storie->img_link. "'>";
    $content .= "   <h1>".$storie->title."</h1>";
    $content .= "   <h2>".$storie->date."</h2>";
    $content .= ' </a>';
    $content .= ' </div>';

    $count++;
  }
  

  $ptt[] = "/###portfolio###/";
  $rpl[] = preg_replace($ptt, $rpl, $content);
}
else if( $_page == "portfolio" && !empty($_subpage))
{

  $dir = scandir('pages/portfolio/' . $_subpage . '/images');
  
  foreach($dir as $image)
  {
    if(strpos($image,'jpg'))
    {             
      //$subpageContent .= "<img src='" . $_basePath . "pages/portfolio/" . $_subpage . "/images/". $image ."' />";
      $subpageContent .= "<img data-original='" . $_basePath . "pages/portfolio/" . $_subpage . "/images/". $image ."' . src='" . $_basePath . "img/load.jpg" ."' />";   
    }      
  }

  $ptt[] = "/###portfolio" . $_subpage . "###/"; $rpl[] = $subpageContent;
}

// ----------------------------------------
// Projects
// ----------------------------------------

if ( $_page == "projects" && empty($_subpage) )
{
  $jsonFile = file_get_contents($_basePath . 'pages/projects/projects.json');
  $json = json_decode($jsonFile);

  
  $count = 0;

  foreach($json as $storie)
  {   
    // if($count%4 == 0)
    // {
    //   if($count != 0)
    //   {
    //     $content .= ' </div>';
    //     $content .= ' <div class="clearfix"></div>';        
    //   }

    //   $content .= '<div class="row">';      
    // }

    $content .= " <div class='col'>";
    $content .= " <a href='###basepath######page###/" . $storie->link. "'>";
    $content .= "   <img src='###basepath###pages/###page###/" . $storie->img_link. "'>";
    $content .= "   <h1>".$storie->title."</h1>";
    $content .= "   <h2>".$storie->date."</h2>";
    $content .= ' </a>';
    $content .= ' </div>';

    $count++;
  }
  

  $ptt[] = "/###projects###/";
  $rpl[] = preg_replace($ptt, $rpl, $content);
}
else if( $_page == "projects" && !empty($_subpage))
{

  $dir = scandir('pages/projects/' . $_subpage . '/images');
  
  foreach($dir as $image)
  {
    if(strpos($image,'jpg'))
    {             
      //$subpageContent .= "<img src='" . $_basePath . "pages/portfolio/" . $_subpage . "/images/". $image ."' />";
      $subpageContent .= "<img data-original='" . $_basePath . "pages/projects/" . $_subpage . "/images/". $image ."' . src='" . $_basePath . "img/load.jpg" ."' />";   
    }      
  }

  $ptt[] = "/###projects" . $_subpage . "###/"; $rpl[] = $subpageContent;
}


echo preg_replace($ptt, $rpl, $_headerContent);
echo preg_replace($ptt, $rpl, $_pageContent);
echo preg_replace($ptt, $rpl, $_footerContent);

?>