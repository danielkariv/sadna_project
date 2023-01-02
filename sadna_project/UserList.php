<html lang="en">
<head>
</head>
<body>
<?php 
   
   include 'header.php';
   
   ?>
    <div class="container">
            <h1><?php echo $_GET['Username']?></h1>
            <h4>Joined at: [DATE] , Last seen at: [DATE]</h4>
            <div class="row">
                <div class="col-5">
                    <h5>Shows List:</h5>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-2">
                                    <img class="img-fluid" src="https://m.media-amazon.com/images/M/MV5BODc1NGMwNGQtNjlmMy00OGQ5LWJhNmItZTQyMTA4MjcyM2U1XkEyXkFqcGdeQXVyMjkwOTAyMDU@._V1_SX300.jpg" alt="...">
                                </div>
                                <div class="col">Nercos: Maxico</div>
                                <div class="col-3">Watching</div>
                            </div>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-2">
                                        <img class="img-fluid" src="https://m.media-amazon.com/images/M/MV5BMTM5NjM0ODY1NF5BMl5BanBnXkFtZTcwMjk5NjI0Ng@@._V1_SX300.jpg" alt="...">
                                    </div>
                                    <div class="col">30 Minutes or Less</div>
                                    <div class="col-3">Dropped</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-2">
                                        <img class="img-fluid" src="https://m.media-amazon.com/images/M/MV5BMTU0MjAwMDkxNV5BMl5BanBnXkFtZTgwMTA4ODIxNjM@._V1_SX300.jpg" alt="...">
                                    </div>
                                    <div class="col">Next Gen</div>
                                    <div class="col-3">Plan To Watch</div>
                                </div>
                            </li>
                        </li>
                    </ul>
                </div>
                <div class="col-7">
                    <h5>Wall:</h5>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-3">
                                    <div class="col-12">[Account Name]</div>
                                    <div class="col-12">[Date]</div>
                                </div>
                                <div class="col-9">
                                    [Message]
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-3">
                                    <div class="col-12">John Smith</div>
                                    <div class="col-12">25.12.2022</div>
                                </div>
                                <div class="col-9">
                                    Wow I loved [ENTER SHOWNAME HERE] so much! If you liked [SAME SHOWNAME], I can recommend on [SHOW1], and [SHOW2]. Both shows are similar to [TALKED ABOUT SHOW] and similar to other shows you plan to watch.
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-3">
                                    <div class="col-12">[Account Name]</div>
                                    <div class="col-12">[Date]</div>
                                </div>
                                <div class="col-9">
                                    [Message]
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
</body>
</html>