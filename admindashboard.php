<!DOCTYPE html PUBLIC >
<html>
<head>
<title>Admin Dashboard</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="./assets/css/admindashboard.css" type="text/css" media="all" />
<link rel="stylesheet" href="./assets/css/admincourse&m.css" type="text/css" media="all" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.4);
    }
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

  
    .number-box {
      background-color: #edbfd2;
    padding: 10px 20px;
    border-radius: 5px;
    margin-top: 10px;
    align-items: center;
    justify-content: center;
    display:flex;
}

#lineChart {
    width: 100%; 
    height: 400px; 
    display: block; 
    border-radius: 8px; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
}

.icon {
    font-size: 40px; 
    color: #70304c; 
    margin-right: 10px; 
}
.large-box,
.largetwo-box {
    float: left;
    width: calc(50% - 40px); 
    margin-right: 16px; 
    margin-left: 20px;
}


</style>

</head>
<body>

<div id="header">
  <div class="shell">
    
    <div id="top">
      <h1><a href="#">Admin Dashboard</a></h1>
      <div id="top-navigation"> <a href="#" onclick="showSection('mainn')">Overview</a> <span>|</span> <a href="#" onclick="showSection('user-management')">Profiles</a> <span>|</span> <a href="login.php">Logout</a> </div>
    </div>
   
    <div id="navigation">
      <ul>
      <li><a href="#" onclick="showSection('mainn')"><span>Overview</span></a></li>
                <li><a href="#" onclick="showSection('user-management')"><span>User Management</span></a></li>
                <li><a href="#" onclick="showSection('expertslist')"><span>Expert Management</span></a></li>
                <li><a href="#" onclick="showSection('container')"><span>Blog Management</span></a></li>
                <li><a href="#" onclick="showSection('resources')"><span>Resource Management</span></a></li>
                <li><a href="manageGroup.php" onclick="showSection('groups')"><span>Manage Groups</span></a></li>
                
      </ul> 
    </div>
    
  </div>
</div>


<div id="mainn" class="section">

<div class="dashboard-container">

<?php
  include 'connection.php';

  $sql = "SELECT COUNT(*) as count FROM users WHERE loginType != 'Admin'";
  $result = $con->query($sql);
  $userCount = 0;

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userCount = $row['count'];
  }

    $con->close();
  ?>
<div class="dashboard-box">
            <div class="box-content">
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <div class="text">
                    <div class="topic">Users</div>
                    <div class="number-box">
                    <span class="number" id="userCount"><?php echo $userCount; ?></span>
                    </div>
                </div>
            </div>
            <div class="chart-small"><canvas id="myPieChart"></canvas></div>
        </div>

        
        <?php
  include 'connection.php';

  $sql = "SELECT COUNT(*) as count FROM subscription";
  $result = $con->query($sql);
  $subscriptionCount = 0;

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $subscriptionCount = $row['count'];
  }


$sql = "SELECT COUNT(*) as count FROM users WHERE loginType != 'Admin'";
$result = $con->query($sql);
$userCount = 0;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userCount = $row['count'];
}

    $con->close();
  ?>

  
    <div class="dashboard-box">
         <div class="box-content">
                <div class="icon">
                    <i class="fa fa-save"></i>
                </div>
                <div class="text">
                    <div class="topic">Subscriptions</div>
                    <div class="number-box">
                    <span class="number" id="userCount"><?php echo $subscriptionCount; ?></span>
                    </div>
                </div>
            </div>
            <div class="chart-small"><canvas id="subscriptionPieChart"></canvas></div>
    </div>

    <?php
  include 'connection.php';

  $sqlTotal = "SELECT COUNT(*) as count FROM experts";
  $resultTotal = $con->query($sqlTotal);
  $totalExperts = 0;

  if ($resultTotal->num_rows > 0) {
    $row = $resultTotal->fetch_assoc();
    $totalExperts = $row['count'];
  }

  
  $sqlMoreThan10 = "SELECT COUNT(*) as count FROM experts WHERE experience > 10";
  $resultMoreThan10 = $con->query($sqlMoreThan10);
  $countMoreThan10 = 0;

  if ($resultMoreThan10->num_rows > 0) {
    $row = $resultMoreThan10->fetch_assoc();
    $countMoreThan10 = $row['count'];
  }

  $sql10OrLess = "SELECT COUNT(*) as count FROM experts WHERE experience <= 10";
  $result10OrLess = $con->query($sql10OrLess);
  $count10OrLess = 0;

  if ($result10OrLess->num_rows > 0) {
    $row = $result10OrLess->fetch_assoc();
    $count10OrLess = $row['count'];
  }

  $con->close();
?>

    <div class="dashboard-box">
    <div class="box-content">
                <div class="icon">
                    <i class="fa fa-trophy"></i>
                </div>
                <div class="text">
                    <div class="topic">Experts</div>
                    <div class="number-box">
                    <span class="number" id="userCount"><?php echo $totalExperts; ?></span>
                    </div>
                </div>
            </div>
            <div class="chart-small"><canvas id="expertPieChart"></canvas></div>
    </div>
    <div class="dashboard-box">

    <?php
  include 'connection.php';

  $sql = "SELECT 
           (SELECT COUNT(*) FROM projects) AS projects_count,
          (SELECT COUNT(*) FROM researches) AS researches_count,
           (SELECT COUNT(*) FROM courses) AS courses_count,
           (SELECT COUNT(*) FROM cvtemplates) AS cvtemplates_count,
           (SELECT COUNT(*) FROM magazines) AS magazines_count";

$result = $con->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $projectsCount = $row['projects_count'];
    $researchesCount = $row['researches_count'];
    $coursesCount = $row['courses_count'];
    $cvTemplatesCount = $row['cvtemplates_count'];
    $businessMagazinesCount = $row['magazines_count'];

    $totalResources = $projectsCount + $researchesCount + $coursesCount + $cvTemplatesCount + $businessMagazinesCount;

} else {
    echo "Error retrieving data: " . $con->error;
}

    $con->close();
  ?>
    <div class="box-content">
                <div class="icon">
                    <i class="fa fa-book"></i>
                </div>
                <div class="text">
                    <div class="topic">Resources</div>
                    <div class="number-box">
                    <span class="number" id="resourceCount"><?php echo $totalResources; ?></span>
                    </div>
                </div>
            </div>
            <div class="chart-small"> <canvas id="resourceChart" ></canvas></div>
           
    </div>  

    <?php
include 'connection.php';
    
$sqlOverall = "SELECT DATE(created_at) AS registration_date, COUNT(*) AS registrations 
              FROM users 
              GROUP BY DATE(created_at) 
              ORDER BY DATE(created_at)";

$resultOverall = $con->query($sqlOverall);

$datesOverall = [];
$registrationsOverall = [];

if ($resultOverall->num_rows > 0) {
    while ($row = $resultOverall->fetch_assoc()) {
        $datesOverall[] = $row['registration_date'];
        $registrationsOverall[] = $row['registrations'];
    }
} else {
    echo "No data found for overall registrations";
}


$sqlFreeUsers = "SELECT DATE(created_at) AS registration_date, COUNT(*) AS registrations 
                FROM users 
                WHERE loginType = 'Free user'
                GROUP BY DATE(created_at) 
                ORDER BY DATE(created_at)";

$resultFreeUsers = $con->query($sqlFreeUsers);

$datesFreeUsers = [];
$registrationsFreeUsers = [];

if ($resultFreeUsers->num_rows > 0) {
    while ($row = $resultFreeUsers->fetch_assoc()) {
        $datesFreeUsers[] = $row['registration_date'];
        $registrationsFreeUsers[] = $row['registrations'];
    }
} else {
    echo "No data found for free user registrations";
}


$sqlPremiumUsers = "SELECT DATE(created_at) AS registration_date, COUNT(*) AS registrations 
                   FROM users 
                   WHERE loginType = 'Premium user'
                   GROUP BY DATE(created_at) 
                   ORDER BY DATE(created_at)";

$resultPremiumUsers = $con->query($sqlPremiumUsers);

