<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="./assets/css/admindashboard.css">
<link rel="stylesheet" href="./assets/css/managegroup.css">
<style>
    /* Custom Styles */
#groups h2 {
    color: #4CAF50;
    text-align: center;
}

#groups .form-group label {
    font-weight: bold;
}

#group-table img {
    border-radius: 5px;
}

#group-table td, #group-table th {
    vertical-align: middle;
}






</style>
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

<div id="groups" class="section container mt-5">
  
    <!-- Form to Create a New Group -->
    <form class="mb-4" method="post" action="#groups" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="groupName">Group Name:</label>
                <input type="text" class="form-control" name="group_name" id="groupName" required>
            </div>
            <div class="form-group col-md-4">
                <label for="groupImage">Group Image:</label>
                <input type="file" class="form-control-file" name="group_image" id="groupImage" accept="image/*">
            </div>
            <div class="form-group col-md-4 align-self-end">
                <input type="submit" class="btn btn-primary" name="create_group" value="Create Group">
            </div>
        </div>
    </form>

    <table id="group-table" class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Image</th>
                <th>Created_at</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'connection.php';

            // Handle Group Creation
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_group'])) {
                $groupName = $_POST['group_name'];
                
                // Handle file upload
                if (isset($_FILES['group_image']) && $_FILES['group_image']['error'] == UPLOAD_ERR_OK) {
                    $imageTmpPath = $_FILES['group_image']['tmp_name'];
                    $imageName = $_FILES['group_image']['name'];
                    $imageSize = $_FILES['group_image']['size'];
                    $imageType = $_FILES['group_image']['type'];
                    $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                    
                    if (in_array($imageExtension, $allowedExtensions)) {
                        $newImageName = md5(time() . $imageName) . '.' . $imageExtension;
                        $uploadDir = 'group_images/';
                        $destPath = $uploadDir . $newImageName;

                        if (move_uploaded_file($imageTmpPath, $destPath)) {
                            $groupImage = $destPath;
                        } else {
                            echo "Error uploading the image.";
                            $groupImage = '';
                        }
                    } else {
                        echo "Invalid image format.";
                        $groupImage = '';
                    }
                } else {
                    $groupImage = '';
                }

                $insertSql = "INSERT INTO groups (name, image) VALUES (?, ?)";
                $stmt = $con->prepare($insertSql);

                if ($stmt === false) {
                    die('MySQL prepare error: ' . htmlspecialchars($con->error));
                }

                $stmt->bind_param("ss", $groupName, $groupImage);

                if ($stmt->execute()) {
                    echo "<script>alert('Group created successfully.'); window.location.href='admindashboard.php#groups';</script>";
                } else {
                    echo "Error creating group: " . htmlspecialchars($stmt->error);
                }

                $stmt->close();
            }

            // Handle Group Update
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_group_id'])) {
                $groupId = intval($_POST['edit_group_id']);
                $groupName = $_POST['group_name'];

                // Handle file upload
                if (isset($_FILES['group_image']) && $_FILES['group_image']['error'] == UPLOAD_ERR_OK) {
                    $imageTmpPath = $_FILES['group_image']['tmp_name'];
                    $imageName = $_FILES['group_image']['name'];
                    $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                    
                    if (in_array($imageExtension, $allowedExtensions)) {
                        $newImageName = md5(time() . $imageName) . '.' . $imageExtension;
                        $uploadDir = 'group_images/';
                        $destPath = $uploadDir . $newImageName;

                        if (move_uploaded_file($imageTmpPath, $destPath)) {
                            $groupImage = $destPath;
                        } else {
                            echo "Error uploading the image.";
                            $groupImage = '';
                        }
                    } else {
                        echo "Invalid image format.";
                        $groupImage = '';
                    }
                } else {
                    // If no new image is uploaded, keep the old one
                    $groupImage = $_POST['current_image'];
                }

                $updateSql = "UPDATE groups SET name = ?, image = ? WHERE group_id = ?";
                $stmt = $con->prepare($updateSql);

                if ($stmt === false) {
                    die('MySQL prepare error: ' . htmlspecialchars($con->error));
                }

                $stmt->bind_param("ssi", $groupName, $groupImage, $groupId);

                if ($stmt->execute()) {
                    echo "<script>alert('Group updated successfully.'); window.location.href='admindashboard.php#groups';</script>";
                } else {
                    echo "Error updating group: " . htmlspecialchars($stmt->error);
                }

                $stmt->close();
            }

            // Handle Group Deletion
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_group_id'])) {
                $groupId = intval($_POST['delete_group_id']);

                $deleteSql = "DELETE FROM groups WHERE group_id = ?";
                $stmt = $con->prepare($deleteSql);

                if ($stmt === false) {
                    die('MySQL prepare error: ' . htmlspecialchars($con->error));
                }

                $stmt->bind_param("i", $groupId);

                if ($stmt->execute()) {
                    echo "<script>alert('Group deleted successfully.'); window.location.href='admindashboard.php#groups';</script>";
                } else {
                    echo "Error deleting group: " . htmlspecialchars($stmt->error);
                }

                $stmt->close();
            }

            // Fetch and Display Groups
            $sql = "SELECT group_id, name, image, created_at FROM groups";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['group_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td><img src='" . htmlspecialchars($row['image']) . "' alt='Group Image' width='50'></td>";
                    echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                    echo "<td>";
                    echo "<form method='post' action='#groups' enctype='multipart/form-data'>";
                    echo "<div class='form-row'>";
                    echo "<div class='form-group col-md-6'>";
                    echo "<input type='hidden' name='edit_group_id' value='" . htmlspecialchars($row['group_id']) . "'>";
                    echo "<input type='hidden' name='current_image' value='" . htmlspecialchars($row['image']) . "'>";
                    echo "<input type='text' class='form-control' name='group_name' value='" . htmlspecialchars($row['name']) . "' required>";
                    echo "</div>";
                    echo "<div class='form-group col-md-6'>";
                    echo "<input type='file' class='form-control-file' name='group_image' accept='image/*'>";
                    echo "</div>";
                    echo "</div>";
                    echo "<input type='submit' class='btn btn-success' value='Save'>";
                    echo "</form>";
                    echo "</td>";
                    echo "<td>";
                    echo "<form method='post' action='#groups' onsubmit=\"return confirm('Are you sure you want to delete this group?');\">";
                    echo "<input type='hidden' name='delete_group_id' value='" . htmlspecialchars($row['group_id']) . "'>";
                    echo "<input type='submit' class='btn btn-danger' value='Delete'>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>No groups found</td></tr>";
            }

            $con->close();
            ?>
        </tbody>
    </table>
</div>
