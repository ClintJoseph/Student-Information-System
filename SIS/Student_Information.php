

<!DOCTYPE html>
<head>
    <title>
        Student Information System
    </title>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="mystyle.css">

<body>
  <center>
    <h1>Student Information System</h1>
    <div id="d">

   <form action = "Student_Information.php" method = "post"> 
        <h3>Enter Student Details</h3>
        <br>

        <l1>First Name:</l1>
        <div class="box">
       <input  name="fn"type="text" id="firstbox" placeholder=""/>
        </div>

        <l2>Last Name:</l2>  
        <div class="box">
        <input  name="ln"type="text" id="lastbox" placeholder=""/>
        </div>
    
        <l3>Roll Number:</l3>
        <div class="box">
        <input  name="rn"type="text" id="rollbox" placeholder=""/>
        </div>
    
        <l4>Email:</l4>
        <div class="box"> 
        <input  name="em"type="email" id="emailbox" placeholder=""/>
        </div>

        <br>
        <br>

        <input class="btn" type = "submit" name = "Insert" value = "Insert"> 
        <button class="btn" name="Delete"><i class="fa fa-trash"></i></button>
        <button class="btn" name="Search"><i class="fa fa-search"></i></button>
        <button class="btn" name="Update">Update</i></button>
        <button class="btn" name="Display">Display</button>

 
    </form>
    <br><br>
</div>
<br><br>
 
 


<div id='p'>
<?php


    function insert(){

        $s= array(
        $_POST['fn'],
        $_POST['ln'],
        $_POST['rn'],
        $_POST['em']);

        $fp = fopen('student.csv', 'a');
        fputcsv($fp,$s );
        fclose($fp);
    }

    function Display(){
        
       echo "<class=p>"."<b>Details of Students</b>\n"."</>"."<br><br>" ;
              
            echo "<center><table border=1>";
                $file = fopen("student.csv", "r");
                echo "<tr>";
                echo "<td>" ."<b>First Name<b>" ."</td>";
                echo "<td>" ."<b>Last Name<b>" ."</td>";
                echo "<td>" ."<b>Roll Number<b>" ."</td>";
                echo "<td>" ."<b>Email Address<b>" ."</td>";
                
                while (($data = fgetcsv($file))!==false) {
                    $cell=0;
                    echo "<tr>";
                    foreach ($data as $cell) {
                        echo "<td>" . $cell ."   " . "</td>";
                            
                    }
                    echo "</tr> \n";
                }
                fclose($file);
                
    }



    function Search(){

        $flag=0;
        
       
            $file = fopen("student.csv", "r");
    
            while (($data = fgetcsv($file)) !== false) {
    
                if($data[2]==$_POST['rn']){

                $cell=0;
                $c=0;
                $flag=1;
                foreach ($data as $cell) {
                    if($c==0)
                    echo "<b>First Name : </b>";
                    if($c==1)
                    echo "<b>Last Name : </b>";
                    if($c==2)
                    echo "<b>Roll Number : </b>";
                    if($c==3)
                    echo "<b>Email : </b>";

                      
                    echo  $cell ;
                    echo "<br>";
                    $c++;
                }

            }  }

            if($flag==0)
            echo "<b>Student details not found<b>";

            fclose($file);

    }

    function update(){

        $old = "student.csv";
        $new= "out.csv";
            $file = fopen($old, "r");
            $out = fopen($new, "w");
    
            while (($data = fgetcsv($file)) !== false) {
    
                if(isset($data[2])){
                if($data[2]==$_POST['rn']){
                    if($data[0]!='')
                    $data[0]=$_POST['fn'];
                    $data[1]=$_POST['ln'];
                    $data[3]=$_POST['em'];
                }
                
                fputcsv($out,$data);
                } }
            
            fclose($file);
            fclose($out);
        rename($new,$old);

    }




    function delete(){

        $old = "student.csv";
        $new = "out.csv";
            $file = fopen($old, "r");
            $out = fopen($new, "w");
    
            while (($data = fgetcsv($file)) !== false) {
    
                if(isset($data[2])){
                if($data[2]==$_POST['rn'])
                continue;
                fputcsv($out,$data);}
                }
            
            fclose($file);
            fclose($out);
         rename($new,$old);    

    }


    if(isset($_POST['Insert'])) {
        insert();
    }
    if(isset($_POST['Display'])) {
        Display();
    }
    if(isset($_POST['Search'])) {
        Search();
    }
    if(isset($_POST['Update'])) {
        update();
    } 
    if(isset($_POST['Delete'])) {
        delete();
    }    

?>
</div>
</center>
</body>



 