$datesPremiumUsers = [];
$registrationsPremiumUsers = [];

if ($resultPremiumUsers->num_rows > 0) {
    while ($row = $resultPremiumUsers->fetch_assoc()) {
        $datesPremiumUsers[] = $row['registration_date'];
        $registrationsPremiumUsers[] = $row['registrations'];
    }
} else {
    echo "No data found for premium user registrations";
}
$con->close();
?>
    
    </div>

    
        <div class="large-box">
            <div class="topic">User Registrations Over Time</div>
            <canvas id="lineChart"></canvas> 
        </div>
        <div class="largetwo-box">
            <div class="topic">Chat Groups</div>
            <canvas id="groupsChart"></canvas> 
        </div>
   



  
 
  
<?php

include 'connection.php';

$sql = "SELECT 
            COUNT(CASE WHEN loginType = 'Free user' THEN 1 END) AS free_users,
            COUNT(CASE WHEN loginType = 'Premium user' THEN 1 END) AS premium_users
        FROM users";
$result = $con->query($sql);

$data = array();
if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
        $data = [
            "free_users" => (int)$row["free_users"],
            "premium_users" => (int)$row["premium_users"]
        ];
    }
} else {
    $data = ["free_users" => 0, "premium_users" => 0];
}
$con->close();


$jsonData = json_encode($data);
?>
  
  <?php
include 'connection.php';

$query = "
    SELECT g.name AS group_name, COUNT(gm.msg_id) AS num_messages
    FROM groups g
    LEFT JOIN group_messages gm ON g.group_id = gm.group_id
    GROUP BY g.group_id, g.name
";
$result = $con->query($query);

$groupNames = [];
$messageCounts = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $groupNames[] = $row['group_name'];
        $messageCounts[] = $row['num_messages'];
    }
} else {
    echo "No data found";
}

$con->close();
?>


  
  </div>




</div>
  

   





<div id="container" class="section">
  <div class="shell">
    <br />
    
    <div id="main">
      <div class="cl">&nbsp;</div>
    
      <div id="content">
       
        <div class="box">
          
          <div class="box-head">
            <h2 class="left">Our Blogs</h2>
            <div class="right">
              <label>Search</label>
              <input type="text" class="field small-field" />
              <input type="submit" class="button" value="search" />
              
            </div>
          </div>
          <div class="container mt-5">
        
          <div id="blog-management">
    
    <table id="blog-table" border="1">

        
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
        <?php
                            include 'connection.php';

                            
                          


                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteb_id'])) {
                              $deleteb_id = intval($_POST['deleteb_id']);
                              $deleteSql = "DELETE FROM blogs WHERE blog_id = ?";
                              $stmt = $con->prepare($deleteSql);
                          
                              if ($stmt === false) {
                                  die('MySQL prepare error: ' . htmlspecialchars($con->error));
                              }
                          
                              $stmt->bind_param("i", $deleteb_id);
                          
                              if ($stmt->execute()) {
                                  echo "<script>alert('Blog deleted successfully.'); window.location.href='admindashboard.php';</script>";
                              } else {
                                  echo "Error deleting blog: " . htmlspecialchars($stmt->error);
                              }
                          
                              $stmt->close();
                          }
                            

                           
                            $blogSql = "SELECT blog_id, title, author, year FROM blogs";
                            $result = $con->query($blogSql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['author']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['year']) . "</td>";
                                    echo "<td>";
                                    
                                    echo "<input type='submit' value='Edit'>";
                                    echo "</form>";
                                    echo "</td>";
                                    

                                   
                                    echo "<td>";
                                    echo "<form method='post' action='#blog-management' onsubmit=\"return confirm('Are you sure you want to delete this blog?');\">";
                                    echo "<input type='hidden' name='deleteb_id' value='" . htmlspecialchars($row['blog_id']) . "'>";
                                    echo "<input type='submit' value='Delete'>";
                                    echo "</form>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No results found</td></tr>";
                            }

                            $con->close();
                            ?>





        </tbody>
    </table>
    </div>
          
                
            
           
            
          </div>
          
        </div>

        
        <div class="box">
        
              
        </div>
        </div>
      </div>
      <?php

include 'connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['form_type'] == 'blog_form') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    
    $summary = $_POST['summary'];

   
    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO blogs (title, author, year, image, link, summary)
                VALUES ('$title', '$author', '$year', '$target_file', '$link', '$summary')";

        if ($con->query($sql) === TRUE) {
          echo "<script>
                alert('New blog post created successfully!');
                window.location.href = 'admindashboard.php';
              </script>";
            
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    } else {
      echo "<script>
      alert('Sorry, there was an error uploading your file.');
      window.location.href = 'admindashboard.php';
    </script>";
       
    }

    $link = '';
    if (isset($_FILES['pdf_file'])) {
        $file = $_FILES['pdf_file'];
        
        // Handle file upload process here
        // Example:
        $upload_directory = 'uploads/pdfs/';
        $filename = $file['name'];
        $target_path = $upload_directory . $filename;
        
        if (move_uploaded_file($file['tmp_name'], $target_path)) {
            $pdf_url = $target_path; // Store the URL or path to the uploaded file
        } else {
            // Handle upload failure
            echo "File upload failed.";
        }
    }
    
}

$con->close();
?>

      <div id="sidebar">
      <div class="box">
          
          <div class="box-head">
            <h2>Add a new blog</h2>
          </div>
         
          <form class="blog-form" action="admindashboard.php" method="post" enctype="multipart/form-data">

          <input type="hidden" name="form_type" value="blog_form">

            <label class="blog-label" for="title">Title:</label><br>
            <input class="blog-input" type="text" id="title" name="title"><br><br>
            
            <label class="blog-label" for="author">Author:</label><br>
            <input class="blog-input" type="text" id="author" name="author"><br><br>
            
            <label class="blog-label" for="year">Year:</label><br>
            <input class="blog-input" type="text" id="year" name="year"><br><br>
            
            <label class="blog-label" for="image">Image:</label><br>
            <input class="blog-input" type="file" id="image" name="image"><br><br>
            
            <label class="blog-label" for="link">PDF:</label><br>
            <input class="blog-input" type="file" id="link" name="link"><br><br>
            
            <label class="blog-label" for="summary">Summary:</label><br>
            <textarea class="blog-textarea" id="summary" name="summary"></textarea><br><br>
            
            <input class="blog-submit" type="submit" value="Add Blog Post">
        </form>
       
              
        </div>
        
      
         
          
            
       
      </div>
      
      <div class="cl">&nbsp;</div>
    </div>
    
  </div>







</div>

