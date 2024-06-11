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
    } else if (isset($_POST["chooserm"]) && !empty($_POST['chooserm'])) {
        $RoommateID = htmlspecialchars($_POST["chooserm"]);
        $Room = htmlspecialchars($_SESSION["room"]);
    } else if (isset($_POST["reportID"]) && !empty($_POST['reportID'])) {
        $RoommateID = htmlspecialchars($_POST["reportID"]);
        $Room = htmlspecialchars($_SESSION["room"]);
    }

    $Reason = htmlspecialchars($_POST["Radios"]);

    if (isset($_POST["other"])) {
        $other = htmlspecialchars($_POST["other"]);
    }

    $report_sql = $conn->prepare("INSERT INTO Dorm.Report (Dormitory, Room, Roommate_ID, Reason, Note)  VALUES (?, ?, ?, ?, ?)");
    $report_sql->bind_param("ssiss", $Dorm, $Room, $RoommateID, $Reason, $other);

    if (!$report_sql->execute()) {
        echo "Error: " . $report_sql->error;
    }
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
    <div class="container-fluid mx-3 mt-5">
        <div class="row">
            <div class="col-md-12">

                <form id="reportForm" method="post" action="report.php" onsubmit="Message(event)">
                    <div class="step" id="step1">
                        <div class="text-center mb-3">
                            <h2>檢舉的宿舍位於...<h2>
                        </div>
                        <hr>
                        <div class="container-fluid p-5">
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

                    <div class="step d-none" id="step2">
                        <div class="text-center">
                            <h2>你要檢舉的對象...<h2>
                        </div>
                        <hr>
                        <div class="container-fluid p-5">
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

                    <div class="step d-none" id="step3b">
                        <div class="text-center">
                            <h2>房號...<h2>
                        </div>
                        <hr>

                        <div class="d-flex flex-column align-items-center">
                            <input class="w-75 mb-4 mx-5" type="text" name="room" id="room" placeholder="e.g., 501" disabled>
                            <div class="text-center d-inline-block">
                                <button type="button" class="btn btn-previous me-2" onclick="back3btoStep2();"><i class="bi bi-arrow-left"></i>上一步</button>
                                <button type="button" class="btn btn-next ms-2" onclick="submitStep3('b');">下一步<i class="bi bi-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="step d-none" id="step3c">
                        <div class="text-center">
                            <h2>哪個室友...<h2>
                        </div>
                        <hr>
                        <div class="container-fluid p-5">
                            <input type="hidden" id="chooserm" name="chooserm" disabled>
                            <?php if (!empty($roommates)) : ?>
                                <script>
                                    document.getElementById('chooserm').disabled = false;
                                </script>
                                <div class="row ms-5">
                                    <div class="col-md-12 justify-content-center">
                                        <div class="d-flex justify-content-center">
                                            <?php foreach ($roommates as $roommate) : ?>
                                                <div class="col-md-4 text-center" onclick=" submitStep3('c', '<?php echo $roommate['RID']; ?>');">
                                                    <div class="rect-block d-flex flex-column">
                                                        <img class="fixed-size" src="data:<?php echo $roommate['Rtype']; ?>;base64,<?php echo $roommate['Rphoto']; ?>">
                                                        <br>
                                                        <p><?php echo "ID : " . $roommate['RID']; ?></p>
                                                        <p><?php echo "Name : " . $roommate['Rname']; ?></p>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-5">
                                    <button type="button" class="btn btn-previous" onclick="back3ctoStep2();"><i class="bi bi-arrow-left"></i>上一步</button>
                                </div>
                            <?php else : ?>
                                <div class="d-flex flex-column align-items-center">
                                    <input class="reportID-input w-75 mb-5 mx-5" type="text" name="reportID" id="reportID" placeholder="學號 e.g., 111705001" required>
                                    <div class="text-center d-inline-block">
                                        <button type="button" class="btn btn-previous me-2" onclick="back3ctoStep2();"><i class="bi bi-arrow-left"></i>上一步</button>
                                        <button type="button" class="btn btn-next ms-2" onclick="submitStep3('c', -1);">下一步</button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="step d-none" id="step4a">
                        <div class="text-center">
                            <h2>檢舉緣由...<h2>
                        </div>
                        <hr>
                        <div class="container-fluid px-5">
                            <div class="form-group ms-3">
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption1" value="吵" required>
                                    <label class="form-check-label" for="radioOption1">
                                        未保持宿舍安寧影響他人者
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption2" value="髒" required>
                                    <label class="form-check-label" for="radioOption2">
                                        未能保持宿舍內外清潔
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption3" value="抽菸" required>
                                    <label class="form-check-label" for="radioOption3">
                                        宿舍內外十公尺內吸菸
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption4" value="亂堆" required>
                                    <label class="form-check-label" for="radioOption4">
                                        公共區域堆放私人物品者
                                    </label>
                                </div>

                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption5" value="電器" required>
                                    <label class="form-check-label" for="radioOption5">
                                        寢室內使用或置放有安全堪慮電器用品(電磁爐、電熨斗、微波爐等)
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption6" value="毀損" required>
                                    <label class="form-check-label" for="radioOption6">
                                        故意毀損宿舍
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption7" value="異性" required>
                                    <label class="form-check-label" for="radioOption7">
                                        偷帶異性回去
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption8" value="賭博" required>
                                    <label class="form-check-label" for="radioOption8">
                                        宿舍內賭博等類似型態行為
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption9" value="怪人" required>
                                    <label class="form-check-label" for="radioOption9">
                                        有陌生怪人遊蕩
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption10" value="住宿權" required>
                                    <label class="form-check-label" for="radioOption10">
                                        刊登買賣床位及住宿權頂讓訊息
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption11" value="other" required>
                                    <label class="form-check-label" for="radioOption11">
                                        其他
                                    </label>
                                    <input type="text" class="form-control mt-1" id="other" name="other" placeholder="請輸入其他選項" disabled>
                                </div>
                            </div>
                            <button type="button" class="btn btn-previous w-100 mt-5" onclick="back4atoStep2();"><i class="bi bi-arrow-left"></i>上一步</button>
                            <button type="submit" class="btn btn-primary w-100">提交</button>
                        </div>
                    </div>

                    <div class="step d-none" id="step4b">
                        <div class="text-center">
                            <h2>檢舉緣由...<h2>
                        </div>
                        <hr>
                        <div class="container-fluid px-5">
                            <div class="form-group ms-3">
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption1" value="吵" required>
                                    <label class="form-check-label" for="radioOption1">
                                        未保持宿舍安寧影響他人者
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption2" value="髒" required>
                                    <label class="form-check-label" for="radioOption2">
                                        未能保持宿舍內外清潔
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption3" value="抽菸" required>
                                    <label class="form-check-label" for="radioOption3">
                                        宿舍內外十公尺內吸菸
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption4" value="亂堆" required>
                                    <label class="form-check-label" for="radioOption4">
                                        公共區域堆放私人物品者
                                    </label>
                                </div>

                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption5" value="電器" required>
                                    <label class="form-check-label" for="radioOption5">
                                        寢室內使用或置放有安全堪慮電器用品(電磁爐、電熨斗、微波爐等)
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption6" value="毀損" required>
                                    <label class="form-check-label" for="radioOption6">
                                        故意毀損宿舍
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption7" value="異性" required>
                                    <label class="form-check-label" for="radioOption7">
                                        偷帶異性回去
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption8" value="賭博" required>
                                    <label class="form-check-label" for="radioOption8">
                                        宿舍內賭博等類似型態行為
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption9" value="怪人" required>
                                    <label class="form-check-label" for="radioOption9">
                                        有陌生怪人遊蕩
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption10" value="住宿權" required>
                                    <label class="form-check-label" for="radioOption10">
                                        刊登買賣床位及住宿權頂讓訊息
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption11" value="other" required>
                                    <label class="form-check-label" for="radioOption11">
                                        其他
                                    </label>
                                    <input type="text" class="form-control mt-1" id="other" name="other" placeholder="請輸入其他選項" disabled>
                                </div>
                            </div>
                            <button type="button" class="btn btn-previous w-100 mt-5" onclick="back4btoStep3b();"><i class="bi bi-arrow-left"></i>上一步</button>
                            <button type="submit" class="btn btn-primary w-100">提交</button>
                        </div>
                    </div>

                    <div class="step d-none" id="step4c">
                        <div class="text-center">
                            <h2>檢舉緣由...<h2>
                        </div>
                        <hr>
                        <div class="container-fluid px-5">
                            <div class="form-group ms-3">
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption1" value="吵" required>
                                    <label class="form-check-label" for="radioOption1">
                                        未保持宿舍安寧影響他人者
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption2" value="髒" required>
                                    <label class="form-check-label" for="radioOption2">
                                        未能保持宿舍內外清潔
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption3" value="抽菸" required>
                                    <label class="form-check-label" for="radioOption3">
                                        宿舍內外十公尺內吸菸
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption4" value="亂堆" required>
                                    <label class="form-check-label" for="radioOption4">
                                        公共區域堆放私人物品者
                                    </label>
                                </div>

                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption5" value="電器" required>
                                    <label class="form-check-label" for="radioOption5">
                                        寢室內使用或置放有安全堪慮電器用品(電磁爐、電熨斗、微波爐等)
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption6" value="毀損" required>
                                    <label class="form-check-label" for="radioOption6">
                                        故意毀損宿舍
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption7" value="異性" required>
                                    <label class="form-check-label" for="radioOption7">
                                        偷帶異性回去
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption8" value="賭博" required>
                                    <label class="form-check-label" for="radioOption8">
                                        宿舍內賭博等類似型態行為
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption9" value="怪人" required>
                                    <label class="form-check-label" for="radioOption9">
                                        有陌生怪人遊蕩
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption10" value="住宿權" required>
                                    <label class="form-check-label" for="radioOption10">
                                        刊登買賣床位及住宿權頂讓訊息
                                    </label>
                                </div>
                                <div class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="Radios" id="radioOption11" value="other" required>
                                    <label class="form-check-label" for="radioOption11">
                                        其他
                                    </label>
                                    <input type="text" class="form-control mt-1" id="other" name="other" placeholder="請輸入其他選項" disabled>
                                </div>
                            </div>
                            <button type="button" class="btn btn-previous w-100 mt-5" onclick="back4ctoStep3c();"><i class="bi bi-arrow-left"></i>上一步</button>
                            <button type="submit" class="btn btn-primary w-100">提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function Message() {
                event.preventDefault();
                Swal.fire({
                    icon: 'success',
                    title: '恭喜! 舉報成功',
                    text: '謝謝伸張宿舍正義!',
                    confirmButtonText: "OK",
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('reportForm').submit();
                    }
                })
            };
        </script>

        <script src="../js/report.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>