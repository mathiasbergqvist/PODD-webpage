<?php
  if(!loggedin()){
    header("location: index.php?site=home");
  }
?>

<h2>PODD - Portable Diary Data Collection </h2>
<p>PODD är ett system som samlar in aktiviteter i from av dagboksdata med hjälp av en applikation utvevklad för mobila enheter. Systemet tillhandahåller en effektivt, användarvänlig och lättåtkomlig plattform för dataregistrering.</p>

<br>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="item active">
          	<img class="carousel-image" src="images/screen_1.png" alt="First slide">
            <div class="carousel-caption">
              <h3>Hierarkisk aktivitetsinmatning.</h3>
            </div>
        </div>
        <div class="item">
          	<img class="carousel-image" src="images/screen_2.png" alt="Second slide">
            <div class="carousel-caption">
              <h3>Direkt överblick över pågående aktiviteter.</h3>
            </div>
        </div>
        <div class="item">
          	<img class="carousel-image" src="images/screen_3.png" alt="Third slide">
            <div class="carousel-caption">
              <h3>Grafisk dagboksvy med möjligheter till aktivitetsredigering.</h3>
            </div>
        </div>
    </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div><!-- /.carousel -->