<div id="user-management" class="section">
    <h2>Registered Users</h2>
    <p></p>
    <table id="user-table" border="1">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Created_at</th>
                <th>Edit</th> 
                <th>Delete</th> 
            </tr>
        </thead>
    
        <tbody>
        <?php
                            include 'connection.php';

                            
                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
                                $id = intval($_POST['edit_id']);
                                $loginType = $_POST['loginType'];

                                $updateSql = "UPDATE users SET loginType = ? WHERE id = ?";
                                $stmt = $con->prepare($updateSql);

                                if ($stmt === false) {
                                    die('MySQL prepare error: ' . htmlspecialchars($con->error));
                                }

                                $stmt->bind_param("si", $loginType, $id);

                                if ($stmt->execute()) {
                                    echo "<script>alert('User loginType updated successfully.'); window.location.href='admindashboard.php#user-management';</script>";
                                } else {
                                    echo "Error updating loginType: " . htmlspecialchars($stmt->error);
                                }

                                $stmt->close();
                            }

                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
                              $delete_id = intval($_POST['delete_id']);
                              $deleteSql = "DELETE FROM users WHERE id = ?";
                              $stmt = $con->prepare($deleteSql);
                          
                              if ($stmt === false) {
                                  die('MySQL prepare error: ' . htmlspecialchars($con->error));
                              }
                          
                              $stmt->bind_param("i", $delete_id);
                          
                              if ($stmt->execute()) {
                                  echo "<script>alert('User deleted successfully.'); window.location.href='admindashboard.php#user-management';</script>";
                              } else {
                                  echo "Error deleting user: " . htmlspecialchars($stmt->error);
                              }
                          
                              $stmt->close();
                          }
                            

                           
                            $sql = "SELECT id, username, email, created_at, loginType FROM users WHERE loginType != 'Admin'";
                            $result = $con->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['loginType']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                                    echo "<td>";
                                    echo "<form method='post' action='#user-management'>";
                                    echo "<input type='hidden' name='edit_id' value='" . htmlspecialchars($row['id']) . "'>";
                                    echo "<select name='loginType'>";
                                    echo "<option value='Free user' " . ($row['loginType'] == 'Free user' ? 'selected' : '') . ">Free user</option>";
                                    echo "<option value='Premium user' " . ($row['loginType'] == 'Premium user' ? 'selected' : '') . ">Premium user</option>";
                                    echo "</select>";
                                    echo "<input type='submit' value='Save'>";
                                    echo "</form>";
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<form method='post' action='#user-management' onsubmit=\"return confirm('Are you sure you want to delete this user?');\">";
                                    echo "<input type='hidden' name='delete_id' value='" . htmlspecialchars($row['id']) . "'>";
                                    echo "<input type='submit' value='Delete'>";
                                    echo "</form>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No results found</td></tr>";
                            }

                            $con->close();
                            ?>





        </tbody>
    </table>
    <h2>Messages From Users</h2>
    <p></p>
    <table id="user-table" border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Reply</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>

        <?php
include 'connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deletec_id'])) {
    
    $deletec_id = intval($_POST['deletec_id']);
    
    
    $deletecSql = "DELETE FROM contact WHERE id = ?";
    $stmt = $con->prepare($deletecSql);
    
    if ($stmt === false) {
        die('MySQL prepare error: ' . htmlspecialchars($con->error));
    }
    
    
    $stmt->bind_param("i", $deletec_id);
    
    if ($stmt->execute()) {
        
        echo "<script>alert('Message deleted successfully.'); window.location.href='admindashboard.php';</script>";
        exit; 
    } else {
        echo "Error deleting message: " . htmlspecialchars($stmt->error);
    }
    
    $stmt->close(); 
}


$sql = "SELECT id, name, email, phone, subject, message FROM contact";
$result = $con->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
        echo "<td>" . htmlspecialchars($row['subject']) . "</td>";
        echo "<td>" . htmlspecialchars($row['message']) . "</td>";
        echo "<td>";
        echo "<form method='get' action='mailto:" . htmlspecialchars($row['email']) . "' enctype='text/plain'>";
        echo "<input type='submit' value='Reply'>";
        echo "</form>";
        echo "</td>";
        
        echo "<td>";
        echo "<form method='post' action='#user-management' onsubmit=\"return confirm('Are you sure you want to delete this message?');\">";
        echo "<input type='hidden' name='deletec_id' value='" . htmlspecialchars($row['id']) . "'>";
        echo "<input type='submit' value='Delete'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No contacts found</td></tr>";
}

$con->close(); 
?>

        </tbody>
        </table>


        <h2>Expert Requests</h2>
    <p></p>
    <table id="user-table" border="1">
        <thead>
            <tr>
                
                <th>Email_Submitted</th>
                <th>Submission_Date</th>
                <th>Highlight</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php
                            include 'connection.php';

                            
                          if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['highlight_id'])) {
                           $highlight_id = $_POST['highlight_id'];

  
                            echo "<script>highlightRowById($highlight_id);</script>";
                            
                            echo "<script>
                                alert('Request highlighted successfully!');
                                    window.location.href = 'admindashboard.php#user-management';
                                  </script>";
                    }
              
                            
                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleter_id'])) {
                                
                                $deleter_id = intval($_POST['deleter_id']);
                                
                                
                                $deleterSql = "DELETE FROM requests WHERE request_id = ?";
                                $stmt = $con->prepare($deleterSql);
                                
                                if ($stmt === false) {
                                    die('MySQL prepare error: ' . htmlspecialchars($con->error));
                                }
                                
                                
                                $stmt->bind_param("i", $deleter_id);
                                
                                if ($stmt->execute()) {
                                   
                                    echo "<script>alert('Request deleted successfully.'); window.location.href='admindashboard.php';</script>";
                                    exit; 
                                } else {
                                    echo "Error deleting request: " . htmlspecialchars($stmt->error);
                                }
                                
                                $stmt->close(); 
                            }


                            $sql = "SELECT request_id, submitted_email, submission_date FROM requests ";
                            $result = $con->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['submitted_email']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['submission_date']) . "</td>";
                                    echo "<td>";
                                    echo "<form method='post' action='#user-management'>";
                                    echo "<input type='hidden' name='highlight_id' value='" . htmlspecialchars($row['request_id']) . "'>";
                                    echo "<input type='submit' name='highlight' value='Highlight'>";
                                    echo "</form>";
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<form method='post' action='#user-management' onsubmit=\"return confirm('Are you sure you want to delete this request?');\">";
                                    echo "<input type='hidden' name='deleter_id' value='" . htmlspecialchars($row['request_id']) . "'>";
                                    echo "<input type='submit' value='Delete'>";
                                    echo "</form>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No results found</td></tr>";
                            }

                            $con->close();


                            ?>
        
        
        </tbody>
        </table>

        <h2>Subscriptions</h2>
    <p></p>
    <table id="user-table" border="1">
        <thead>
            <tr>
            <th>Email_Subscribed</th>
                <th>Subscribed_Date</th>
                <th>Highlight</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php
                            include 'connection.php';

                            
                          
              
                            
                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deletes_id'])) {
                                
                                $deletes_id = intval($_POST['deletes_id']);
                                
                                
                                $deletesSql = "DELETE FROM subscription WHERE subscription_id = ?";
                                $stmt = $con->prepare($deletesSql);
                                
                                if ($stmt === false) {
                                    die('MySQL prepare error: ' . htmlspecialchars($con->error));
                                }
                                
                                
                                $stmt->bind_param("i", $deletes_id);
                                
                                if ($stmt->execute()) {
                                    
                                    echo "<script>alert('Subscription deleted successfully.'); window.location.href='admindashboard.php';</script>";
                                    exit; 
                                } else {
                                    echo "Error deleting request: " . htmlspecialchars($stmt->error);
                                }
                                
                                $stmt->close(); 
                            }


                            $sql = "SELECT subscription_id, subscribed_email, subscribed_date FROM subscription ";
                            $result = $con->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['subscribed_email']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['subscribed_date']) . "</td>";
                                    echo "<td>";
                                    echo "<form method='post' action='#user-management'>";
                                    echo "<input type='hidden' name='highlight_id' value='" . htmlspecialchars($row['subscription_id']) . "'>";
                                    echo "<input type='submit' name='highlight' value='Highlight'>";
                                    echo "</form>";
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<form method='post' action='#user-management' onsubmit=\"return confirm('Are you sure you want to delete this subscription?');\">";
                                    echo "<input type='hidden' name='deletes_id' value='" . htmlspecialchars($row['subscription_id']) . "'>";
                                    echo "<input type='submit' value='Delete'>";
                                    echo "</form>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No results found</td></tr>";
                            }

                            $con->close();


                            ?>
        
        
        </tbody>
        </table>
</div>



