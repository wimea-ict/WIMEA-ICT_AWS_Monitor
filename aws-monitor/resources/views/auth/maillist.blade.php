@extends('main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Mail list</h3> 
                </div>
                <div class="panel-body">
                    <div class=" col-md-12 col-sm-12 col-xs-12">
                        <form class="form-horizontal" method="POST" action="{{ route('maillist') }}">
                            <br/>
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <select id="name" type="text" class="form-control" name="nam"  required autofocus>

                                    <?php 
                                       	$server="localhost";
                                           $userid ="root";
                                           $Password = "*R00t.";
                                           $myDB = "wdrDb";

                                       
                                          $con = mysqli_connect($server,$userid,$Password,$myDB);
if (mysqli_connect_errno()) {
  echo( mysqli_connect_error());
  exit();
}else{
echo("connected");
}
                                            $sqli = "SELECT id,Name FROM users";
                                            $result = Mysqli_query($con, $sqli);
                                           if (!$result) {
                                              echo  Mysqli_error($result);
                                              //  exit();
                                            }
                                            
                                            while ($row = mysqli_fetch_array($result)) {
                                                         $name = $row['Name'];
                                 echo ('<option name = "nam" value = '.$row['id'].'>'.$name.'</option>');
                                            }	
                                            
                                      ?>
                                      </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Location</label>

                                <div class="col-md-6">
                                    <select id="locate" type="text" class="form-control" name="locat"  required autofocus>

                                    <?php 
                                    
                                            $sql = "SELECT station_id,Location FROM stations WHERE StationCategory= 'aws'";
                                            $result2 = mysqli_query($con, $sql);
                                             while ($row1 = mysqli_fetch_array($result2)) {
                                                         $loc = $row1['Location'];
                                              echo ('<option name = "locat" value = '.$row1['station_id'].'>'.$loc.'</option>');

                                            }	
                                            
                                            
                                      ?>
                                      </select>
                                </div>
                            </div>
                            

                            

                                 </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                 

                                </div>
                            </div>
                            <?php 
  
                            
                            if(isset($_POST['nam'])){

                               if(isset($_POST['locat'])){
                                echo ("Succesfully ");
                           
                               // echo ($_POST['locate']);
                                 $user = $_POST['nam'];
                                 $stationid = $_POST['locat'];

                                  $stmt3 = "SELECT userID,stationID FROM maillist";
                                  $stmt4 = mysqli_query($con,$stmt3);
                                  while($stmt3fetch = mysqli_fetch_array($stmt4)){
                                      if( ($stmt3fetch['userID']==$user)&&($stmt3fetch['stationID']==$stationid)){
                                          $update = "UPDATE `maillist` SET `status`= 1 WHERE userID = '$user'";
                                          mysqli_query($con,$update);
                                      break;
                                      }else{
                                         
     echo ("Added.");     

                                 $stmt2 = "INSERT INTO maillist(userID,stationID)VALUES('$user','$stationid')";
  
                                  $insert = mysqli_query($con,$stmt2);
                                      break;
                                }
                                  //redirect('/maillisttable');
                                }
                             }
                            }else{echo(" ");}
                            mysqli_close($con);?>


                    
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
