<?php
include('template/header.php');
?>

<br><br>

<div id="dash-lists">
    <div class="container">
        <h1>Geplande lessen</h1>
        <div class="block-list">
            <?php echo $blocks ?> <!-- show lessonblocks passed from function -->
        </div>
        <?php echo "<span class='error'>" . $error . "</span>"?> <!-- error shown when an error is passed from a function -->
    </div>

    <div class="container">
        <h1>Vorige lessen</h1>
        <div class="block-list">
            <?php echo $blocksOld ?> <!-- show lessonblocks passed from function -->
        </div>
    </div>
</div>

<?php
include('template/footer.php');
?>