<div id="expertslist" class="section">
        <div id="experts"  >
    <div class="shell">
      <br />
      
      <div id="main">
        <div class="cl">&nbsp;</div>
      
        <div id="content">
        <h2 class="resourcetitle">Experts</h2>
          <div class="box">
            
            <div class="box-head">
              <h2 class="left">Our Experts</h2>
              <div class="right">
                <label>Search</label>
                <input type="text" class="field small-field" />
                <input type="submit" class="button" value="search" />
                
              </div>
            </div>
            <div class="container mt-5">
          
            <div id="experts-management">
      
      <table id="experts-table" border="1">
  
          
              <thead>
                  <tr>
                  <th>Name</th>
            <th>Email</th>
            <th>Qualifications</th>
            <th>Certificate</th>
            <th>Experience</th>
            <th>LinkedIn Profile</th>
            <th>Specialization</th>
            <th>Highlight</th>
            <th>Delete</th>
                  </tr>
              </thead>
              <tbody>

              <?php
        include 'connection.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteex_id'])) {
            $deleteex_id = intval($_POST['deleteex_id']);
            $deleteexSql = "DELETE FROM experts WHERE expert_id = ?";
            $stmt = $con->prepare($deleteexSql);

            if ($stmt === false) {
                die('MySQL prepare error: ' . htmlspecialchars($con->error));
            }

            $stmt->bind_param("i", $deleteex_id);

            if ($stmt->execute()) {
                echo "<script>alert('Expert deleted successfully.'); window.location.href='admindashboard.php';</script>";
                exit; 
            } else {
                echo "Error deleting expert: " . htmlspecialchars($stmt->error);
            }

            $stmt->close(); 
        }

        $sql = "SELECT expert_id, name, email, skills, certificate, experience, linkedin_profile, specialization FROM experts";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['skills']) . "</td>";
                echo "<td>" . ($row['certificate'] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . htmlspecialchars($row['experience']) . "</td>";
                echo "<td><a href='" . htmlspecialchars($row['linkedin_profile']) . "' target='_blank'>LinkedIn</a></td>";
                echo "<td>" . htmlspecialchars($row['specialization']) . "</td>";
                echo "<td>";
                echo "<form method='post' action='#expert-management'>";
                echo "<input type='hidden' name='highlight_id' value='" . htmlspecialchars($row['expert_id']) . "'>";
                echo "<input type='submit' name='highlight' value='Highlight'>";
                echo "</form>";
                echo "</td>";
                echo "<td>";
                echo "<form method='post' action='#expert-management' onsubmit=\"return confirm('Are you sure you want to delete this expert?');\">";
                echo "<input type='hidden' name='deleteex_id' value='" . htmlspecialchars($row['expert_id']) . "'>";
                echo "<input type='submit' value='Delete'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No results found</td></tr>";
        }

        $con->close();
        ?>
             
  
          </tbody>
      </table>
      </div>
            
           
              
            </div>
            
          </div>
  
  
          
          <div class="box">
            
                
          </div>
          </div>
    
          <?php
include 'connection.php';



if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['form_type'] == 'experts_form') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $skills = $_POST['skills'];
    $certificate = isset($_POST['certificate']) ? 1 : 0; 
    $experience = $_POST['experience'];
    $linkedin_profile = $_POST['linkedin_profile'];
    $specialization = $_POST['specialization'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    $sql = "INSERT INTO experts (name, email, skills, certificate, experience, linkedin_profile, specialization, password)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssiisss", $name, $email, $skills, $certificate, $experience, $linkedin_profile, $specialization, $password);

        if ($stmt->execute()) {
            echo "<script>
                  alert('New expert added successfully!');
                  window.location.href = 'admindashboard.php';
                </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $con->error;
    }
}

$con->close();
?>



  
        <div id="sidebar">
        <div class="box">
            
            <div class="box-head">
              <h2>Add an expert</h2>
            </div>
           
            <form class="experts-form" action="admindashboard.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="form_type" value="experts_form">

            <label class="experts-label" for="name">Name:</label><br>
            <input class="experts-input" type="text" id="name" name="name" required><br><br>

            <label class="experts-label" for="email">Email:</label><br>
            <input class="experts-input" type="email" id="email" name="email" required><br><br>

            <label class="experts-label" for="skills">Qualifications:</label><br>
            <input class="experts-input" type="text" id="skills" name="skills" required><br><br>

            <label class="experts-label-certificate" for="certificate">Certificate:</label><br>
            <input class="experts-checkbox" type="checkbox" id="certificate" name="certificate"><br><br>

            <label class="experts-label" for="experience">Experience (years):</label><br>
            <input class="experts-input" type="number" id="experience" name="experience" required><br><br>


            <label class="experts-label" for="linkedin_profile">LinkedIn Profile:</label><br>
            <input class="experts-input" type="url" id="linkedin_profile" name="linkedin_profile"><br><br>

            <label class="experts-label" for="specialization">Specialization:</label><br>
            <input class="experts-input" type="text" id="specialization" name="specialization"><br><br>

            <label class="experts-label" for="password">Temporary Password:</label><br>
    <input class="experts-input" type="password" id="password" name="password" required><br><br>


            <input class="experts-submit" type="submit" value="Proceed">
        </form>
                
          </div>
          
        </div>
        
        <div class="cl">&nbsp;</div>
      </div>
      
    </div>
</div>
</div>




<div id="resources" class="section">
        <div id="projects"  >
    <div class="shell">
      <br />
      
      <div id="main">
        <div class="cl">&nbsp;</div>
      
        <div id="content">
        <h2 class="resourcetitle">Projects</h2>
          <div class="box">
            
            <div class="box-head">
              <h2 class="left">Our Projects</h2>
              <div class="right">
                <label>Search</label>
                <input type="text" class="field small-field" />
                <input type="submit" class="button" value="search" />
                
              </div>
            </div>
            <div class="container mt-5">
          
            <div id="projects-management">
      
      <table id="projects-table" border="1">
  
          
              <thead>
                  <tr>
                      <th>Title</th>
                      <th>Category</th>
                      
                      <th>Edit</th>
                      <th>Delete</th>
                  </tr>
              </thead>
              <tbody>
         
              <?php
                            include 'connection.php';

                            
                          


                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deletep_id'])) {
                              $deletep_id = intval($_POST['deletep_id']);
                              $deleteSql = "DELETE FROM projects WHERE project_id = ?";
                              $stmt = $con->prepare($deleteSql);
                          
                              if ($stmt === false) {
                                  die('MySQL prepare error: ' . htmlspecialchars($con->error));
                              }
                          
                              $stmt->bind_param("i", $deletep_id);
                          
                              if ($stmt->execute()) {
                                  echo "<script>alert('Project deleted successfully.'); window.location.href='admindashboard.php';</script>";
                              } else {
                                  echo "Error deleting project: " . htmlspecialchars($stmt->error);
                              }
                          
                              $stmt->close();
                          }
                            

                           
                            $projectSql = "SELECT project_id, title, category FROM projects";
                            $result = $con->query($projectSql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                                    
                                    echo "<td>";
                                    
                                    echo "<input type='submit' value='Edit'>";
                                    echo "</form>";
                                    echo "</td>";
                                   
                                    echo "<td>";
                                    echo "<form method='post' action='#projects-management' onsubmit=\"return confirm('Are you sure you want to delete this project?');\">";
                                    echo "<input type='hidden' name='deletep_id' value='" . htmlspecialchars($row['project_id']) . "'>";
                                    echo "<input type='submit' value='Delete'>";
                                    echo "</form>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No results found</td></tr>";
                            }

                            $con->close();
                            ?>
  
          </tbody>
      </table>
      </div>
            
           
              
            </div>
            
          </div>
  
          <div id="editModal" class="modal">
      <div class="modal-content">
          <span class="close" onclick="closeEditModal()">&times;</span>
          <form id="editForm" method="post" action="#blog-management">
              <input type="hidden" name="blog_id" id="edit_blog_id">
              <label for="edit_title">Title:</label>
              <input type="text" name="title" id="edit_title">
              <label for="edit_author">Author:</label>
              <input type="text" name="author" id="edit_author">
              <label for="edit_year">Year:</label>
              <input type="number" name="year" id="edit_year">
              <label for="current_image">Current Image:</label><br>
              <img id="current_image" src="" alt="Current Image" style="max-width: 100%;"><br><br>
              <label for="edit_new_image">New Image:</label>
              <input type="file" name="new_image" id="edit_new_image">
              <label for="edit_link">Link:</label>
              <input type="text" name="link" id="edit_link">
              <label for="edit_summary">Summary:</label>
              <textarea name="summary" id="edit_summary"></textarea>
              
              <input type="submit" value="Save Changes">
          </form>
      </div>
  </div>
  
          
          <div class="box">
            
                
          </div>
          </div>
        </div>

        <?php
        include 'connection.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['form_type'] == 'projects_form') {
    $title = $_POST['title'];
    
    
    $category = $_POST['category'];

    // Define upload directory for images
    $image_dir = 'uploads/images/';

    // Ensure the directory exists and is writable
    if (!file_exists($image_dir)) {
        mkdir($image_dir, 0755, true);
    }

    // Handle image file upload
    $image_url = '';
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
        $image_name = basename($_FILES['image_url']['name']);
        $image_target = $image_dir . $image_name;
        if (move_uploaded_file($_FILES['image_url']['tmp_name'], $image_target)) {
            $image_url = $image_target;
        } else {
            echo "Error uploading image file.";
            exit();
        }
    }

    $pdf_url = '';
    if (isset($_FILES['pdf_file'])) {
        $file = $_FILES['pdf_file'];
        
        // Handle file upload process here
        // Example:
        $upload_directory = 'uploads/pdfs/';
        $filename = $file['name'];
        $target_path = $upload_directory . $filename;
        
        if (move_uploaded_file($file['tmp_name'], $target_path)) {
            $pdf_url = $target_path; // Store the URL or path to the uploaded file
        } else {
            // Handle upload failure
            echo "File upload failed.";
        }
    }
    $sql = "INSERT INTO projects (title, image_url, pdf_url, category) VALUES ('$title', '$image_url', '$pdf_url', '$category')";

    if ($con->query($sql) === TRUE) {
        echo "<script>
                alert('New project uploaded successfully!');
                window.location.href = 'admindashboard.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    $con->close();
}
?>


  
        <div id="sidebar">
        <div class="box">
            
            <div class="box-head">
              <h2>Add a new project</h2>
            </div>
           
            <form class="projects-form" action="admindashboard.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="form_type" value="projects_form">
            
    <label class="projects-label" for="title">Title:</label><br>
    <input class="projects-input" type="text" id="title" name="title"><br><br>

    <label class="projects-label" for="image_url">Image:</label><br>
    <input class="projects-input" type="file" id="image_url" name="image_url"><br><br>

    <label class="projects-label" for="pdf_url">Pdf:</label><br>
    <input class="projects-input" type="file" id="pdf_url" name="pdf_url"><br><br>

    <label class="projects-label" for="category">Category:</label><br>
    <input class="projects-input" type="text" id="category" name="category"><br><br>

    <input class="projects-submit" type="submit" value="Add Project">
