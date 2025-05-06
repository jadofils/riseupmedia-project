<?php
session_start();
include("./db/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        
        .student-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 5px;
            overflow: hidden;
        }
        
        .student-table th {
            background-color: #007bff;
            color: white;
            padding: 12px;
            text-align: left;
        }
        
        .student-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }
        
        .student-table tr:hover {
            background-color: #f1f8ff;
        }
        
        .file-thumbnail {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        
        .file-link {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .file-icon {
            font-size: 24px;
        }
        
        .btn-add {
            background-color: #28a745;
            color: white;
            padding: 8px 15px;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        
        .btn-add:hover {
            background-color: #218838;
            color: white;
        }
        
        .action-links a {
            margin-right: 10px;
            text-decoration: none;
        }
        
        .edit-link {
            color: #007bff;
        }
        
        .delete-link {
            color: #dc3545;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h2>List of Students</h2>
            <a href="./registration.php" class="btn-add">Add New Student</a>
        </div>
        
        <?php if(isset($_SESSION['deleleted'])): ?>
        <div class="alert alert-danger" id="timer">
            <?php echo $_SESSION['deleleted']; ?>
        </div>
        <?php unset($_SESSION['deleleted']); endif; ?>
        
        <div class="table-responsive">
            <table class="student-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>File</th>
                        <th>Date Added</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $selectQuery = "SELECT * FROM student ORDER BY id DESC";
                    $result = mysqli_query($conn, $selectQuery);
                    
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$row['id']}</td>";
                            echo "<td>{$row['fname']}</td>";
                            echo "<td>{$row['lname']}</td>";
                            echo "<td>{$row['email']}</td>";
                            
                            // File display logic
                            echo "<td>";
                            if(!empty($row['file'])) {
                                $file_path = $row['file'];
                                $file_ext = pathinfo($file_path, PATHINFO_EXTENSION);
                                
                                // File preview based on extension
                                if(in_array($file_ext, ['jpg', 'jpeg', 'png'])) {
                                    // Show thumbnail for images
                                    echo "<a href='{$file_path}' target='_blank' class='file-link'>";
                                    echo "<img src='{$file_path}' class='file-thumbnail' alt='File preview'>";
                                    echo "<span>View</span>";
                                    echo "</a>";
                                } else {
                                    // Show icon for other file types
                                    echo "<a href='{$file_path}' target='_blank' class='file-link'>";
                                    
                                    // Different icons based on file type
                                    if($file_ext == 'pdf') {
                                        echo "<span class='file-icon'>📄</span>";
                                        echo "<span>PDF Document</span>";
                                    } elseif(in_array($file_ext, ['doc', 'docx'])) {
                                        echo "<span class='file-icon'>📝</span>";
                                        echo "<span>Word Document</span>";
                                    } else {
                                        echo "<span class='file-icon'>📎</span>";
                                        echo "<span>File</span>";
                                    }
                                    
                                    echo "</a>";
                                }
                            } else {
                                echo "<span>No file</span>";
                            }
                            echo "</td>";
                            
                            echo "<td>{$row['Date']}</td>";
                            echo "<td class='action-links'>";
                            echo "<a href='./update.php?id={$row['id']}' class='edit-link'>Edit</a> | ";
                            echo "<a onclick='return confirm(\"Are you sure you want to delete {$row['fname']} {$row['lname']}?\")' href='./delete.php?id={$row['id']}' class='delete-link'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' style='text-align:center;'>No students found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Set timer to remove the alert message after 5 seconds
        setTimeout(() => {
            const timer = document.getElementById('timer');
            if(timer) {
                timer.style.transition = 'opacity 0.5s ease';
                timer.style.opacity = '0';
                setTimeout(() => timer.remove(), 500);
            }
        }, 5000);
    </script>
</body>
</html>