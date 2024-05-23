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
                        <button class="btn bg-success text-white btn-sm rounded-pill" style="width: 2rem; height: 2rem" data-bs-toggle="collapse" data-bs-target="#company1" aria-expanded="true" aria-controls="company1" onclick="stepFunction(event)">
                            1
                        </button>
                        <span class="bg-success w-25 rounded mt-auto mb-auto me-1 ms-1" style="height: 0.2rem">
                        </span>
                        <button class="btn bg-success text-white btn-sm rounded-pill" style="width: 2rem; height: 2rem" data-bs-toggle="collapse" data-bs-target="#company2" aria-expanded="false" aria-controls="company3" onclick="stepFunction(event)">
                            2
                        </button>
                        <span class="bg-success w-25 rounded mt-auto mb-auto me-1 ms-1" style="height: 0.2rem">
                        </span>
                        <button class="btn bg-success text-white btn-sm rounded-pill" style="width: 2rem; height: 2rem" data-bs-toggle="collapse" data-bs-target="#company3" aria-expanded="false" aria-controls="company3" onclick="stepFunction(event)">
                            3
                        </button>
                        <span class="bg-success w-25 rounded mt-auto mb-auto me-1 ms-1" style="height: 0.2rem">
                        </span>
                        <button class="btn bg-success text-white btn-sm rounded-pill" style="width: 2rem; height: 2rem" data-bs-toggle="collapse" data-bs-target="#company4" aria-expanded="false" aria-controls="company4" onclick="stepFunction(event)">
                            4
                        </button>
                    </div>
                </div>

                <div class="collapse show" id="company1">
                    <div class="display-4 text-center">檢舉的宿舍位於...</div>
                    <hr>
                    <div class="container-fluid p-5">
                        <div class="row">
                            <div class="col-md-2 text-center image-container">
                                <input type="hidden" name="imageChoice" value="1">
                                <img src="../pic/8.jpg" class="img-fluid rounded" onclick="submitForm(1)">
                                <h5 class="mt-2">8舍<h5>
                            </div>
                            <div class="col-md-2 text-center image-container">
                                <input type="hidden" name="imageChoice" value="2">
                                <img src="../pic/9.jpg" class="img-fluid rounded" onclick="submitForm(2)">
                                <h5 class="mt-2">9舍<h5>
                            </div>
                            <div class="col-md-2 text-center image-container">
                                <input type="hidden" name="imageChoice" value="3">
                                <img src="../pic/10.jpg" class="img-fluid rounded" onclick="submitForm(2)">
                                <h5 class="mt-2">10舍<h5>
                            </div>
                            <div class="col-md-2 text-center image-container">
                                <input type="hidden" name="imageChoice" value="2">
                                <img src="../pic/11.jpg" class="img-fluid rounded" onclick="submitForm(2)">
                                <h5 class="mt-2">11舍<h5>
                            </div>
                            <div class="col-md-2 text-center image-container">
                                <input type="hidden" name="imageChoice" value="2">
                                <img src="../pic/12.jpg" class="img-fluid rounded" onclick="submitForm(2)">
                                <h5 class="mt-2">12舍<h5>
                            </div>
                            <div class="col-md-2 text-center image-container">
                                <input type="hidden" name="imageChoice" value="2">
                                <img src="../pic/13.jpg" class="img-fluid rounded" onclick="submitForm(2)">
                                <h5 class="mt-2">13舍<h5>
                            </div>
                        </div>
                        <hr><br>
                        <div class="row">
                            <div class="col-md-2 text-center image-container">
                                <input type="hidden" name="imageChoice" value="1">
                                <img src="../pic/7.jpg" class="img-fluid rounded" onclick="submitForm(1)">
                                <h5 class="mt-2">7舍<h5>
                            </div>
                            <div class="col-md-2 text-center image-container">
                                <input type="hidden" name="imageChoice" value="2">
                                <img src="../pic/girl2.jpg" class="img-fluid rounded" onclick="submitForm(2)">
                                <h5 class="mt-2">女二舍<h5>
                            </div>
                            <div class="col-md-2 text-center image-container">
                                <input type="hidden" name="imageChoice" value="2">
                                <img src="../pic/xuan.jpg" class="img-fluid rounded" onclick="submitForm(2)">
                                <h5 class="mt-2">竹軒<h5>
                            </div>
                            <div class="col-md-2 text-center image-container">
                                <input type="hidden" name="imageChoice" value="2">
                                <img src="../pic/1+.jpg" class="img-fluid rounded" onclick="submitForm(2)">
                                <h5 class="mt-2">研一舍<h5>
                            </div>
                            <div class="col-md-2 text-center image-container">
                                <input type="hidden" name="imageChoice" value="2">
                                <img src="../pic/2+.jpg" class="img-fluid rounded" onclick="submitForm(2)">
                                <h5 class="mt-2">研二舍<h5>
                            </div>
                            <div class="col-md-2 text-center image-container">
                                <input type="hidden" name="imageChoice" value="2">
                                <img src="../pic/3+.png" class="img-fluid rounded" onclick="submitForm(2)">
                                <h5 class="mt-2">研三舍<h5>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="collapse" id="company2">
                    <div class="display-4">2</div>
                    <p>
                        2
                    </p>
                </div>
                <div class="collapse" id="company3">
                    <div class="display-4">3</div>
                    <p>
                        3
                    </p>
                </div>
                <div class="collapse" id="company4">
                    <div class="display-4">4</div>
                    <p>
                        4
                    </p>
                </div>
            </div>
        </div>
    </div>


    <script>
        // function myFunction() {
        //     var element = document.body;
        //     element.dataset.bsTheme =
        //         element.dataset.bsTheme == "light" ? "dark" : "light";
        // }

        function stepFunction(event) {
            debugger;
            var element = document.getElementsByClassName("collapse");
            for (var i = 0; i < element.length; i++) {
                if (element[i] !== event.target.ariaControls) {
                    element[i].classList.remove("show");
                }
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>