</form>

                
          </div>
          
        </div>
        
        <div class="cl">&nbsp;</div>
      </div>
      
    </div>


    <div id="researches"  >
    <div class="shell">
      <br />
      
      <div id="main">
        <div class="cl">&nbsp;</div>
      
        <div id="content">
        <h2 class="resourcetitle">Researches</h2>
          <div class="box">
            
            <div class="box-head">
              <h2 class="left">Our Researches</h2>
              <div class="right">
                <label>Search</label>
                <input type="text" class="field small-field" />
                <input type="submit" class="button" value="search" />
                
              </div>
            </div>
            <div class="container mt-5">
          
            <div id="researches-management">
      
      <table id="researches-table" border="1">
  
          
              <thead>
                  <tr>
                      <th>Title</th>
                      <th>Author</th>
                      
                      <th>Edit</th>
                      <th>Delete</th>
                  </tr>
              </thead>
              <tbody>
              <?php
                            include 'connection.php';

                            
                          


                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deletere_id'])) {
                              $deletere_id = intval($_POST['deletere_id']);
                              $deleteSql = "DELETE FROM researches WHERE research_id = ?";
                              $stmt = $con->prepare($deleteSql);
                          
                              if ($stmt === false) {
                                  die('MySQL prepare error: ' . htmlspecialchars($con->error));
                              }
                          
                              $stmt->bind_param("i", $deletere_id);
                          
                              if ($stmt->execute()) {
                                  echo "<script>alert('Research deleted successfully.'); window.location.href='admindashboard.php';</script>";
                              } else {
                                  echo "Error deleting research: " . htmlspecialchars($stmt->error);
                              }
                          
                              $stmt->close();
                          }
                            

                           
                            $researchSql = "SELECT research_id, title, authors FROM researches";
                            $result = $con->query($researchSql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['authors']) . "</td>";
                                   
                                    
                                    echo "<td>";
                                    
                                    echo "<input type='submit' value='Edit'>";
                                    echo "</form>";
                                    echo "</td>";

                                   
                                    echo "<td>";
                                    echo "<form method='post' action='#researches-management' onsubmit=\"return confirm('Are you sure you want to delete this research?');\">";
                                    echo "<input type='hidden' name='deletere_id' value='" . htmlspecialchars($row['research_id']) . "'>";
                                    echo "<input type='submit' value='Delete'>";
                                    echo "</form>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No results found</td></tr>";
                            }

                            $con->close();
                            ?>
  
          </tbody>
      </table>
      </div>
            
           
              
            </div>
            
          </div>
  
          
  
          
          <div class="box">
            
                
          </div>
          </div>
        </div>
        <?php
        include 'connection.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['form_type'] == 'researches_form') {
    $title = $_POST['title'];
    $authors = $_POST['authors'];
   
   

    $image_dir = 'uploads/images/';

    // Ensure the directory exists and is writable
    if (!file_exists($image_dir)) {
        mkdir($image_dir, 0755, true);
    }

    // Handle image file upload
    $image_path = '';
    if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] == 0) {
        $image_name = basename($_FILES['image_path']['name']);
        $image_target = $image_dir . $image_name;
        if (move_uploaded_file($_FILES['image_path']['tmp_name'], $image_target)) {
            $image_path = $image_target;
        } else {
            echo "Error uploading image file.";
            exit();
        }
    }

    $pdf_path = '';
    if (isset($_FILES['pdf_file'])) {
        $file = $_FILES['pdf_file'];
        
        // Handle file upload process here
        // Example:
        $upload_directory = 'uploads/pdfs/';
        $filename = $file['name'];
        $target_path = $upload_directory . $filename;
        
        if (move_uploaded_file($file['tmp_name'], $target_path)) {
            $pdf_url = $target_path; // Store the URL or path to the uploaded file
        } else {
            // Handle upload failure
            echo "File upload failed.";
        }
    }
    $sql = "INSERT INTO researches (title, authors, pdf_path, image_path) VALUES ('$title', '$authors', '$pdf_path', '$image_path')";

    if ($con->query($sql) === TRUE) {
        echo "<script>
                alert('New research uploaded successfully!');
                window.location.href = 'admindashboard.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    $con->close();
}
?>
  
        <div id="sidebar">
        <div class="box">
            
            <div class="box-head">
              <h2>Add a research</h2>
            </div>
           
            <form class="researches-form" action="admindashboard.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="form_type" value="researches_form">
            
    <label class="researches-label" for="title">Title:</label><br>
    <input class="researches-input" type="text" id="title" name="title"><br><br>

    <label class="researches-label" for="authors">Author:</label><br>
    <input class="researches-input" type="text" id="authors" name="authors"><br><br>

    <label class="researches-label" for="pdf_path">Pdf:</label><br>
    <input class="researches-input" type="file" id="pdf_path" name="pdf_path"><br><br>

    <label class="researches-label" for="image_path">Image:</label><br>
    <input class="researches-input" type="file" id="image_path" name="image_path"><br><br>
   

    <input class="researches-submit" type="submit" value="Add Research">
