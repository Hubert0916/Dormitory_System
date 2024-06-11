<?php
require_once dirname(__FILE__) . "/overlay_nav.php";
require_once dirname(__FILE__) . '/session.php';
require_once dirname(__FILE__) . '/connection.php';

if (isset($_SESSION['ID'])) {

    $id = intval($_SESSION['ID']);
    $getRoommate_sql = $conn->prepare("SELECT pr.ID, pr.Name, ph.photo_type, ph.photo_content FROM Dorm.Profile as pr, Dorm.photo as ph WHERE pr.ID = ph.id and pr.id != ? and pr.Room = (SELECT p.Room from Dorm.Profile as p WHERE p.ID = ?) and pr.Dorm = (SELECT p.Dorm from Dorm.Profile as p WHERE p.ID = ?)");
    $getRoommate_sql->bind_param("iii", $id, $id, $id);
    $getRoommate_sql->execute();
    $getRoommate_sql->store_result();

    if ($getRoommate_sql->num_rows() > 0) {
        $getRoommate_sql->bind_result($RID, $Rname, $Rtype, $Rphoto);

        $roommates = [];

        while ($getRoommate_sql->fetch()) {
            $roommates[] = ['RID' => $RID, 'Rname' => $Rname, 'Rtype' => $Rtype, 'Rphoto' => base64_encode($Rphoto)];
        }
    }
    $getRoommate_sql->close();
} else {
    echo "<script>alert('請先登入');</script>";
    echo "<script>window.location.href = 'login.php';</script>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Dorm = htmlspecialchars($_POST["imageChoice"]);

    if (isset($_POST["room"])) {
        $Room = $_POST["room"];
    } else if (!empty($_POST["chooserm"])) {
        $RoommateID = htmlspecialchars($_POST["chooserm"]);
        $Room = htmlspecialchars($_SESSION["room"]);
    }

    $Reason = htmlspecialchars($_POST["Radios"]);

    $other = htmlspecialchars($_POST["txtcomment_a"] . $_POST["txtcomment_a"] . $_POST["txtcomment_c"]);

    if (isset($RoommateID)) {
        $report_sql = $conn->prepare("INSERT INTO Dorm.Report (Dormitory, Room, Roommate_ID, Reason, Note)  VALUES (?, ?, ?, ?, ?)");
        $report_sql->bind_param("ssiss", $Dorm, $Room, $RoommateID, $Reason, $other);
    } else if (isset($Room)) {

        $report_sql = $conn->prepare("INSERT INTO Dorm.Report (Dormitory, Room, Reason, Note)  VALUES (?, ?, ?, ?)");
        $report_sql->bind_param("ssss", $Dorm, $Room, $Reason, $other);
    } else {
        $report_sql = $conn->prepare("INSERT INTO Dorm.Report (Dormitory, Reason, Note)  VALUES (?, ?, ?)");
        $report_sql->bind_param("sss", $Dorm, $Reason, $other);
    }

    if (!$report_sql->execute()) {
        echo "Error: " . $report_sql->error;
    }
    $report_sql->free_result();
    $report_sql->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Report System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/report.css">
</head>

<body>


    <form id="reportForm" method="post" action="report.php" onsubmit="Message(event)">
        <div class="container-fluid mx-3 my-5">
            <div class="step" id="step1">
                <div class="text-center">
                    <h2>檢舉的宿舍位於...<h2>
                </div>
                <br>
                <div class="container-fluid">
                    <input type="hidden" name="imageChoice" id="imageChoice">
                    <div class="row justify-content-center">
                        <div class="col-md-3 text-center block-container">
                            <div class="rect-block d-flex flex-column" onclick="submitStep1('8舍')">
                                <img src="../pic/8.jpg" class="img-fluid rounded">
                                <h5 class="mt-2">8舍</h5>
                            </div>
                        </div>
                        <div class="col-md-3 text-center block-container">
                            <div class="rect-block d-flex flex-column" onclick="submitStep1('9舍')">
                                <img src="../pic/9.jpg" class="img-fluid rounded">
                                <h5 class="mt-2">9舍</h5>
                            </div>
                        </div>
                        <div class="col-md-3 text-center block-container">
                            <div class="rect-block d-flex flex-column" onclick="submitStep1('10舍')">
                                <img src="../pic/10.jpg" class="img-fluid rounded">
                                <h5 class="mt-2">10舍</h5>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row justify-content-center">
                        <div class="col-md-3 text-center block-container">
                            <div class="rect-block d-flex flex-column" onclick="submitStep1('11舍')">
                                <img src="../pic/11.jpg" class="img-fluid rounded">
                                <h5 class="mt-2">11舍</h5>
                            </div>
                        </div>
                        <div class="col-md-3 text-center block-container">
                            <div class="rect-block d-flex flex-column" onclick="submitStep1('12舍')">
                                <img src="../pic/12.jpg" class="img-fluid rounded">
                                <h5 class="mt-2">12舍</h5>
                            </div>
                        </div>
                        <div class="col-md-3 text-center block-container">
                            <div class="rect-block d-flex flex-column" onclick="submitStep1('13舍')">
                                <img src="../pic/13.jpg" class="img-fluid rounded">
                                <h5 class="mt-2">13舍</h5>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row justify-content-center">
                        <div class="col-md-3 text-center block-container">
                            <div class="rect-block d-flex flex-column" onclick="submitStep1('7舍')">
                                <img src="../pic/7.jpg" class="img-fluid rounded">
                                <h5 class="mt-2">7舍</h5>
                            </div>
                        </div>
                        <div class="col-md-3 text-center block-container">
                            <div class="rect-block d-flex flex-column" onclick="submitStep1('女二舍')">
                                <img src="../pic/girl2.jpg" class="img-fluid rounded">
                                <h5 class="mt-2">女二舍</h5>
                            </div>
                        </div>
                        <div class="col-md-3 text-center block-container">
                            <div class="rect-block d-flex flex-column" onclick="submitStep1('竹軒')">
                                <img src="../pic/xuan.jpg" class="img-fluid rounded">
                                <h5 class="mt-2">竹軒</h5>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row justify-content-center">
                        <div class="col-md-3 text-center block-container">
                            <div class="rect-block d-flex flex-column" onclick="submitStep1('研一舍')">
                                <img src="../pic/1+.jpg" class="img-fluid rounded">
                                <h5 class="mt-2">研一舍</h5>
                            </div>
                        </div>
                        <div class="col-md-3 text-center block-container">
                            <div class="rect-block d-flex flex-column" onclick="submitStep1('研二舍')">
                                <img src="../pic/2+.jpg" class="img-fluid rounded">
                                <h5 class="mt-2">研二舍</h5>
                            </div>
                        </div>
                        <div class="col-md-3 text-center block-container">
                            <div class="rect-block d-flex flex-column" onclick="submitStep1('研三舍')">
                                <img src="../pic/3+.png" class="img-fluid rounded">
                                <h5 class="mt-2">研三舍</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mx-3 my-5">
            <div class="step d-none" id="step2">
                <div class="text-center">
                    <h2>你要檢舉的對象...<h2>
                </div>
                <br>
                <div class="container-fluid">
                    <div class="row ms-5">
                        <input type="hidden" name="blockChoice">
                        <div class="col-md-4 text-center block-container">
                            <div class="rect-block d-flex flex-column align-items-center" onclick="submitStep2('a');">
                                <div class="my-3">
                                    <i class="bi bi-person-x-fill icon fa-9x"></i>
                                </div>
                                <div>
                                    <h3>不知道</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center block-container">
                            <div class="rect-block d-flex flex-column align-items-center" onclick="submitStep2('b'); inputRoom();">
                                <div class="my-3">
                                    <i class="bi bi-door-closed icon fa-9x"></i>
                                </div>
                                <div>
                                    <h3>房號</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center block-container">
                            <div class="rect-block d-flex flex-column align-items-center" onclick="submitStep2('c'); reportRoommate();">
                                <div class="my-3">
                                    <i class="bi bi-person-raised-hand icon fa-9x"></i>
                                </div>
                                <div>
                                    <h3>室友</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-5">
                        <button type="button" class="btn btn-previous" onclick="backtoStep1('b');"><i class="bi bi-arrow-left"></i>上一步</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid mx-3 my-5">
            <div class="step d-none" id="step3b">
                <div class="text-center">
                    <h2>房號...<h2>
                </div>
                <br>

                <div class="d-flex flex-column align-items-center">
                    <input class="w-75 mb-4 mx-5" type="text" name="room" id="room" placeholder="e.g., 501" disabled>
                    <div class="text-center d-inline-block">
                        <button type="button" class="btn btn-previous me-2" onclick="back3btoStep2();"><i class="bi bi-arrow-left"></i>上一步</button>
                        <button type="button" class="btn btn-next ms-2" onclick="submitStep3('b');">下一步<i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid mx-3 my-5">
            <div class="step d-felx flex-column d-none" id="step3c">
                <div class="container-fluid text-center">
                    <h2>哪個室友...<h2>
                </div>
                <br>
                <div class="container-fluid">
                    <input type="hidden" id="chooserm" name="chooserm" disabled>
                    <?php if (!empty($roommates)) : ?>
                        <div class="row mx-5">
                            <?php foreach ($roommates as $roommate) : ?>
                                <div class="col-md-4">
                                    <div class="rect-block d-flex flex-column justify-content-center mx-5" onclick="submitStep3('c', '<?php echo $roommate['RID']; ?>');">
                                        <img class="fixed-size" src="data:<?php echo $roommate['Rtype']; ?>;base64,<?php echo $roommate['Rphoto']; ?>">
                                        <br>
                                        <p><?php echo "ID : " . $roommate['RID']; ?></p>
                                        <p><?php echo "Name : " . $roommate['Rname']; ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <div class="text-center">
                            <h3>查無室友資料!!!</h3>
                        </div>
                    <?php endif; ?>
                    <div class="text-center mt-5">
                        <button type="button" class="btn btn-previous" onclick="back3ctoStep2();"><i class="bi bi-arrow-left"></i>上一步</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mx-3 my-5">
            <div class="step d-none" id="step4a">
                <div class="text-center">
                    <h2>檢舉緣由...<h2>
                </div>
                <hr>
                <div class="container-fluid">
                    <div class="form-group px-5">
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption1">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption1" value="吵" required>
                                未保持宿舍安寧影響他人者
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption2">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption2" value="髒" required>
                                未能保持宿舍內外清潔
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption3">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption3" value="抽菸" required>
                                宿舍內外十公尺內吸菸
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption4">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption4" value="亂堆" required>
                                公共區域堆放私人物品者
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption5">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption5" value="電器" required>
                                寢室內使用或置放有安全堪慮電器用品(電磁爐、電熨斗、微波爐等)
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption6">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption6" value="毀損" required>
                                故意毀損宿舍
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption7">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption7" value="異性" required>
                                偷帶異性回去
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption8">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption8" value="賭博" required>
                                宿舍內賭博等類似型態行為
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption9">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption9" value="怪人" required>
                                有陌生怪人遊蕩
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption10">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption10" value="住宿權" required>
                                刊登買賣床位及住宿權頂讓訊息
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption11">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption11" value="其他" required>
                                其他
                            </label>
                        </div>
                        <div class="py-2">
                            <textarea id="a" class="form-control" name="txtcomment_a" rows="4" placeholder="其他..."></textarea>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="button" class="btn btn-previous w-30 mt-2" onclick="back4atoStep2();"><i class="bi bi-arrow-left"></i>上一步</button>
                        <button type="submit" class="btn btn-primary w-30 mt-2">提交</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mx-3 my-5">
            <div class="step d-none" id="step4b">
                <div class="text-center">
                    <h2>檢舉緣由...<h2>
                </div>
                <hr>
                <div class="container-fluid">
                    <div class="form-group px-5">
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption1b">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption1b" value="吵" required>
                                未保持宿舍安寧影響他人者
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption2b">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption2b" value="髒" required>
                                未能保持宿舍內外清潔
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption3b">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption3b" value="抽菸" required>
                                宿舍內外十公尺內吸菸
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption4b">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption4b" value="亂堆" required>
                                公共區域堆放私人物品者
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption5b">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption5b" value="電器" required>
                                寢室內使用或置放有安全堪慮電器用品(電磁爐、電熨斗、微波爐等)
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption6b">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption6b" value="毀損" required>
                                故意毀損宿舍
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption7b">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption7b" value="異性" required>
                                偷帶異性回去
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption8b">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption8b" value="賭博" required>
                                宿舍內賭博等類似型態行為
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption9b">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption9b" value="怪人" required>
                                有陌生怪人遊蕩
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption10b">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption10b" value="住宿權" required>
                                刊登買賣床位及住宿權頂讓訊息
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption11b">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption11b" value="其他" required>
                                其他
                            </label>
                        </div>
                        <div class="py-2">
                            <textarea id="b" class="form-control" name="txtcomment_b" rows="4" placeholder="其他..."></textarea>
                        </div>
                    </div>
                    <button type="button" class="btn btn-previous w-100 mt-3" onclick="back4btoStep3b();"><i class="bi bi-arrow-left"></i>上一步</button>
                    <button type="submit" class="btn btn-primary w-100 mt-2">提交</button>
                </div>
            </div>
        </div>
        <div class="container-fluid mx-3 my-5">
            <div class="step d-none" id="step4c">
                <div class="text-center">
                    <h2>檢舉緣由...<h2>
                </div>
                <hr>
                <div class="container-fluid">
                    <div class="form-group px-5">
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption1c">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption1c" value="吵" required>
                                未保持宿舍安寧影響他人者
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption2c">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption2c" value="髒" required>
                                未能保持宿舍內外清潔
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption3c">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption3c" value="抽菸" required>
                                宿舍內外十公尺內吸菸
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption4c">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption4c" value="亂堆" required>
                                公共區域堆放私人物品者
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption5c">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption5c" value="電器" required>
                                寢室內使用或置放有安全堪慮電器用品(電磁爐、電熨斗、微波爐等)
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption6c">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption6c" value="毀損" required>
                                故意毀損宿舍
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption7c">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption7c" value="異性" required>
                                偷帶異性回去
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption8c">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption8c" value="賭博" required>
                                宿舍內賭博等類似型態行為
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption9c">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption9c" value="怪人" required>
                                有陌生怪人遊蕩
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption10c">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption10c" value="住宿權" required>
                                刊登買賣床位及住宿權頂讓訊息
                            </label>
                        </div>
                        <div class="form-check py-2">
                            <label class="form-check-label" for="radioOption11c">
                                <input class="form-check-input" type="radio" name="Radios" id="radioOption11c" value="其他" required>
                                其他
                            </label>
                        </div>
                        <div class="py-2">
                            <textarea id="c" class="form-control" name="txtcomment_c" rows="4" placeholder="其他..."></textarea>
                        </div>

                    </div>
                    <button type="button" class="btn btn-previous w-100 mt-3" onclick="back4ctoStep3c();"><i class="bi bi-arrow-left"></i>上一步</button>
                    <button type="submit" class="btn btn-primary w-100 mt-2">提交</button>
                </div>
            </div>
        </div>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/report.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>