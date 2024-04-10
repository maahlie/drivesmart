<?php
include("template/header.php")
?>
<br><br>
<form method="POST" name="planLesson" action="saveLesson">
  <div class="center container">
    <h1>Les inplannen</h1>

    <label for="date">Les datum:</label>
    <input type="date" id="date" name="date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" onchange="changeDatepicker();">
    
    <br><br>
    <hr>
    <br>
    
    <div class="block-list">
        <?php echo $blocks ?>
    </div>
    <img onerror="filterLessons(this);" src="" style="display:none">

    <div class="clearfix">
        <br><br>
        <button type="submit" name="submitLesson" class="signupbtn">Plan les in</button>
    </div>

  </div>
</form>

<?php
include("template/footer.php");
?>