</form>
         
                
          </div>

        </div>
        <div class="cl">&nbsp;</div>
      </div>
    </div>



    <div id="cvtemplates"  >
    <div class="shell">
      <br />
      
      <div id="main">
        <div class="cl">&nbsp;</div>
      
        <div id="content">
        <h2 class="resourcetitle">CV Templates</h2>
          <div class="box">
            
            <div class="box-head">
              <h2 class="left">Our CV Templates</h2>
              <div class="right">
                <label>Search</label>
                <input type="text" class="field small-field" />
                <input type="submit" class="button" value="search" />
                
              </div>
            </div>
            <div class="container mt-5">
          
            <div id="cvtemplates-management">
      
      <table id="cvtemplates-table" border="1">
  
          
              <thead>
                  <tr>
                      <th>Title</th>
                      <th>Description</th>
                      
                      <th>Edit</th>
                      <th>Delete</th>
                  </tr>
              </thead>
              <tbody>
              <?php
                            include 'connection.php';

                            
                          


                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deletecv_id'])) {
                              $deletecv_id = intval($_POST['deletecv_id']);
                              $deleteSql = "DELETE FROM cvtemplates WHERE cvtemplate_id = ?";
                              $stmt = $con->prepare($deleteSql);
                          
                              if ($stmt === false) {
                                  die('MySQL prepare error: ' . htmlspecialchars($con->error));
                              }
                          
                              $stmt->bind_param("i", $deletecv_id);
                          
                              if ($stmt->execute()) {
                                  echo "<script>alert('CV Template deleted successfully.'); window.location.href='admindashboard.php';</script>";
                              } else {
                                  echo "Error deleting cvtemplate: " . htmlspecialchars($stmt->error);
                              }
                          
                              $stmt->close();
                          }
                            

                           
                            $cvtemplateSql = "SELECT cvtemplate_id, title, description FROM cvtemplates";
                            $result = $con->query($cvtemplateSql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                                    
                                    echo "<td>";
                                    
                                    echo "<input type='submit' value='Edit'>";
                                    echo "</form>";
                                    echo "</td>";

                                   
                                    echo "<td>";
                                    echo "<form method='post' action='#cvtemplates-management' onsubmit=\"return confirm('Are you sure you want to delete this project?');\">";
                                    echo "<input type='hidden' name='deletecv_id' value='" . htmlspecialchars($row['cvtemplate_id']) . "'>";
                                    echo "<input type='submit' value='Delete'>";
                                    echo "</form>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No results found</td></tr>";
                            }

                            $con->close();
                            ?>
             
  
          </tbody>
      </table>
      </div>
            
           
              
            </div>
            
          </div>
  
          
  
          
          <div class="box">
            
                
          </div>
          </div>
        </div>
        <?php
        include 'connection.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['form_type'] == 'cvtemplates_form') {


$title = $_POST['title'];
$description = $_POST['description'];

// Define upload directory for images
$image_dir = 'uploads/images/';

// Ensure the directory exists and is writable
if (!file_exists($image_dir)) {
    mkdir($image_dir, 0755, true);
}

// Handle image file upload
$image_url = '';
if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
    $image_name = basename($_FILES['image_url']['name']);
    $image_target = $image_dir . $image_name;
    if (move_uploaded_file($_FILES['image_url']['tmp_name'], $image_target)) {
        $image_url = $image_target;
    } else {
        echo "Error uploading image file.";
        exit();
    }
}



$download_link = '';
    if (isset($_FILES['pdf_file'])) {
        $file = $_FILES['pdf_file'];
        
        // Handle file upload process here
        // Example:
        $upload_directory = 'uploads/pdfs/';
        $filename = $file['name'];
        $target_path = $upload_directory . $filename;
        
        if (move_uploaded_file($file['tmp_name'], $target_path)) {
            $pdf_url = $target_path; // Store the URL or path to the uploaded file
        } else {
            // Handle upload failure
            echo "File upload failed.";
        }
    }

$stmt = $con->prepare("INSERT INTO cvtemplates (image_url, download_link, title, description) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $image_url, $download_link, $title, $description);


if ($stmt->execute()) {
    echo "<script>
                alert('New CV Template uploaded successfully!');
                window.location.href = 'admindashboard.php';
              </script>";
} else {
    echo "Error: " . $stmt->error;
}


$stmt->close();
$con->close();
        }
?>
  
        <div id="sidebar">
        <div class="box">
            
            <div class="box-head">
              <h2>Add a CV Template</h2>
            </div>
           
            <form class="cvtemplates-form" action="admindashboard.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="form_type" value="cvtemplates_form">
            
    <label class="cvtemplates-label" for="title">Title:</label><br>
    <input class="cvtemplates-input" type="text" id="title" name="title"><br><br>

    <label class="cvtemplates-label" for="image_url">Image:</label><br>
    <input class="cvtemplates-input" type="file" id="image_url" name="image_url"><br><br>

    <label class="cvtemplates-label" for="download_link">Document:</label><br>
    <input class="cvtemplates-input" type="file" id="download_link" name="download_link"><br><br>

    <label class="cvtemplates-label" for="description">Description:</label><br>
    <input class="cvtemplates-input" type="text" id="description" name="description"><br><br>

    <input class="cvtemplates-submit" type="submit" value="Add CV Template">
</form>
         
                
          </div>
          
        </div>
        
        <div class="cl">&nbsp;</div>
      </div>
      
    </div>

    <div id="courses">
        <div class="shell">
            <br />
            <div id="main">
                <div class="cl">&nbsp;</div>
                <div id="content">
                    <h2 class="resourcetitle">Courses</h2>
                    <div class="box">
                        <div class="box-head">
                            <h2 class="left">Our Courses</h2>
                            <div class="right">
                                <label>Search</label>
                                <input type="text" class="field small-field" id="courseSearch" />
                                <input type="submit" class="button" value="search" onclick="searchCourses()" />
                            </div>
                        </div>
                        <div class="container mt-5">
                            <div id="courses-management">
                                <table id="courses-table" border="1">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Rating</th>
                                            <th>Duration</th>
                                            <th>Modules</th>
                                            <th>Certificate</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                       
                                        
include 'connection.php';

// Check if POST request to delete a course is made
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_course_id'])) {
    $delete_course_id = intval($_POST['delete_course_id']);
    $deleteSql = "DELETE FROM courses WHERE course_id = ?";
    $stmt = $con->prepare($deleteSql);

    if ($stmt === false) {
        die('MySQL prepare error: ' . htmlspecialchars($con->error));
    }

    $stmt->bind_param("i", $delete_course_id);

    if ($stmt->execute()) {
        echo "<script>alert('Course deleted successfully.'); window.location.href='admindashboard.php';</script>";
    } else {
        echo "Error deleting course: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
}

// Fetch and display courses
$courseSql = "SELECT course_id, title, category, price, rating, duration, modules, certificate FROM courses";
$result = $con->query($courseSql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['title']) . "</td>";
        echo "<td>" . htmlspecialchars($row['category']) . "</td>";
        echo "<td>" . htmlspecialchars($row['price']) . "</td>";
        echo "<td>" . htmlspecialchars($row['rating']) . "</td>";
        echo "<td>" . htmlspecialchars($row['duration']) . "</td>";
        echo "<td>" . htmlspecialchars($row['modules']) . "</td>";
        echo "<td>" . ($row['certificate'] ? 'Yes' : 'No') . "</td>";
        echo "<td><input type='submit' value='Edit'></td>";
        echo "<td>";
        echo "<form method='post' action='#courses-management' onsubmit=\"return confirm('Are you sure you want to delete this course?');\">";
        echo "<input type='hidden' name='delete_course_id' value='" . htmlspecialchars($row['course_id']) . "'>";
        echo "<input type='submit' value='Delete'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='9'>No results found</td></tr>";
}

