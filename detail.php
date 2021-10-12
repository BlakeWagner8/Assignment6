<?php
	//functions.php contains all functions used
	require_once('functions.php');
    $i = $_GET['index'];
	$student = $students[$i];
?>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
    integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
<link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">

<body>
    <link rel="stylesheet" href="assets/css/detail.css" />
    <title>ASE 230 - <?= $student['name'] ?></title>
    <a href="./index.php" style="text-decoration: none;">
        <button class="btn pull-left back-btn">
            <span class="material-icons">arrow_back_ios</span>
            <span>Back</span>
        </button>
    </a>
    <div class="container text-center mb-5">
        <h1>This is ASE230 - <?= $student['name'] ?></h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <div class="mb-2">
                    <img class="w-100" src="<?= $student['profile_pic'] ?>" alt="">
                </div>
                <div class="mb-2 d-flex">
                    <h4 class="font-weight-normal">
                        <?= $student['name'] ?>
                    </h4>
                    <div class="social d-flex ml-auto">
                        <p class="pr-2 font-weight-normal">Follow on:</p>
                        <a href="<?= $student['facebook'] ?>" class="text-muted mr-1" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="<?= $student['twitter'] ?>" class="text-muted mr-1" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="<?= $student['instagram'] ?>" class="text-muted mr-1" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="<?= $student['linkedin'] ?>" class="text-muted" target="_blank">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>
                <div class="mb-2">
                    <ul class="list-unstyled">
                        <li class="media">
                            <span class="w-30 text-black font-weight-normal">Age: </span>
                            <label class="media-body">
                                <?= dateDiff($student["dob"]) ?>
                            </label>
                        </li>
                        <li class="media">
                            <span class="w-30 text-black font-weight-normal">Since was born: </span>
                            <label class="media-body">
                                <?= dateDiff($student["dob"], false) ?>
                            </label>
                        </li>
                        <li class="media">
                            <span class="w-30 text-black font-weight-normal">Dream
                                profession: </span>
                            <label class="media-body">
                                <?= $student['dream_profession'] ?>
                            </label>
                        </li>
                        <li class="media">
                            <span class="w-30 text-black font-weight-normal">Dream company: </span>
                            <label class="media-body">
                                <?= $student['dream_company'] ?>
                            </label>
                        </li>
                        <li class="media">
                            <span class="w-30 text-black font-weight-normal">Email: </span>
                            <label class="media-body">
                                <?= $student['email'] ?>
                            </label>
                        </li>
                        <br>
                        <a
                            href="modify.php?index=<?= $i ?>&name=Ron%20Tishma&school_year=4&dob=1997-08-12&major=Political%20Science%20%26%20Philosophy%20%26%20Spanish">
                            <button class="btn btn-warning" style="margin: 5px 0 5px 5px"><span
                                    class="material-icons" style="font-size: 16px">edit</span> Edit</button>
                        </a>
                        <a href="delete.php?index=<?= $i ?>">
                            <button class="btn btn-danger" style="margin: 5px 0 5px 5px"><span
                                    class="material-icons" style="font-size: 16px">delete</span> Remove</button>
                        </a>
                    </ul>
                </div>
            </div>
            <div class="col-lg-7 col-md-6 pl-xl-3">
                <h5 class="font-weight-normal">Short intro</h5>
                <p><?= $student['short_intro'] ?></p>
                <div class="my-2 bg-light p-2">
                    <p class="font-italic mb-0">
                        <?= $student['goal'] ?>
                    </p>
                </div>
                <div class="mb-2 mt-2 pt-1">
                    <h5 class="font-weight-normal">Top skills</h5>
                </div>
                <?php
					for ($i = 0; $i < count($student['skills']); $i++) { ?>
                <div class="py-1">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width:<?= $student['skills'][$i][1]?>%"
                            aria-valuenow="<?= $student['skills'][$i][1]?>" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar-title"><?= $student['skills'][$i][0]?></div>
                            <span class="progress-bar-number"><?= $student['skills'][$i][1]?>%</span>
                        </div>
                    </div>
                </div>
                <?php
					}
				?>
                <h5 class="font-weight-normal">Fun fact</h5>
                <p>
                    <?= $student['fun_facts'] ?>
                </p>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>