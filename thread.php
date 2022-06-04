<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        #ques {
            min-height: 300px;
        }
    </style>

    <title>Welcome to Scrollme.com | Discuss Forum</title>

    <style>
        .carousel-item {
            width: 100%;
            height: 60vh;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <?php include "./partials/_header.php" ?>
    <?php include "./partials/_dbconnect.php" ?>

    <?php
    $id = $_GET['thread_id'];
    $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
    }

    ?>
    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        // insert into comment database
        $comment_text = $_POST['comment'];
        $sql = "INSERT INTO `comments` (`comment_text`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment_text', '$id', '0', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your comment has been successfully posted.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }
    ?>


    <!-- theadList start here  -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title ?> </h1>
            <p class="lead"><?php echo $desc ?></p>
            <hr class="my-4">
            <p>No Spam / Advertising / Self-promote in the forums. Do not post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post questions.Do not PM users asking for help.Remain respectful of other members at all times.</p>
            <p>
                <b>Posted by: John</b>
            </p>
        </div>
    </div>



    <div class="container">
        <h1>Post Comments</h1>
        <form action="<?php $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class="mb-3">
                <label for="comment" class="form-label">Type your comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Post Comment</button>
        </form>
    </div>

    <div class="container" id="ques">
        <h1 class="py-2">Discussions</h1>

        <?php
        $id = $_GET['thread_id'];
        $sql = "SELECT * FROM `comments` WHERE `thread_id`=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['comment_id'];
            $comment_content = $row['comment_text'];
            $comment_time = $row['comment_time'];
            // $desc = $row['thread_desc'];
            echo '<div class="media my-4">
            <img class="mr-3" src="https://source.unsplash.com/random/500x400/?' . $id . '" width="40px" border-radius="25px" alt="user">
            <div class="media-body">
                    <p><span class="font-weight-bold my-0">John</span> at '.$comment_time.'</p>
                    ' . $comment_content . '
            </div>
        </div>';
        }
        ?>

    </div>


    <?php include "./partials/_footer.php" ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>