$con->close();
?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    
                    <!-- Edit Modal -->
                    <div id="editModal" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeEditModal()">&times;</span>
                            <form id="editForm" method="post" action="#courses-management">
                                <input type="hidden" name="course_id" id="edit_course_id">
                                <label for="edit_title">Title:</label>
                                <input type="text" name="title" id="edit_title">
                                <label for="edit_category">Category:</label>
                                <input type="text" name="category" id="edit_category">
                                <label for="edit_price">Price:</label>
                                <input type="text" name="price" id="edit_price">
                                <label for="edit_rating">Rating:</label>
                                <input type="text" name="rating" id="edit_rating">
                                <label for="edit_duration">Duration:</label>
                                <input type="text" name="duration" id="edit_duration">
                                <label for="edit_modules">Modules:</label>
                                <input type="text" name="modules" id="edit_modules">
                                <label for="edit_certificate">Certificate:</label>
                                <input type="checkbox" name="certificate" id="edit_certificate">
                                <input type="submit" value="Save Changes">
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
                <div id="sidebar">
    <div class="box">
        <div class="box-head">
            <h2>Add a New Course</h2>
        </div>
        <form class="courses-form" action="admindashboard.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="form_type" value="courses_form">
            
            <label class="courses-label" for="title">Title:</label><br>
            <input class="courses-input" type="text" id="title" name="title"><br><br>

            <label class="courses-label" for="image_url">Image URL:</label><br>
            <input class="courses-input" type="file" id="image_url" name="image_url"><br><br>

            <label class="courses-label" for="pdf_url">Course URL:</label><br>
            <input class="courses-input" type="text" id="pdf_url" name="pdf_url"><br><br>

            <label class="courses-label" for="category">Category:</label><br>
            <input class="courses-input" type="text" id="category" name="category"><br><br>

            <label class="courses-label" for="price">Price:</label><br>
            <input class="courses-input" type="text" id="price" name="price"><br><br>

            <label class="courses-label" for="rating">Rating:</label><br>
            <input class="courses-input" type="text" id="rating" name="rating"><br><br>

            <label class="courses-label" for="duration">Duration:</label><br>
            <input class="courses-input" type="text" id="duration" name="duration"><br><br>

            <label class="courses-label" for="modules">Modules:</label><br>
            <input class="courses-input" type="text" id="modules" name="modules"><br><br>

            <label class="courses-label-certificate" for="certificate">Certificate:</label>
<input class="courses-checkbox" type="checkbox" id="certificate" name="certificate"><br><br>




            <input class="courses-submit" type="submit" value="Add Course">
        </form>
    </div>
</div>

<?php


include 'connection.php';

// Handle new course submission with file uploads
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_type']) && $_POST['form_type'] == 'courses_form') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $rating = $_POST['rating'];
    $duration = $_POST['duration'];
    $modules = $_POST['modules'];
    $certificate = isset($_POST['certificate']) ? 1 : 0;

    // Define upload directory for images
    $image_dir = 'uploads/images/';

    // Ensure the directory exists and is writable
    if (!file_exists($image_dir)) {
        mkdir($image_dir, 0755, true);
    }

    // Handle image file upload
    $image_url = '';
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
        $image_name = basename($_FILES['image_url']['name']);
        $image_target = $image_dir . $image_name;
        if (move_uploaded_file($_FILES['image_url']['tmp_name'], $image_target)) {
            $image_url = $image_target;
        } else {
            echo "Error uploading image file.";
            exit();
        }
    }

    // Handle general URL for PDF (or other resource)
    $pdf_url = '';
    if (isset($_POST['pdf_url'])) {
        $pdf_url = $_POST['pdf_url']; // Assuming pdf_url is submitted via POST
    }

    // Insert into database
    $sql = "INSERT INTO courses (title, image_url, pdf_url, category, price, rating, duration, modules, certificate) 
            VALUES ('$title', '$image_url', '$pdf_url', '$category', '$price', '$rating', '$duration', '$modules', '$certificate')";

    if ($con->query($sql) === TRUE) {
        echo "<script>alert('New course uploaded successfully!'); window.location.href = 'admindashboard.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    $con->close();
}
?>
<div class="cl">&nbsp;</div>
</div>
</div>

                </div>
     <div id="magazines"  >
    <div class="shell">
      <br />
      
      <div id="main">
        <div class="cl">&nbsp;</div>
      
        <div id="content">
        <h2 class="resourcetitle">Business Magazines</h2>
          <div class="box">
            
            <div class="box-head">
              <h2 class="left">Magazines Section</h2>
              <div class="right">
                <label>Search</label>
                <input type="text" class="field small-field" />
                <input type="submit" class="button" value="search" />
                
              </div>
            </div>
            <div class="container mt-5">
          
            <div id="magazines-management">
      
      <table id="magazines-table" border="1">
  
          
              <thead>
                  <tr>
                      <th>Title</th>
                      <th>Description</th>
                      
                      <th>Edit</th>
                      <th>Delete</th>
                  </tr>
              </thead>
              <tbody>
         
              <?php
                            include 'connection.php';

                            
                          


                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_magazine_id'])) {
                              $delete_magazine_id = intval($_POST['delete_magazine_id']);
                              $deleteSql = "DELETE FROM magazines WHERE magazine_id = ?";
                              $stmt = $con->prepare($deleteSql);
                          
                              if ($stmt === false) {
                                  die('MySQL prepare error: ' . htmlspecialchars($con->error));
                              }
                          
                              $stmt->bind_param("i", $delete_magazine_id);
                          
                              if ($stmt->execute()) {
                                  echo "<script>alert('Magazine deleted successfully.'); window.location.href='admindashboard.php';</script>";
                              } else {
                                  echo "Error deleting magazine: " . htmlspecialchars($stmt->error);
                              }
                          
                              $stmt->close();
                          }
                            

                           
                            $magazineSql = "SELECT magazine_id, title, description FROM magazines";
                            $result = $con->query($magazineSql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                                    
                                    echo "<td>";
                                    
                                    echo "<input type='submit' value='Edit'>";
                                    echo "</form>";
                                    echo "</td>";
                                   
                                    echo "<td>";
                                    echo "<form method='post' action='#magazines-management' onsubmit=\"return confirm('Are you sure you want to delete this magazine?');\">";
                                    echo "<input type='hidden' name='delete_magazine_id' value='" . htmlspecialchars($row['magazine_id']) . "'>";
                                    echo "<input type='submit' value='Delete'>";
                                    echo "</form>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No results found</td></tr>";
                            }

                            $con->close();
                            ?>
  
          </tbody>
      </table>
      </div>
            
           
              
            </div>
            
          </div>
  
          <div id="editModal" class="modal">
      <div class="modal-content">
          <span class="close" onclick="closeEditModal()">&times;</span>
          <form id="editForm" method="post" action="#blog-management">
              <input type="hidden" name="blog_id" id="edit_blog_id">
              <label for="edit_title">Title:</label>
              <input type="text" name="title" id="edit_title">
              <label for="edit_author">Author:</label>
              <input type="text" name="author" id="edit_author">
              <label for="edit_year">Year:</label>
              <input type="number" name="year" id="edit_year">
              <label for="current_image">Current Image:</label><br>
              <img id="current_image" src="" alt="Current Image" style="max-width: 100%;"><br><br>
              <label for="edit_new_image">New Image:</label>
              <input type="file" name="new_image" id="edit_new_image">
              <label for="edit_link">Link:</label>
              <input type="text" name="link" id="edit_link">
              <label for="edit_summary">Summary:</label>
              <textarea name="summary" id="edit_summary"></textarea>
              
              <input type="submit" value="Save Changes">
          </form>
      </div>
  </div>
  
          
          <div class="box">
            
                
          </div>
          </div>
        </div>

        <?php
        include 'connection.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['form_type']) && $_POST['form_type'] == 'magazines_form') {
    $title = $_POST['title'];
    $image = $_POST['image'];
    $link = $_POST['link'];
    $description = $_POST['description'];

    $sql = "INSERT INTO magazines (title, image , link, description) VALUES ('$title', '$image', '$link', '$description')";

    if ($con->query($sql) === TRUE) {
        echo "<script>
                alert('New magazine uploaded successfully!');
                window.location.href = 'admindashboard.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    $con->close();
}
?>


  
        <div id="sidebar">
        <div class="box">
            
            <div class="box-head">
              <h2>Add a new magazine</h2>
            </div>
           
            <form class="magazines-form" action="admindashboard.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="form_type" value="magazines_form">
            
    <label class="magazines-label" for="title">Title:</label><br>
    <input class="magazines-input" type="text" id="title" name="title"><br><br>

    <label class="magazines-label" for="image">Image URL:</label><br>
    <input class="magazines-input" type="text" id="image" name="image"><br><br>

    <label class="magazines-label" for="link">Pdf URL:</label><br>
    <input class="magazines-input" type="text" id="link" name="link"><br><br>

    <label class="magazines-label" for="description">Description:</label><br>
    <input class="magazines-input" type="text" id="description" name="description"><br><br>

    <input class="magazines-submit" type="submit" value="Add magazine">
