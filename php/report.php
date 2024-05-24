<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/report.css">
</head>

<body data-bs-theme="light">
    <?php include "overlay_nav.php"; ?>
    <!-- <div class="form-check form-switch mx-4">
        <input class="form-check-input p-2" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked onclick="myFunction()" />
    </div> -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid p-5 align-items-center">
                    <div class="d-flex justify-content-around">
                        <div class="bg-success text-white rounded-pill cir" id="cir1" style="width: 2rem; height: 2rem">
                            1
                        </div>
                        <span class="bg-secondary w-25 rounded mt-auto mb-auto me-1 ms-1" id="line1" style="height: 0.2rem">
                        </span>
                        <div class="bg-secondary text-white rounded-pill cir" id="cir2" style="width: 2rem; height: 2rem">
                            2
                        </div>
                        <span class="bg-secondary w-25 rounded mt-auto mb-auto me-1 ms-1" id="line2" style="height: 0.2rem">
                        </span>
                        <div class="bg-secondary text-white rounded-pill cir" id="cir3" style="width: 2rem; height: 2rem">
                            3
                        </div>
                        <span class="bg-secondary w-25 rounded mt-auto mb-auto me-1 ms-1" id="line3" style="height: 0.2rem">
                        </span>
                        <div class="bg-secondary text-white rounded-pill cir" id="cir4" style="width: 2rem; height: 2rem">
                            4
                        </div>
                    </div>
                </div>

                <form id="imageForm" method="post">
                    <div class="step" id="step1">
                        <div class="text-center">
                            <h2>檢舉的宿舍位於...<h2>
                        </div>
                        <hr>
                        <div class="container-fluid p-5">
                            <div class="row">
                                <div class="col-md-2 text-center image-container">
                                    <input type="hidden" name="imageChoice" value="1">
                                    <img src="../pic/8.jpg" class="img-fluid rounded" onclick="submitStep1('8舍')">
                                    <h5 class="mt-2">8舍<h5>
                                </div>
                                <div class="col-md-2 text-center image-container">
                                    <input type="hidden" name="imageChoice" value="2">
                                    <img src="../pic/9.jpg" class="img-fluid rounded" onclick="submitStep1('9舍')">
                                    <h5 class="mt-2">9舍<h5>
                                </div>
                                <div class="col-md-2 text-center image-container">
                                    <input type="hidden" name="imageChoice" value="3">
                                    <img src="../pic/10.jpg" class="img-fluid rounded" onclick="submitStep1('10舍')">
                                    <h5 class="mt-2">10舍<h5>
                                </div>
                                <div class="col-md-2 text-center image-container">
                                    <input type="hidden" name="imageChoice" value="2">
                                    <img src="../pic/11.jpg" class="img-fluid rounded" onclick="submitStep1('11舍')">
                                    <h5 class="mt-2">11舍<h5>
                                </div>
                                <div class="col-md-2 text-center image-container">
                                    <input type="hidden" name="imageChoice" value="2">
                                    <img src="../pic/12.jpg" class="img-fluid rounded" onclick="submitStep1('12舍')">
                                    <h5 class="mt-2">12舍<h5>
                                </div>
                                <div class="col-md-2 text-center image-container">
                                    <input type="hidden" name="imageChoice" value="2">
                                    <img src="../pic/13.jpg" class="img-fluid rounded" onclick="submitStep1('13舍')">
                                    <h5 class="mt-2">13舍<h5>
                                </div>
                            </div>
                            <hr><br>
                            <div class="row">
                                <div class="col-md-2 text-center image-container">
                                    <input type="hidden" name="imageChoice" value="1">
                                    <img src="../pic/7.jpg" class="img-fluid rounded" onclick="submitStep1('7舍')">
                                    <h5 class="mt-2">7舍<h5>
                                </div>
                                <div class="col-md-2 text-center image-container">
                                    <input type="hidden" name="imageChoice" value="2">
                                    <img src="../pic/girl2.jpg" class="img-fluid rounded" onclick="submitStep1('女二舍')">
                                    <h5 class="mt-2">女二舍<h5>
                                </div>
                                <div class="col-md-2 text-center image-container">
                                    <input type="hidden" name="imageChoice" value="2">
                                    <img src="../pic/xuan.jpg" class="img-fluid rounded" onclick="submitStep1('竹軒')">
                                    <h5 class="mt-2">竹軒<h5>
                                </div>
                                <div class="col-md-2 text-center image-container">
                                    <input type="hidden" name="imageChoice" value="2">
                                    <img src="../pic/1+.jpg" class="img-fluid rounded" onclick="submitStep1('研一舍')">
                                    <h5 class="mt-2">研一舍<h5>
                                </div>
                                <div class="col-md-2 text-center image-container">
                                    <input type="hidden" name="imageChoice" value="2">
                                    <img src="../pic/2+.jpg" class="img-fluid rounded" onclick="submitStep1('研二舍')">
                                    <h5 class="mt-2">研二舍<h5>
                                </div>
                                <div class="col-md-2 text-center image-container">
                                    <input type="hidden" name="imageChoice" value="2">
                                    <img src="../pic/3+.png" class="img-fluid rounded" onclick="submitStep1('研三舍')">
                                    <h5 class="mt-2">研三舍<h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="step d-none" id="step2">
                        <div class="text-center">
                            <div class="text-center">
                                <h2>你要檢舉的對象...<h2>
                            </div>
                        </div>
                        <hr>
                        <div class="container-fluid p-5">
                            <div class="row ms-5">
                                <div class="col-md-4 text-center block-container">
                                    <input type="hidden" name="blockChoice" value="1">
                                    <div class="rect-block" onclick="submitStep2('1')">
                                        block
                                    </div>
                                </div>
                                <div class="col-md-4 text-center block-container">
                                    <input type="hidden" name="blockChoice" value="2">
                                    <div class="rect-block" onclick="submitStep2('2')">
                                        block
                                    </div>
                                </div>
                                <div class="col-md-4 text-center block-container">
                                    <input type="hidden" name="blockChoice" value="3">
                                    <div class="rect-block" onclick="submitStep2('3')">
                                        block
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="step d-none" id="step3">
                        <div class="text-center">
                            <div class="text-center">
                                <h2>緣由...<h2>
                            </div>
                        </div>
                        <hr>
                        <div class="container-fluid p-5">
                            <div class="row ms-5">
                                <div class="col-md-4 text-center block-container">
                                    <input type="hidden" name="blockChoice" value="1">
                                    <div class="rect-block" onclick="submitStep2('1')">
                                        block
                                    </div>
                                </div>
                                <div class="col-md-4 text-center block-container">
                                    <input type="hidden" name="blockChoice" value="2">
                                    <div class="rect-block" onclick="submitStep2('2')">
                                        block
                                    </div>
                                </div>
                                <div class="col-md-4 text-center block-container">
                                    <input type="hidden" name="blockChoice" value="3">
                                    <div class="rect-block" onclick="submitStep2('3')">
                                        block
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>


        <script>
            // function myFunction() {
            //     var element = document.body;
            //     element.dataset.bsTheme =
            //         element.dataset.bsTheme == "light" ? "dark" : "light";
            // }

            // function stepFunction(event) {
            //     debugger;
            //     var element = document.getElementsByClassName("collapse");
            //     for (var i = 0; i < element.length; i++) {
            //         if (element[i] !== event.target.ariaControls) {
            //             element[i].classList.remove("show");
            //         }
            //     }
            // }
        </script>
        <script src="../js/clickImgSubmit.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>