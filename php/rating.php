<?php
require_once dirname(__FILE__) . "/overlay_nav.php";
require_once dirname(__FILE__) . '/session.php';
require_once dirname(__FILE__) . '/connection.php';

if (isset($_SESSION['ID'])) {

    $id = htmlspecialchars($_SESSION['ID']);

    $getRoommate_sql = $conn->prepare("SELECT pr.ID, pr.Name, ph.photo_type, ph.photo_content FROM Dorm.Profile as pr, Dorm.photo as ph WHERE pr.ID = ph.id and pr.id != ? and pr.Room = (SELECT p.Room from Dorm.Profile as p WHERE p.ID = ?) and pr.Dorm = (SELECT p.Dorm from Dorm.Profile as p WHERE p.ID = ?)");
    $getRoommate_sql->bind_param("iii", $id, $id, $id);
    $getRoommate_sql->execute();
    $getRoommate_sql->store_result();

    if ($getRoommate_sql->num_rows > 0) {
        $getRoommate_sql->bind_result($RID, $Rname, $Rtype, $Rphoto);

        $roommates = [];

        while ($getRoommate_sql->fetch()) {
            $roommates[] = ['RID' => $RID, 'Rname' => $Rname, 'Rtype' => $Rtype, 'Rphoto' => base64_encode($Rphoto)];
        }
    }
    $getRoommate_sql->free_result();
    $getRoommate_sql->close();

    $getRating_sql = $conn->prepare("SELECT Reviewee_ID, Reviewee_name, ROUND(AVG(Rating_one), 2), ROUND(AVG(Rating_two), 2), ROUND(AVG(Rating_three), 2), ROUND(AVG(Rating_four), 2), ROUND(AVG(Rating_five), 2), ROUND(AVG(Rating_six), 2)FROM Rating GROUP BY Reviewee_ID, Reviewee_name");
    $getRating_sql->execute();
    $getRating_sql->store_result();

    if ($getRating_sql->num_rows) {
        $getRating_sql->bind_result($EID, $Ename, $r1, $r2, $r3, $r4, $r5, $r6);

        $reviewees = [];

        while ($getRating_sql->fetch()) {
            $reviewees[] = ['EID' => $EID, 'Ename' => $Ename, 'r1' => $r1, 'r2' => $r2, 'r3' => $r3, 'r4' => $r4, 'r5' => $r5, 'r6' => $r6];
        }
    }

    $getRating_sql->free_result();
    $getRating_sql->close();
} else {
    echo "<script>alert('請先登入!!!');</script>";
    echo "<script>window.location.href = 'login.php';</script>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ReviewerID = htmlspecialchars($_SESSION['ID']);
    $RevieweeID = htmlspecialchars($_POST["chooseRID"]);
    $RevieweeName = htmlspecialchars($_POST["chooseRname"]);
    $ReviewerName = htmlspecialchars($_SESSION['name']);
    $rating1 = htmlspecialchars($_POST['rating1']);
    $rating2 = htmlspecialchars($_POST['rating2']);
    $rating3 = htmlspecialchars($_POST['rating3']);
    $rating4 = htmlspecialchars($_POST['rating4']);
    $rating5 = htmlspecialchars($_POST['rating5']);
    $rating6 = htmlspecialchars($_POST['rating6']);
    $review = htmlspecialchars($_POST['txtcomment']);

    $count_sql = $conn->prepare("SELECT * FROM Dorm.Rating WHERE Reviewer_ID = ? and Reviewee_ID = ?");
    $count_sql->bind_param("ii", $ReviewerID, $RevieweeID);
    $count_sql->execute();
    $count_sql->store_result();

    if ($count_sql->num_rows) {
        $update_sql = $conn->prepare("UPDATE Dorm.Rating SET Rating_one = ?, Rating_two = ?, Rating_three = ?, Rating_four = ?, Rating_five = ?, Rating_six = ?, Review = ? WHERE Reviewer_ID = ? and Reviewee_ID = ?");
        $update_sql->bind_param("ddddddsii", $rating1, $rating2, $rating3, $rating4, $rating5, $rating6, $review, $ReviewerID, $RevieweeID);
        $update_sql->execute();
        $update_sql->close();
    } else {
        $insert_sql = $conn->prepare("INSERT INTO Dorm.Rating (Reviewer_ID, Reviewee_ID, Reviewer_name, Reviewee_name, Rating_one, Rating_two, Rating_three, Rating_four, Rating_five, Rating_six, Review)  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_sql->bind_param("iissdddddds", $ReviewerID, $RevieweeID, $ReviewerName, $RevieweeName, $rating1, $rating2, $rating3, $rating4, $rating5, $rating6, $review);
        $insert_sql->execute();
        $insert_sql->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roommate Rating</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="../css/rating.css">
</head>

<body>
    <form id="ratingForm" method="post" action="rating.php" onkeydown="return event.key != 'Enter';">
        <div class="container-fluid mx-3 my-5">
            <div class="step d-flex flex-column" id="step1">
                <div class="text-center">
                    <h2>評分系統<h2>
                </div>
                <hr>
                <div class="container-fluid p-5">
                    <input type="hidden" name="ratingsys" id="ratingsys">
                    <div class="row justify-content-center text-center">
                        <div class="col-md-3 block-container mx-5">
                            <div class="rect-block d-flex flex-column" onclick="submitStep1('a')">
                                <img src="../pic/star.jpg" class="img-fluid rounded">
                                <h3 class="mt-2">評分室友</h3>
                            </div>
                        </div>
                        <div class="col-md-3  block-container mx-5">
                            <div class="rect-block d-flex flex-column" onclick="submitStep1('b')">
                                <img src="../pic/search.jpg" class="img-fluid rounded">
                                <h3 class="mt-2">查看評分</h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="container-fluid mx-3 my-5">
            <div class="step d-flex d-none flex-column" id="step2a">
                <div class="container-fluid mx-3 my-2 text-center">
                    <h2>哪個室友...<h2>
                </div>
                <hr>
                <div class="container-fluid mx-3 my-2">
                    <input type="hidden" name="chooseRID" id="chooseRID">
                    <input type="hidden" name="chooseRname" id="chooseRname">
                    <?php if (!empty($roommates)) : ?>
                        <div class="d-flex">
                            <?php foreach ($roommates as $roommate) : ?>
                                <div class="rect-block d-flex flex-column justify-content-center align-items-center mx-5" onclick="submitStep2a('<?php echo $roommate['RID']; ?>', '<?php echo $roommate['Rname']; ?>');">
                                    <img class="fixed-size" src="data:<?php echo $roommate['Rtype']; ?>;base64,<?php echo $roommate['Rphoto']; ?>">
                                    <br>
                                    <p><?php echo "ID : " . $roommate['RID']; ?></p>
                                    <p><?php echo "Name : " . $roommate['Rname']; ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <div class="text-center">
                            <h2>查無室友資料!!!</h2>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-previous mt-2" onclick="backtoStep1('a');"><i class="bi bi-arrow-left"></i>上一步</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid mx-3 my-5">
            <div class="step d-flex d-none flex-column " id="step2b">
                <div class="text-center">
                    <h2>評分資訊<h2>
                </div>
                <hr>
                <div class="container-fluid w-75 my-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="button" class="btn btn-previous" onclick="backtoStep1('b');"><i class="bi bi-arrow-left"></i>上一步</button>
                        </div>
                        <div>
                            <input type="text" class="form-control" id="searchInput" onkeyup="filterTable()" placeholder="Search for Reviewee ID">
                        </div>
                    </div>
                </div>

                <div class="container-fluid w-75 justify-content-center align-items-center">
                    <table class="table table-striped table-hover" id="ratingTable">
                        <thead>
                            <tr>
                                <th scope="col">學號</th>
                                <th scope="col">姓名</th>
                                <th scope="col">衛生(/5)</th>
                                <th scope="col">作息(/5)</th>
                                <th scope="col">課業(/5)</th>
                                <th scope="col">外貌(/5)</th>
                                <th scope="col">人品(/5)</th>
                                <th scope="col">財富(/5)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($reviewees)) : ?>
                                <?php foreach ($reviewees as $reviewee) : ?>
                                    <tr class="table-row" onclick="openProfile(<?php echo $reviewee['EID']; ?>);">
                                        <th scope="row"><?php echo $reviewee['EID']; ?></th>
                                        <td><?php echo $reviewee['Ename']; ?></td>
                                        <td><?php echo $reviewee['r1']; ?></td>
                                        <td><?php echo $reviewee['r2']; ?></td>
                                        <td><?php echo $reviewee['r3']; ?></td>
                                        <td><?php echo $reviewee['r4']; ?></td>
                                        <td><?php echo $reviewee['r5']; ?></td>
                                        <td><?php echo $reviewee['r6']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="container-fluid mx-3 my-5">
            <div class="step d-flex flex-column d-none" id="step3">
                <div class="text-center">
                    <h2>室友評分</h2>
                </div>
                <hr>
                <div class="container-fluid d-flex flex-column align-items-center justify-content-center">

                    <div class="form-group">
                        <label>衛生</label>
                        <div class="star-rating d-inline-block my-2">
                            <input class="d-none" id="star5-1" type="radio" name="rating1" value="5" required><label for="star5-1" title="5 stars"><i class="fas fa-star"></i></label>
                            <input class="d-none" id="star4-1" type="radio" name="rating1" value="4" required><label for="star4-1" title="4 stars"><i class="fas fa-star"></i></label>
                            <input class="d-none" id="star3-1" type="radio" name="rating1" value="3" required><label for="star3-1" title="3 stars"><i class="fas fa-star"></i></label>
                            <input class="d-none" id="star2-1" type="radio" name="rating1" value="2" required><label for="star2-1" title="2 stars"><i class="fas fa-star"></i></label>
                            <input class="d-none" id="star1-1" type="radio" name="rating1" value="1" required><label for="star1-1" title="1 star"><i class="fas fa-star"></i></label>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>作息</label>
                        <div class="star-rating d-inline-block my-2">
                            <input class="d-none" id="star5-2" type="radio" name="rating2" value="5" required><label for="star5-2" title="5 stars"><i class="fas fa-star"></i></label>
                            <input class="d-none" id="star4-2" type="radio" name="rating2" value="4" required><label for="star4-2" title="4 stars"><i class="fas fa-star"></i></label>
                            <input class="d-none" id="star3-2" type="radio" name="rating2" value="3" required><label for="star3-2" title="3 stars"><i class="fas fa-star"></i></label>
                            <input class="d-none" id="star2-2" type="radio" name="rating2" value="2" required><label for="star2-2" title="2 stars"><i class="fas fa-star"></i></label>
                            <input class="d-none" id="star1-2" type="radio" name="rating2" value="1" required><label for="star1-2" title="1 star"><i class="fas fa-star"></i></label>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>課業</label>
                        <div class="star-rating d-inline-block my-2">
                            <input class="d-none" id="star5-3" type="radio" name="rating3" value="5" required><label for="star5-3" title="5 stars"><i class="fas fa-star"></i></label>
                            <input class="d-none" id="star4-3" type="radio" name="rating3" value="4" required><label for="star4-3" title="4 stars"><i class="fas fa-star"></i></label>
                            <input class="d-none" id="star3-3" type="radio" name="rating3" value="3" required><label for="star3-3" title="3 stars"><i class="fas fa-star"></i></label>
                            <input class="d-none" id="star2-3" type="radio" name="rating3" value="2" required><label for="star2-3" title="2 stars"><i class="fas fa-star"></i></label>
                            <input class="d-none" id="star1-3" type="radio" name="rating3" value="1" required><label for="star1-3" title="1 star"><i class="fas fa-star"></i></label>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>外貌</label>
                        <div class="star-rating d-inline-block my-2">
                            <input class="d-none" id="star5-4" type="radio" name="rating4" value="5" required><label for="star5-4" title="5 stars"><i class="fas fa-star"></i></label>
                            <input class="d-none" id="star4-4" type="radio" name="rating4" value="4" required><label for="star4-4" title="4 stars"><i class="fas fa-star"></i></label>
                            <input class="d-none" id="star3-4" type="radio" name="rating4" value="3" required><label for="star3-4" title="3 stars"><i class="fas fa-star"></i></label>
                            <input class="d-none" id="star2-4" type="radio" name="rating4" value="2" required><label for="star2-4" title="2 stars"><i class="fas fa-star"></i></label>
                            <input class="d-none" id="star1-4" type="radio" name="rating4" value="1" required><label for="star1-4" title="1 star"><i class="fas fa-star"></i></label>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>人品</label>
                        <div class="star-rating d-inline-block my-2">
                            <input class="d-none" id="star5-5" type="radio" name="rating5" value="5" required><label for="star5-5" title="5 stars"><i class="fas fa-star"></i></label>
                            <input class="d-none" id="star4-5" type="radio" name="rating5" value="4" required><label for="star4-5" title="4 stars"><i class="fas fa-star"></i></label>
                            <input class="d-none" id="star3-5" type="radio" name="rating5" value="3" required><label for="star3-5" title="3 stars"><i class="fas fa-star"></i></label>
                            <input class="d-none" id="star2-5" type="radio" name="rating5" value="2" required><label for="star2-5" title="2 stars"><i class="fas fa-star"></i></label>
                            <input class="d-none" id="star1-5" type="radio" name="rating5" value="1" required><label for="star1-5" title="1 star"><i class="fas fa-star"></i></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>財富</label>
                        <div class="star-rating d-inline-block my-2">
                            <input class="d-none" id="star5-6" type="radio" name="rating6" value="5" required><label for="star5-6" title="5 stars"><i class="fas fa-star"></i></label>
                            <input class="d-none" id="star4-6" type="radio" name="rating6" value="4" required><label for="star4-6" title="4 stars"><i class="fas fa-star"></i></label>
                            <input class="d-none" id="star3-6" type="radio" name="rating6" value="3" required><label for="star3-6" title="3 stars"><i class="fas fa-star"></i></label>
                            <input class="d-none" id="star2-6" type="radio" name="rating6" value="2" required><label for="star2-6" title="2 stars"><i class="fas fa-star"></i></label>
                            <input class="d-none" id="star1-6" type="radio" name="rating6" value="1" required><label for="star1-6" title="1 star"><i class="fas fa-star"></i></label>
                        </div>
                    </div>

                    <div class="form-group my-2">
                        <textarea id="comments" class="form-control" name="txtcomment" rows="4" placeholder="評論..."></textarea>
                    </div>

                    <div class="d-inline-block mt-2">
                        <button type="button" class="btn btn-previous mx-1" onclick="backtoStep2();"><i class="bi bi-arrow-left"></i>上一步</button>
                        <button type="submit" class="btn btn-primary btn-submit mx-1">提交</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="../js/rating.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        function openProfile(id) {
            var url = 'profile.php?ID=' + id;
            window.open(url, '_blank');
        };
    </script>
</body>
</body>

</html>