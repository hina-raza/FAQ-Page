<?php
    // Defining global variables 
    $username = "root";
    $pswd = "";
    $host = "localhost";
    $dbname = "faq";
    $Dtl = "";
    $Search = "";
    $QList = array();
    $DList = array();
    $Msg="";

    //establishing connection to DB server
    $connect = mysqli_connect($host,$username,$pswd,$dbname) or die("Connection to DB failed");
    
    //Search Bar
    if(isset($_POST["search"])){
        $Search = $_POST['input_search'];
        $query = "SELECT `title`, `detail` FROM `questions` WHERE `detail` LIKE '%$Search%' OR `Title` LIKE '%$Search%'";
        $testQ= mysqli_query($connect,$query) or die("Query Failed");
        
        //check if search produced any result
        if (mysqli_num_rows($testQ) == 0){
            $Msg= "No Information Found against the Keyword: $Search";
        }
        else{$Msg = "";}
        
        while ($rows = mysqli_fetch_row($testQ)){
            array_push($QList, $rows[0]);
            
            array_push($DList, $rows[1]);
            
        }
        $Search = "";
        
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ's</title>
    <link href="https://fonts.googleapis.com/css?family=Gotu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="faq.css">

</head>
<body>
    
    <form method="post">
        <div id="wrapper">
        <header>
            <div>
                <img src="logo.png" alt="logo" id="logo">
                <h3 id="your">YOUR</h3>
                <h3 id="caterers">CATERERS</h3>
            </div>

            <div>
                <h1>FREQUENTLY ASKED QUESTIONS</h1>
            </div>
            
            <div id="search">
                <input type="text" name="input_search" id="input_search" />
                <input type="submit" name="search" id="bttn_search" value="SEARCH" onclick="window.scroll(0,500);">
            </div>
            
        </header>
        <main>
            <div id="search-display" >
                <dl>
                    <?php
                    echo "<h4>$Msg</h4>";
                    $x=(count($QList)-1);
                    while($x >= 0){
                        echo "<dt>$QList[$x]</dt><dl>$DList[$x]</dl>"; $x--;
                    }
                    ?>
                </dl>
                <hr>
            </div>
            
            <?php
                echo "<div id='top-quests'>";
                

                //Displaying Questions with highest frequency
                $query = "SELECT `title` FROM `questions` WHERE `frequency` = '1'";
                $result = mysqli_query($connect,$query);
                $Dtl = "";
                $Q = "";
                
                //Retrieving responses to high frequency questions from DB
                if(isset($_POST['QLink'])){
                                        
                    $Q = $_POST['QLink'];
                    $qry = "SELECT `Detail` FROM `questions` WHERE `title` = '$Q'";
                    $rslt = mysqli_query($connect,$qry) or die("Query Failed");
                    $rec = mysqli_fetch_row($rslt);                    
                    $Dtl = $rec[0];
                }

                echo "<ul>";
                    while ($rows = mysqli_fetch_row($result)){                        
                        echo "<li><input type='submit' class='Qlink' name='QLink' value='$rows[0]'/></li>";                           
                        unset($_POST['QLink']);        
                    }
                echo"</ul>";                

                //Display answer to selected high frequency quetion
                echo "<div class='detail-box'>";
                echo "<p class='details topic' name='details'>$Q</p>";
                echo "<p class='details' name='details'>$Dtl</p>";
                echo "</div>";
                echo "</div>";
                
                
                echo "<div id='categories'>";
                
                //Query for Getting Categories
                $query = "SELECT DISTINCT `category` FROM `questions`";
                $result = mysqli_query($connect,$query);
                $cat_quest = array();
                $Categ = "";
                $Dtls = "";
                $Err = "";

                //Category Selection Check: using left column
                if(isset($_POST['Cat1'])){                    
                    $Categ = $_POST['Cat1'];
                    $qry = "SELECT `title` FROM `questions` WHERE `category` = '$Categ'";
                    $rslt = mysqli_query($connect,$qry) or die("Query Failed");
                    
                    // Saving records in an array 
                    while ($rows = mysqli_fetch_row($rslt)){                        
                        array_push($cat_quest,$rows[0]);
                    }                   
                    
                }
                //Category Selection Check: using right column
                if(isset($_POST['Cat2'])){                    
                    $Categ = $_POST['Cat2'];
                    $qry = "SELECT `title` FROM `questions` WHERE `category` = '$Categ'";
                    $rslt = mysqli_query($connect,$qry) or die("Query Failed");
                    if (mysqli_num_rows($rslt) ==0){
                        $Err = "There are no related questions in this category.";
                    }
                    else {$Err="";}
                    // Saving records in an array 
                    while ($rows = mysqli_fetch_row($rslt)){                        
                        array_push($cat_quest,$rows[0]);
                    }                   
                }
                //Getting answer to selected question in category
                $CQ = "";
                $CDtl = ""; 
                if(isset($_POST['CQuest'])){                    
                    $CQ = $_POST['CQuest'];
                    $qry = "SELECT `Detail` FROM `questions` WHERE `title` = '$CQ'";
                    $rslt = mysqli_query($connect,$qry) or die("Query Failed");
                    
                    $rec = mysqli_fetch_row($rslt);                    
                    $CDtl = $rec[0];
                    
                }

                //Category Buttons
                echo "<table>";
                    
                    $y=mysqli_num_rows($result);
                    while ($rows = mysqli_fetch_row($result)){
                        echo "<tr>";
                        echo "<td><input class='cat' type='submit' name='Cat1' value = '$rows[0]'/></td>";
                        $y--;
                        if($y > 0){
                            $rows = mysqli_fetch_row($result);
                             echo "<td><input class='cat' type='submit' name='Cat2' value = '$rows[0]' /></td>";
                             $y--;
                        }
                        echo "</tr>";
                        unset($_POST['Cat1']);
                        unset($_POST['Cat2']);
                    }
                    unset($_POST['Cat1']);
                    unset($_POST['Cat2']);
                echo "</table>";

                
                //Display Table for Questions
                $i = (count($cat_quest) -1);
                echo "<div class='detail-box box2'>";
                echo "<p class='details heading' name='CName'>$Categ</p>";
                echo "<p>$Err</p>";
                while ($i >= 0){
                    echo "<input type='submit' class='Qlink' name='CQuest' value = '$cat_quest[$i]'/>";
                    $i--;
                    unset($_POST['CName']);
                    unset($_POST['CQuest']);
                }
                echo "</div>";
                echo "<div class='detail-box box2'>";
                echo "<p class='details topic' name='CatQ'>$CQ</p>";
                echo "<p class='details' name='CatQdetails'>$CDtl</p>";
                echo "</div>";
                echo "</div>";
            ?>     
            
            <div id="bottom"></div>
        </main>
        <footer></footer>
        </div>
    </form>
    
</body>
</html>
<?php 
        mysqli_close($connect);
?>