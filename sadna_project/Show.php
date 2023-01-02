<html lang="en">
<head>
</head>
<body>
<?php 
   
   include 'header.php';
   
   ?>
    <!-- container for content-->
        <div class="container panel">
            <div class="row">
                <div class="col-4 d-flex justify-content-center ">
                    <img class="img-fluid" src="https://m.media-amazon.com/images/M/MV5BODc1NGMwNGQtNjlmMy00OGQ5LWJhNmItZTQyMTA4MjcyM2U1XkEyXkFqcGdeQXVyMjkwOTAyMDU@._V1_SX300.jpg" alt="...">
                </div>
                <div class="col-8">
                    <h1><?php echo $_GET['Showname']?></h1>
                    <h3>TV Show, Filmed at Mexico</h3>
                    <h3>Rated: TV-MA, Duration: 2 Seasons, Released 2020</h3>
                    <h3>Description:</h3>
                    <p>Witness the birth of the Mexican drug war in the 1980s as a gritty new "Narcos" saga chronicles the true story of the Guadalajara cartel's ascent.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <h3>Cast:</h3>
                    <ul class="list-group">
                        <li class="list-group-item"><a href="#">Michael Peña</a></li>
                        <li class="list-group-item"><a href="#">Diego Luna</a></li>
                        <li class="list-group-item"><a href="#">Tenoch Huerta</a></li>
                        <li class="list-group-item"><a href="#">Joaquin Cosio</a></li>
                        <li class="list-group-item"><a href="#">José María Yazpik</a></li>
                        <li class="list-group-item"><a href="#">Matt Letscher</a></li>
                        <li class="list-group-item"><a href="#">Alyssa Diaz</a></li>
                    </ul>
                </div>
                <div class="col-8">
                    <h3>Reviews:</h3>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="container">
                                <h4>Review by <a>[USERNAME]</a>, written at [DATE].</h4>
                                <h4>Rating: 5/5</h4>
                                <p>
                                    This is a very engaging docu-series mixed with plenty of real world facts, historical events, and television storytelling to bring it all together in what could well be the best deliverance of any drug war series in our times. Charming characters, great acting, great cast, and stays just strong and succinct enough to not get tiring before it ends. A masterpiece.
                                </p>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="container">
                                <h4>Review by <a>[USERNAME]</a>, written at [DATE].</h4>
                                <h4>Rating: 4/5</h4>
                                <p>
                                    Very engaging and well acted. I looked forward to watching each episode. I only watched the series while on the treadmill, which was great, as it made time pass more quickly.
                                </p>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="container">
                                <h4>Review by <a>[USERNAME]</a>, written at [DATE].</h4>
                                <h4>Rating: 1.5/5</h4>
                                <p>
                                    Cringeworthy, corny dialogue and acting (esp Kiki). No character depth save for Don Neto. Highly unbingeable.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
</body>
</html>
