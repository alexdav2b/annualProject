<?php
$title = 'FightFoodWaste';
$scripts = array(); 
ob_start();

?>
<div class = "col-md-12 col-lg-12" id = "home-content">
    <div class = "col-md-8 offset-md-2 col-lg-8 offset-lg-2 row homeSlide" style = "padding-bottom : 1em;" id= "div1">
        <img class= "col-md-4 col-lg-4" style = "height:100%" src= "../images/fond3.jpg" style = "width : 100%;">
        <div class ="col-md-8 col-lg-8" style = "margin-top : 0px">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ac tellus vel mauris vulputate hendrerit. Nam ac ligula in felis molestie ornare nec nec ipsum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc eget commodo mi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Ut lacinia ornare iaculis. Ut non euismod dolor, sit amet luctus urna. </div>
    </div>
    <div class = "col-md-8 offset-md-2 col-lg-8 offset-lg-2 row homeSlide" style = "padding-bottom : 1em;" id = "div2">
        <div class ="col-md-8 col-lg-8" style = "margin-top : 0px">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ac tellus vel mauris vulputate hendrerit. Nam ac ligula in felis molestie ornare nec nec ipsum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc eget commodo mi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Ut lacinia ornare iaculis. Ut non euismod dolor, sit amet luctus urna. </div>
        <img class= "col-md-4 col-lg-4" style = "height:100%" src= "../images/fond3.jpg" style = "width : 100%;">
    </div>
    <div class = "col-md-8 offset-md-2 row homeSlide" style = "padding-bottom : 1em;" id= "div3">
        <img class= "col-md-4 col-lg-4" style = "height:100%" src= "../images/fond3.jpg" style = "width : 100%;">
        <div class ="col-md-8 col-lg-8" style = "margin-top : 0px">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ac tellus vel mauris vulputate hendrerit. Nam ac ligula in felis molestie ornare nec nec ipsum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc eget commodo mi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Ut lacinia ornare iaculis. Ut non euismod dolor, sit amet luctus urna. </div>
    </div>
    <div class = "col-md-8 offset-md-2 col-lg-8 offset-lg-2" style = "padding-bottom : 1em;" id= "about">
        <a class = "btn btn-light offset-md-5 offset-lg-5" href = "#titre">&#8593 Remonter</a>
    </div>
</div>

<!-- <img src = '../images/fond1.jpg' style ="width : 100%"> --> 
<?php 
$content = ob_get_clean();

require_once __DIR__ . '/templateView.php';