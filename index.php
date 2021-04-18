<!DOCTYPE html>
<html lang="it" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>PHP Calendar</title>

    <link rel="stylesheet" href="css/style.css">
    
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Minified jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="input-field col s3">
                <select class="months">
                    <option value="" disabled selected>Choose Your Option</option>
                    <?php
                    // Get the name of month
                        $firstDayOfMonth = mktime( 0, 0, 0, $_GET['month'], 1, $_GET['year'] );
                         $first_day_info = getdate( $firstDayOfMonth );
                          $name_of_month = $first_day_info['month'];
                    echo ( isset($_GET['month']) ) ? "<option selected value='".$_GET['month']."'>".$name_of_month."</option>" : ".date('m').";
                    ?>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <label>Choose A Month</label>
            </div>

            <div class="input-field col s3">
                <select class="years">
                    <option value="" disabled selected>Choose Your Option</option>
                    <?php
                    // Get the year
                    echo ( isset($_GET['year']) ) ? "<option selected value='".$_GET['year']."'>".$_GET['year']."</option>" : "";
                    ?>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                </select>
                <label>Choose A Year</label>
            </div>

            <div class="input-field col s3">
                <select class="week">
                    <option value=""disabled>Choose Your Option</option>
                    <option value="Full" selected>All Weeks</option>
                    <?php
                    // Get the week
                    echo ( isset( $_GET['week'] ) ) ? "<option selected value='".$_GET['week']."'>Week ".$_GET['week']."</option>" : "";
                    ?>
                    <option value="1">Week 1</option>
                    <option value="2">Week 2</option>
                    <option value="3">Week 3</option>
                    <option value="4">Week 4</option>
                    <option value="5">Week 5</option>
                    <option value="6">Week 6</option>
                </select>
                <label>Choose A Week</label>
            </div>

            <button class="btn waves-effect waves-light cl s2" type="submit" name="load-events">
                Load Events
                <i class="material-icons right">send</i>
            </button>

            <button class="btn waves-effect waves-light cl s2" type="submit" name="reset">
                Reset
                <i class="material-icons right">send</i>
            </button>

                <?php include_once( 'calendar.php' ); ?>

                <?php 
                    if ( !isset($_GET['month']) || !isset($_GET['year']) ) {
                        echo build_calendar( date('m'), date('Y') );
                    } else {
                        echo build_calendar( $_GET['month'], $_GET['year']);
                    }
                ?>
        </div>
    </div>
    
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="js/index.js"></script>

</body>
</html>