</form>

                
          </div>
          
        </div>
        
        <div class="cl">&nbsp;</div>
      </div>
      
    </div>



            </div>


   
        </div>
    </div>

    <!-- JavaScript to handle search and modal -->
    <script>
    function searchMagazines() {
        const input = document.getElementById("magazineSearch");
        const filter = input.value.toUpperCase();
        const table = document.getElementById("magazines-table");
        const tr = table.getElementsByTagName("tr");
        for (let i = 1; i < tr.length; i++) {
            const td = tr[i].getElementsByTagName("td");
            let found = false;
            for (let j = 0; j < td.length - 2; j++) { // -2 to exclude Edit and Delete columns
                if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
            tr[i].style.display = found ? "" : "none";
        }
    }

    function closeEditModal() {
        document.getElementById("editModal").style.display = "none";
    }

    // Assuming you'll have more JavaScript to handle the opening of the edit modal and populating it with the course data
    </script>

</div>
</div>



<!-- Footer -->
<section class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                   &copy; 2024 FutureFocus Official Website |<a href="" target="_blank"  > All rights reserved!</a> 
                </div>

            </div>
        </div>
    </section>
<!-- End Footer -->

<script>
    function showSection(sectionId) {
      
        const sections = document.querySelectorAll('.section');
        sections.forEach(section => {
            section.style.display = 'none';
        });

        
        const selectedSection = document.getElementById(sectionId);
        if (selectedSection) {
            selectedSection.style.display = 'block';
        }
    }

    
    document.addEventListener('DOMContentLoaded', () => {
        showSection('mainn');
    });
</script>


<script>
    function highlightRowById(requestId) {
        var rows = document.getElementsByTagName('tr');
        for (var i = 0; i < rows.length; i++) {
            var row = rows[i];
            var hiddenInput = row.querySelector('input[name="highlight_id"]');
            if (hiddenInput && hiddenInput.value == requestId) {
                row.classList.add('highlighted');
            } else {
                row.classList.remove('highlighted'); 
            }
        }
    }
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    fetch('/getUserCount.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('userCount').textContent = data.count;
        })
        .catch(error => console.error('Error fetching user count:', error));
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const data = JSON.parse('<?php echo $jsonData; ?>');

        function createPieChart() {
            const ctx = document.getElementById('myPieChart').getContext('2d');
            const myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Free Users', 'Premium Users'],
                    datasets: [{
                        data: [data.free_users, data.premium_users],
                        backgroundColor: ['rgba(54, 162, 235, 0.7)', 'rgba(255, 99, 132, 0.8)'],
                        hoverBackgroundColor: ['rgba(54, 162, 235, 0.7)', 'rgba(255, 99, 132, 0.8)'],
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    const dataset = tooltipItem.dataset;
                                    const total = dataset.data.reduce(function(previousValue, currentValue) {
                                        return previousValue + currentValue;
                                    });
                                    const currentValue = dataset.data[tooltipItem.dataIndex];
                                    const percentage = ((currentValue / total) * 100).toFixed(2);
                                    return tooltipItem.label + ': ' + currentValue + ' (' + percentage + '%)';
                                }
                            }
                        }
                    }
                }
            });
        }

        createPieChart();
    });
</script>

<script>
    var ctx = document.getElementById('resourceChart').getContext('2d');
    var resourceChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Projects', 'Courses', 'Researches', 'CV Templates', 'Business Magazines'],
            datasets: [{
                label: 'Resource Distribution',
                data: [<?php echo "$projectsCount, $researchesCount, $coursesCount, $cvTemplatesCount, $businessMagazinesCount"; ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 235, 162, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)'
                ],
                borderColor: [
                    '#FFFFFF', 
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            var dataset = tooltipItem.dataset;
                            var total = dataset.data.reduce(function(previousValue, currentValue) {
                                return previousValue + currentValue;
                            });
                            var currentValue = dataset.data[tooltipItem.dataIndex];
                            var percentage = ((currentValue / total) * 100).toFixed(2);
                            return `${tooltipItem.label}: ${tooltipItem.raw} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    fetch('/admindashboard.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('subscriptionCount').textContent = data.count;
        })
        .catch(error => console.error('Error fetching user count:', error));
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    fetch('/admindashboard.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('expertsCount').textContent = data.count;
        })
        .catch(error => console.error('Error fetching user count:', error));
});

</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('lineChart').getContext('2d');
        var lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($datesOverall); ?>,
                datasets: [{
                    label: 'Overall Registrations',
                    data: <?php echo json_encode($registrationsOverall); ?>,
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }, {
                    label: 'Free Users',
                    data: <?php echo json_encode($registrationsFreeUsers); ?>,
                    fill: false,
                    borderColor: 'rgb(255, 99, 132)',
                    tension: 0.1
                }, {
                    label: 'Premium Users',
                    data: <?php echo json_encode($registrationsPremiumUsers); ?>,
                    fill: false,
                    borderColor: 'rgb(54, 162, 235)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Registrations'
                        }
                    }
                }
            }
        });
    });
</script>


<script>
        var ctx = document.getElementById('groupsChart').getContext('2d');
        var groupsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($groupNames); ?>,
                datasets: [{
                    label: 'Number of Messages',
                    data: <?php echo json_encode($messageCounts); ?>,
                    backgroundColor:     'rgba(255, 20, 147, 0.2)',
                    borderColor:     'rgba(153, 102, 255, 0.2)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    
<script>
document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('subscriptionPieChart').getContext('2d');
    var subscriptionCount = <?php echo $subscriptionCount; ?>;
    var userCount = <?php echo $userCount; ?>;
    var nonSubscriptionCount = userCount - subscriptionCount;

    var data = {
        labels: ['Subscribed Users', 'Non-Subscribed Users'],
        datasets: [{
            data: [subscriptionCount, nonSubscriptionCount],
            backgroundColor: ['rgba(26, 188, 156, 0.8)', 'rgba(241, 196, 15, 0.8)'],
            hoverBackgroundColor: ['rgba(26, 188, 156, 0.7)', 'rgba(241, 196, 15, 0.7)'],
            borderColor: ['rgba(255, 255, 255, 1)', 'rgba(255, 255, 255, 1)'],
            borderWidth: 2
        }]
    };

    var pieChart = new Chart(ctx, {
        type: 'pie',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            var dataset = context.dataset;
                            var total = dataset.data.reduce(function(previousValue, currentValue) {
                                return previousValue + currentValue;
                            });
                            var currentValue = dataset.data[context.dataIndex];
                            var percentage = ((currentValue / total) * 100).toFixed(2);
                            return context.label + ': ' + currentValue + ' (' + percentage + '%)';
                        }
                    }
                }
            }
        }
    });
});
</script>

<script>
  var ctx = document.getElementById('expertPieChart').getContext('2d');
  var expertPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['More than 10 years of experience', '10 years or less'],
      datasets: [{
        data: [<?php echo $countMoreThan10; ?>, <?php echo $count10OrLess; ?>],
        backgroundColor: ['rgba(204, 101, 254, 0.8)', 'rgba(255, 159, 64, 0.8)'],
        hoverBackgroundColor: ['rgba(204, 101, 254, 0.8)', 'rgba(255, 159, 64, 0.8)'],
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        tooltip: {
          callbacks: {
            label: function(tooltipItem) {
              var dataset = tooltipItem.dataset;
              var total = dataset.data.reduce(function(previousValue, currentValue) {
                return previousValue + currentValue;
              });
              var currentValue = dataset.data[tooltipItem.dataIndex];
              var percentage = ((currentValue / total) * 100).toFixed(2);
              return tooltipItem.label + ': ' + currentValue + ' (' + percentage + '%)';
            }
          }
        }
      }
    }
  });
</script>



</body>
</html>
