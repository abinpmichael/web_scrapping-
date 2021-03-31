<?php
include_once('../simple_html_dom.php');

function scraping_digg() {
    // create HTML DOM
    $html = file_get_html('https://www.mattskitchens.com/#');

    // get news block
    foreach($html->find('div.card-body') as $article) {
        // get title
        $item['title'] = trim($article->find('span[class=text-uppercase]', 0)->plaintext);
        // get details
        $item['details'] = trim($article->find('p', 0)->plaintext);
        // get intro
        $item['diggs'] = trim($article->find('img[class=w-100 h-100]', 0));

        $ret[] = $item;
    }
    //td[align=center]
    
    // clean up memory
    $html->clear();
    unset($html);

    return $ret;
}


// -----------------------------------------------------------------------------
// test it!

// "http://digg.com" will check user_agent header...
ini_set('user_agent', 'My-Application/2.5');

$ret = scraping_digg();
echo "<table border='1'><tr><td>name</td><td>price</td><td>url</url>";
foreach($ret as $v) {
    echo "<tr><td>".$v['title'].'</td>';
    //echo '<ul>';
    echo '<td>'.$v['details'].'</td>';
    echo '<td  >'.$v['diggs'].'</td>';
    echo '</tr>';
}
echo "</table>";
?>
<style type="text/css">
    .w-100{
        width: 100px;
        height: 100px;
    }
</style>