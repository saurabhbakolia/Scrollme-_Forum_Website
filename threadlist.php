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
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }

    ?>

    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        // insert thread into database
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '0', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your thread has been successfully added, wait till community respond.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }
    ?>



    <!-- theadList start here  -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname ?> Forums!</h1>
            <p class="lead"><?php echo $catdesc ?></p>
            <hr class="my-4">
            <p>No Spam / Advertising / Self-promote in the forums. Do not post copyright-infringing material. Do not
                post “offensive” posts, links or images. Do not cross post questions.Do not PM users asking for
                help.Remain respectful of other members at all times.</p>
            <p class="lead">
                <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>

    <div class="container">
        <h1>Start Discussions</h1>
        <form action="<?php $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">keep your title short and crisp as possible</div>
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Elaborate Your Concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>

    <div class="container" id="ques">
        <h1 class="py-2">Browse Questions</h1>

        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE `thread_cat_id`=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            echo '<div class="media my-4">
            <img class="mr-3" src="https://source.unsplash.com/random/500x400/?' . $title . '" width="40px" border-radius="25px" alt="user">
            <div class="media-body">
                <h5 class="mt-0"><a class="text-dark" href="thread.php?thread_id=' . $id . '">' . ucwords($title) . '</a></h5>
                    ' . $desc . '
            </div>
        </div>';
        }

        if ($noResult) {
            echo '<div class="media my-<div class="card">
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                <p>No result found.</p>
                <footer class="blockquote-footer">Be the first person to ask questions.</footer>
                </blockquote>
            </div>
            </div>';
        }
        ?>



    </div>


    <?php include "./partials/_footer.php" ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>