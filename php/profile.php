<?php
header('Content-Type: text/html; charset=UTF-8');
require_once dirname(__FILE__) . "/session.php";
require_once dirname(__FILE__) . "/connection.php";
require_once dirname(__FILE__) . "/overlay_nav.php";
require_once dirname(__FILE__) . "/head.php";

if (isset($_GET['ID'])) {
    $id = $_GET['ID'];
    $getProfile_sql = $conn->prepare("SELECT * FROM Dorm.Profile WHERE ID = ?");
    $getProfile_sql->bind_param("i", $id);
    $getProfile_sql->execute();
    $result = $getProfile_sql->get_result();

    if ($result->num_rows) {
        $row = $result->fetch_assoc();
        $user_data = $row;

        $getPhoto_sql = $conn->prepare("SELECT photo_type, photo_content FROM Dorm.photo WHERE ID = ?");
        $getPhoto_sql->bind_param("i", $id);
        $getPhoto_sql->execute();
        $result = $getPhoto_sql->get_result();

        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            $user_data['photo'] = $row;
        }

        $getPhoto_sql->free_result();
        $getPhoto_sql->close();
    }
    $getProfile_sql->free_result();
    $getProfile_sql->close();

    $getRating_sql = $conn->prepare("SELECT ROUND(AVG(Rating_one), 2), ROUND(AVG(Rating_two), 2), ROUND(AVG(Rating_three), 2), ROUND(AVG(Rating_four), 2), ROUND(AVG(Rating_five), 2), ROUND(AVG(Rating_six), 2) FROM Rating WHERE Reviewee_ID = ?");
    $getRating_sql->bind_param("i", $id);
    $getRating_sql->execute();
    $getRating_sql->store_result();

    if ($getRating_sql->num_rows) {
        $getRating_sql->bind_result($r1, $r2, $r3, $r4, $r5, $r6);
        $getRating_sql->fetch();
        if ($r1 !== null || $r2 !== null || $r3 !== null || $r4 !== null || $r5 !== null || $r6 !== null) {
            $reviewee = ['r1' => $r1, 'r2' => $r2, 'r3' => $r3, 'r4' => $r4, 'r5' => $r5, 'r6' => $r6];

            $getReview_sql = $conn->prepare("SELECT Review FROM Dorm.Rating WHERE Reviewee_ID = ?");
            $getReview_sql->bind_param("i", $id);
            $getReview_sql->execute();
            $getReview_sql->store_result();
            $reviews = array();

            if ($getReview_sql->num_rows > 0) {
                $getReview_sql->bind_result($rv);

                while ($getReview_sql->fetch()) {
                    if ($rv !== null)
                        $reviews[] = ['rv' => $rv];
                }
            }

            $getReview_sql->free_result();
            $getReview_sql->close();
        }
    }
    $getRating_sql->free_result();
    $getRating_sql->close();
} else if (isset($_SESSION['ID'])) {
    $id = $_SESSION['ID'];
    $user_data = $_SESSION['user_data'];

    $getRating_sql = $conn->prepare("SELECT ROUND(AVG(Rating_one), 2), ROUND(AVG(Rating_two), 2), ROUND(AVG(Rating_three), 2), ROUND(AVG(Rating_four), 2), ROUND(AVG(Rating_five), 2), ROUND(AVG(Rating_six), 2) FROM Rating WHERE Reviewee_ID = ?");
    $getRating_sql->bind_param("i", $id);
    $getRating_sql->execute();
    $getRating_sql->store_result();

    if ($getRating_sql->num_rows) {
        $getRating_sql->bind_result($r1, $r2, $r3, $r4, $r5, $r6);
        $getRating_sql->fetch();
        if ($r1 !== null || $r2 !== null || $r3 !== null || $r4 !== null || $r5 !== null || $r6 !== null) {
            $reviewee = ['r1' => $r1, 'r2' => $r2, 'r3' => $r3, 'r4' => $r4, 'r5' => $r5, 'r6' => $r6];

            $getReview_sql = $conn->prepare("SELECT Review FROM Dorm.Rating WHERE Reviewee_ID = ?");
            $getReview_sql->bind_param("i", $id);
            $getReview_sql->execute();
            $getReview_sql->store_result();
            $reviews = array();

            if ($getReview_sql->num_rows > 0) {
                $getReview_sql->bind_result($rv);

                while ($getReview_sql->fetch()) {
                    if ($rv !== null)
                        $reviews[] = ['rv' => $rv];
                }
            }

            $getReview_sql->free_result();
            $getReview_sql->close();
        }
    }
    $getRating_sql->free_result();
    $getRating_sql->close();
} else {
    echo "未找到該用戶資料。";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>profile</title>
</head>


<body>
    <section class="upper-section">
        <div class="bar">
            <h2>Welcome to my profile</h2>

        </div>
        <div class="picture" style="
            <?php
            if (isset($user_data['photo'])) {
                $photo = $user_data['photo'];
                echo "background-image: url('data:image/" . $photo['photo_type'] . ";base64," . base64_encode($photo['photo_content']) . "');";
            }
            ?>">
        </div>
        <div class="icon">
            <ul>
                <li>
                    <a href="<?php echo $user_data['FB']; ?> " target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $user_data['IG']; ?>" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="mailto:<?php echo $user_data['Email']; ?>" target="_blank">
                        <svg fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"></path>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="tel:<?php echo $user_data['Phone']; ?>" target="_blank">
                        <svg fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"></path>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
    </section>


    <section class="lower-section">
        <div class="left-side">
            <h2><span class="head">姓 名  :  </span><span class="chinese"> <?php echo $user_data['Name']; ?></span></h2>
            <br>
            <h2><span class="head">性 別  :  </span><span class="chinese"> <?php echo $user_data['Sex']; ?></span></h2>
            <br>
            <h2><span class="head">科 系  :  </span><span class="chinese"> <?php echo $user_data['Department']; ?></span></h2>
            <br>
            <h2><span class="head">年 級  :  </span><span class="chinese"> <?php echo $user_data['Grade']; ?></span></h2>
            <br>
            <h2><span class="head">宿 舍  :  </span><span class="chinese"> <?php echo $user_data['Dorm']; ?></span></h2>
        </div>
        <div class="right-side">
            <h2<span class="ii">簡 介 . . . </span></h2>
            <div class="intro">
                <br>
                <?php echo $user_data['Intro']; ?>
            </div>
        </div>

    </section>

    <section class="rating-seciton">
        <?php if (!empty($reviewee)) : ?>
        <div class="d-flex flex-column">
            <div class="text-center">
                <h2>評分<h2>
            </div>
            <div class="d-flex flex-column container-fluid w-50">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p>衛生</p>
                        </div>
                        <div>
                            <p><?php echo $reviewee['r1']; ?></p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p>作息</p>
                        </div>
                        <div>
                            <p><?php echo $reviewee['r2']; ?></p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p>課業</p>
                        </div>
                        <div>
                            <p><?php echo $reviewee['r3']; ?></p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p>外貌</p>
                        </div>
                        <div>
                            <p><?php echo $reviewee['r4']; ?></p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p>人品</p>
                        </div>
                        <div>
                            <p><?php echo $reviewee['r5']; ?></p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p>財富</p>
                        </div>
                        <div>
                            <p><?php echo $reviewee['r6']; ?></p>
                        </div>
                    </div>
                    <br>
                    <?php if (!empty($reviews)) : ?>
                        <div>
                            <h2 class="text-center">評論</h2>
                            <table class="table table-bordered">
                                <tbody>
                                    <?php foreach ($reviews as $review) : ?>
                                        <tr>
                                            <td><?php echo $review['rv']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
            </div>
            <?php endif; ?>
                <?php else : ?>
                <?php endif; ?>
        </div>
    </section>
</body>

</html>

<style>
    body {
        margin: 0;
        background-color: #F0EBE3 !important;
        font-family: "Noto Serif TC", serif;
    }

    .upper-section {
        padding: 40px;
        height: 330px;
        background-color: #576F72;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .upper-section.bar {
        margin-right: auto;
    }

    .upper-section .picture {
        width: 350px;
        border-radius: 50%;
        aspect-ratio: 1 / 1;
        background-color: #F0EBE3;
        background-size: cover;
        background-position: center;
        margin-right: 25px;
    }

    .bar h2 {
        margin-top: -20px;
        margin-left: 170px;
        color: #F0EBE3;
        font-size: 3rem;
        letter-spacing: 3px;
    }

    .icon ul {
        position: relative;
        flex-direction: column;
        align-items: center;
        margin-right: 200px;
    }

    .icon ul li {
        list-style: none;
        margin: 18px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
    }

    .icon ul li a {
        color: #F0EBE3;
    }

    .icon ul li a:hover {
        color: #E4DCCF;
    }


    .lower-section {
        display: flex;
    }

    .lower-section .left-side, .right-side {
        flex: 1;
        font-size: 20px;
        margin-top: 70px;
    }

    .left-side .head , .ii{
        color: #576F72;
        margin-bottom: 20PX;
        font-weight: bold;
        font-size: 25px;
    }
    .left-side .head {
        margin-left: 400px;
    }

    .left-side .chinese {
        color: black;
        font-size: 20px;
    }
    .right-side {
        text-align: left;
        margin-left: 30px;
    }
    .right-side .intro {
        margin-left: 20px;
        margin-right: 200px;
        font-size: 20px;
        color:black;
        font-weight: normal;
    }
    .left-side {
        text-align: left;
    }
</style>